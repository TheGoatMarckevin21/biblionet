<?php
class Router {
    public function dispatch(string $url): void {
        $url = trim($url, '/');
        $parts = $url === '' ? [] : explode('/', $url);

        
        $rawName = !empty($parts[0]) ? rtrim(strtolower($parts[0]), 's') : 'catalogue';
        $controllerName = ucfirst($rawName) . 'Controller';
        
        $methodName = $parts[1] ?? 'index';
        $params = array_slice($parts, 2);

        $controllerFile = dirname(__DIR__) . "/app/controllers/$controllerName.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "<h1>404 - Page introuvable</h1>";
    }
}