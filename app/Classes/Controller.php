<?php

namespace App\Classes;

use Exception;

class Controller
{
    private string $controller;
    private string $action;
    private array $params;

    /**
     * @throws Exception
     */
    public function __construct(string $controller, array $params = [])
    {
        list ($controller, $action) = explode('@', $controller);
        $this->controller = 'App\\Controllers\\' . $controller;
        $this->action = $action;
        $this->params = $params;
        $this->execute();
    }

    /**
     * @throws Exception
     */
    private function execute(): void
    {
        if (!class_exists($this->controller)) {
            throw new Exception($this->controller . ' does not exist');
        }

        $controller = new $this->controller();
        if (!method_exists($controller, $this->action)) {
            throw new Exception($this->action . ' does not exist');
        }

        $action = $this->action;
        $controller->$action($this->params);
    }
}
