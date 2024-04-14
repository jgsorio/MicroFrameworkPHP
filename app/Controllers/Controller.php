<?php

namespace App\Controllers;

abstract class Controller
{
    protected array $data;
    public function loadView(string $view, array $params): array
    {
        $this->assign($params);
        require __DIR__ . '/../Views/' . $view . '.php';
        return $this->data;

    }

    private function assign(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
    }
}
