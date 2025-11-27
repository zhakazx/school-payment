<?php

/**
 * Base Controller Class
 * Provides view rendering and helper methods
 */

class Controller {
    
    /**
     * Load and render a view
     */
    public function view($view, $data = []) {
        // Extract data array to variables
        extract($data);
        
        // Build view path
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View not found: {$view}");
        }
    }
    
    /**
     * Load a model
     */
    public function model($model) {
        $modelPath = __DIR__ . '/../models/' . $model . '.php';
        
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        } else {
            die("Model not found: {$model}");
        }
    }
    
    /**
     * Redirect to another URL
     */
    public function redirect($path) {
        $url = BASE_URL . '/' . ltrim($path, '/');
        header("Location: {$url}");
        exit;
    }
    
    /**
     * Return JSON response
     */
    public function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
