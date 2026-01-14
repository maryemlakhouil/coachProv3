<?php
namespace Core;

class Controller
{
    protected function view(string $view, array $data = [])
    {
        extract($data);
        require __DIR__ . '/../app/Views/' . $view . '.php';
    }
}
