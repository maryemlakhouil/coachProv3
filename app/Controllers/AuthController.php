<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Utilisateur;
use App\Models\Coach; // <-- n'oublie pas d'importer le modèle Coach

class AuthController extends Controller {

    private Utilisateur $user;
    private Coach $coach; // <-- déclaration de la propriété

    public function __construct() {
        $this->user = new Utilisateur();
        $this->coach = new Coach(); // <-- initialisation
    }

    public function login() {

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = $this->user->login(
                $_POST['email'],
                $_POST['password']
            );

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'coach') {
                    // Vérifier si le profil coach est complet
                    $profile = $this->coach->getProfile($user['id']);

                    if (empty($profile['biographie']) || (int)$profile['experience'] === 0) {
                        // Profil incomplet → rediriger vers compléter le profil
                        header('Location: index.php?page=completer_profile');
                        exit;
                    } else {
                        // Profil complet → dashboard coach
                        header('Location: index.php?page=dashbord_coach');
                        exit;
                    }
                } else {
                    header('Location: index.php?page=dashbord');
                    exit;
                }
            }

            $error = "Email ou mot de passe incorrect";
        }

        $this->view('auth/login', compact('error'));
    }

    public function register() {

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ok = $this->user->register(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['password'],
                $_POST['role']
            );

            if ($ok) {
                $success = "Compte créé avec succès. Connectez-vous.";
            } else {
                $error = "Erreur lors de l'inscription";
            }
        }

        $this->view('auth/register', compact('error', 'success'));
    }
}
