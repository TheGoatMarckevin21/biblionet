<?php
require_once dirname(__DIR__) . '/models/User.php';

class AuthController extends Controller {
    

    public function index(): void {
        $this->login();
    }

    public function login(): void {
    
        if (!empty($_SESSION['user'])) {
            $this->redirect('livres');
        }

        $error = null;

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = User::findByEmail($email);

            
            if ($user && password_verify($password, $user['password'])) {
                
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'email' => $user['email']
                ];

                $this->redirect('catalogue'); 
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }

        $this->render('auth/login', ['error' => $error]);
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        $this->redirect('catalogue');
    }
}