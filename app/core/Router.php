<?php

/**
 * Router Class
 * Handles URL parsing and request routing
 */

class Router {
    private $controller = 'AuthController';
    private $method = 'index';
    private $params = [];
    
    public function __construct() {
        $url = $this->parseUrl();
        
        // Check if controller exists
        if (isset($url[0]) && !empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerPath = __DIR__ . '/../controllers/' . $controllerName . '.php';
            
            if (file_exists($controllerPath)) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }
        
        // Require controller file
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        
        // Instantiate controller
        $this->controller = new $this->controller;
        
        // Check if method exists
        if (isset($url[1]) && !empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        // Get remaining parameters
        $this->params = $url ? array_values($url) : [];
        
        // Call controller method with parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    /**
     * Parse URL from request
     */
    private function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}
