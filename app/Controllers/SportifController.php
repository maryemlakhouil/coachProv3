<?php
namespace App\Controllers;

use Core\Controller;
use Core\Middleware\AuthMiddleware;
use App\Models\Sportif;
use Core\Database;
use App\Models\Utilisateur; 
use App\Models\Reservation;
use App\Models\Seance;
use PDO;

class SportifController extends Controller {

    private Sportif $sportif;
    private PDO $pdo;

    public function __construct() {
        AuthMiddleware::role('sportif'); 
        $this->sportif = new Sportif();

        // Créer l'objet PDO une seule fois
        $db = new Database();
        $this->pdo = $db->getInstance();
    }

    public function dashboard()
    {
        $userId = $_SESSION['user_id'] ?? null;

        // Passer le PDO au modèle Reservation
        $reservation = new Reservation($this->pdo);

        // Statistiques dynamiques
        $stats = [
            'reserved' => $reservation->countReservedByUser($userId),
            'pending'  => $reservation->countPendingByUser($userId),
        ];

        // Coachs disponibles
        $coachs = $reservation->getCoachs();

        $this->view('sportif/dashboard', compact('stats', 'coachs'));
    }

    public function listCoachs() {
        $coachs = $this->sportif->getCoachs();
        $this->view('sportif/coachs', compact('coachs'));
    }


    public function reserver() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sportifId = $_SESSION['user_id'];
            $coachId = $_POST['coach_id'];
            $availabilityId = $_POST['availability_id'];

            $success = $this->sportif->reserverSeance($sportifId, $coachId, $availabilityId);
        }
        $this->view('sportif/reserver', compact('success'));
    }

    public function annulerReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sportifId = $_SESSION['user_id'];
            $reservationId = $_POST['reservation_id'];

            $success = $this->sportif->annulerReservation($reservationId, $sportifId);
        }
        $this->dashboard();
    }

  
public function seances()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $pdo = Database::getInstance();
    $seanceModel = new Seance($pdo);

    // 🔥 ICI est la clé
    if (isset($_GET['coach_id'])) {
        // Séances d’un coach précis
        $seances = $seanceModel->getSeanceParCoach((int)$_GET['coach_id']);
    } else {
        // Toutes les séances disponibles
        $seances = $seanceModel->getSeancesDisponibles();
    }

    $message = '';

    $this->view('sportif/seances', [
        'seances' => $seances,
        'message' => $message
    ]);
}
public function listReservations() {
    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
        // Rediriger ou afficher erreur si pas connecté
        header('Location: index.php?page=login');
        exit;
    }

    // Récupérer PDO depuis Database singleton
    $pdo = \Core\Database::getInstance();

    // Instancier le modèle Reservation
    $reservationModel = new \App\Models\Reservation($pdo);

    // Récupérer les réservations du sportif
    $reservations = $reservationModel->getBySportif($userId);

    // Message éventuel
    $message = $_SESSION['message'] ?? '';
    unset($_SESSION['message']);

    // Passer les données à la vue
    $this->view('sportif/mes_reservations', compact('reservations', 'message'));
}

public function disponibilites(int $coachId)
{
    AuthMiddleware::role('sportif');

    if ($coachId <= 0) {
        header('Location: index.php?page=dashbord');
        exit;
    }

    $dispos = $this->sportif->getDisponibilites($coachId);
    $this->view('sportif/seances', compact('dispos', 'coachId'));
}



}
