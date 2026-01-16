<?php
namespace App\Controllers;

use Core\Controller;
use Core\Middleware\AuthMiddleware;
use App\Models\Coach;

class CoachController extends Controller
{
    private Coach $coach;

    public function __construct()
    {
        AuthMiddleware::role('coach');
        $this->coach = new Coach();
    }

    /* ==========================
       DASHBOARD
    ========================== */

    public function dashbord()
    {
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

        $this->view('coach/dashbord', compact(
            'stats',
            'dispos',
            'error'
        ));
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
}
