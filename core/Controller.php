<?php

abstract class Controller {

    protected function render(string $view, array $data = []): void {
        $viewPath = dirname(__DIR__) . "/app/views/$view.php";

        if (!file_exists($viewPath)) {
            http_response_code(500);
            throw new Exception("La vue '$view' est introuvable : $viewPath");
        }

        extract($data);

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        require dirname(__DIR__) . "/app/views/layouts/main.php";
    }

    /**
     * Redirige vers une route interne de l'application.
     */
    protected function redirect(string $path): void {
        header("Location: " . APP_URL . "/" . ltrim($path, '/'));
        exit;
    }

    /**
     * Vérifie que l'utilisateur est connecté, sinon redirige vers la page de connexion.
     */
    protected function requireAuth(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['user'])) {
            $this->redirect('auth/login');
        }
    }
}
