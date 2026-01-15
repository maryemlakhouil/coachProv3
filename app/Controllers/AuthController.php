<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Utilisateur;

class AuthController extends Controller {

    public function login(){

        session_start();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $error = "Tous les champs sont obligatoires.";
            } else {

                $userModel = new Utilisateur();
                $user = $userModel->login($email, $password);

                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['nom']     = $user['nom'];
                    $_SESSION['prenom']  = $user['prenom'];
                    $_SESSION['role']    = $user['role'];

                    // redirection selon rôle
                    if ($user['role'] === 'coach') {
                        header('Location: /coach/dashbord');
                    } else if ($user['role'] === 'sportif') {
                        header('Location: /sportif/dashbord');
                    } else {
                        header('Location: /');
                    }
                    exit;
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            }
        }

        $this->view('auth/login', compact('error'));
    }

    public function register(){

        session_start();
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom']);
            $prenom = trim($_POST['prenom']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $role = $_POST['role'];

            $userModel = new Utilisateur();
            if ($userModel->register($nom, $prenom, $email, $password, $role)) {
                $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            } else {
                $error = "Impossible de créer le compte. Vérifiez les informations SVP . ";
            }
        }

        $this->view('auth/register', compact('error', 'success'));
    }
}
