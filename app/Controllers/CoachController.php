<?php
namespace App\Controllers;

use Core\Controller;
use Core\Middleware\AuthMiddleware;
use App\Models\Coach;

class CoachController extends Controller{

    private Coach $coach;

    public function __construct(){

        AuthMiddleware::role('coach');
        $this->coach = new Coach();
    }

    /* ==========================
       DASHBOARD
    ========================== */

    public function dashboard(){

        $coachId = $_SESSION['user_id'];

        $profile = $this->coach->getProfile($coachId);
        if (empty($profile['biographie']) || (int)$profile['experience'] === 0) {
            header('Location: /coach/profile');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->coach->ajoutDisponibilite(
                $coachId,
                $_POST['date'],
                $_POST['heure_debut'],
                $_POST['heure_fin']
            );
        }

        $error = null;
        if (isset($_GET['delete_dispo'])) {
            if (!$this->coach->supprimerDisponibilite(
                (int)$_GET['delete_dispo'],
                $coachId
            )) {
                $error = "Impossible de supprimer : créneau déjà réservé.";
            }
        }

        $stats = array_merge(
            [
                'pending' => 0,
                'today'   => 0,
                'next'    => null
            ],
            $this->coach->getDashboardStats($coachId)
        );

        $dispos = $this->coach->afficherDisponibilites($coachId);

        $this->view('coach/dashboard', [
            'stats'  => $stats,
            'dispos' => $dispos
        ]);
    }

    /* ==========================
       PROFIL
    ========================== */

    public function profile()
    {
        $coachId = $_SESSION['user_id'];
        $message = null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $success = $this->coach->updateProfile(
                $coachId,
                $_POST['biographie'] ?? '',
                (int)($_POST['experience'] ?? 0),
                $_POST['photo'] ?? '',               // URL
                $_FILES['certification'] ?? null     // FILE
            );

            if ($success) {
                $message = "Profil mis à jour avec succès";
            } else {
                $error = "Erreur lors de la mise à jour du profil";
            }
        }

        $profile = $this->coach->getProfile($coachId);
        $this->view('coach/profile', compact('profile', 'message', 'error'));
    }

    /* ==========================
       RÉSERVATIONS
    ========================== */

    public function reservations(){
        $coachId = $_SESSION['user_id'];
        $reservations = $this->coach->getReservations($coachId);

        $this->view('coach/reservations', compact('reservations'));
    }
    public function completerProfile()
{
    AuthMiddleware::role('coach');

    $coachId = $_SESSION['user_id'];
    $error = null;
    $message = null; 

    $profile = $this->coach->getProfile($coachId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $biographie    = trim($_POST['biographie'] ?? '');
        $experience    = (int) ($_POST['experience'] ?? 0);
        $certification = trim($_POST['certification'] ?? '');
        $photo         = trim($_POST['photo'] ?? '');

        if ($biographie === '' || $experience <= 0) {
            $error = "Tous les champs obligatoires doivent être remplis";
        } else {
            $this->coach->saveOrUpdateProfile(
                $coachId,
                $biographie,
                $experience,
                $certification,
                $photo
            );

            header('Location: index.php?page=dashbord_coach');
            exit;
        }
    }

    $this->view('coach/completer_profile', compact('profile', 'error','message'));
}

    public function deleteDispo(){
    Security::requireRole('coach');

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $model = new Disponibilite();
        $model->delete($id, $_SESSION['user_id']);
    }

    header('Location: index.php?page=coach.dashbord_coach');
    exit;
}
public function getProfile(int $coachId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT u.id, u.nom, u.prenom,
                   cp.biographie, cp.experience, cp.photo, cp.certification
            FROM users u
            LEFT JOIN coach_profile cp ON cp.coach_id = u.id
            WHERE u.id = ?
        ");
        $stmt->execute([$coachId]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function saveOrUpdateProfile(
        int $coachId,
        string $biographie,
        int $experience,
        string $certification,
        string $photo
    ): bool {
        // vérifier existence
        $check = $this->pdo->prepare("
            SELECT id FROM coach_profile WHERE coach_id = ?
        ");
        $check->execute([$coachId]);

        if ($check->fetch()) {
            $stmt = $this->pdo->prepare("
                UPDATE coach_profile
                SET biographie = ?, experience = ?, certification = ?, photo = ?
                WHERE coach_id = ?
            ");
            return $stmt->execute([
                $biographie,
                $experience,
                $certification,
                $photo,
                $coachId
            ]);
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO coach_profile (coach_id, biographie, experience, certification, photo)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $coachId,
            $biographie,
            $experience,
            $certification,
            $photo
        ]);
    }
}

