<?php
namespace App\Controllers;

use Core\Controller;
use Core\Middleware\AuthMiddleware;
use App\Models\Coach;

class CoachController extends Controller{

    private Coach $coachModel;

    public function __construct(){

        AuthMiddleware::role('coach');
        $this->coach = new Coach();
    }

    public function dashboard() {

        $coachId = $_SESSION['user_id'];
        $stats = $this->coach->getDashboardStats($coachId);
        $this->view('coach/dashbord', compact('stats'));
    }

    public function profile(){

    $coachId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $success = $this->coachModel->ModifieProfile(
            $coachId,
            $_POST['biographie'],
            (int)$_POST['experience'],
            $_POST['photo'],
            $_POST['certification']
        );

        if ($success) {
            header('Location: /coach/dashbord');
            exit;
        }

        $error = "Erreur lors de l'enregistrement";
    }

    $profile = $this->coachModel->getProfile($coachId);
    $this->view('coach/profile', compact('profile', 'error'));
}

}
