<?php

namespace App;

define('VIEW_PATH', __DIR__ . '/../views');

class View
{
    public function __construct(protected string $view, protected array $params = [])
    {
    }

    public static function make(string $view, array $params = [])
    {

        return new static($view, $params);
    }

    public function render()
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';
        if (!file_exists($viewPath)) {
            throw new \App\Exceptions\NotFoundException();
        }

        extract($this->params);
        ob_start();
        include($viewPath);

        return ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }
}
