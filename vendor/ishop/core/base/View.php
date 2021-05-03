<?php


namespace ishop\base;


class View
{
    public $route;
    public $controller;
    public $view;
    public $model;
    public $prefix;
    public $layout;
    public $data = [];
    public $meta = [];

    public function __construct($route, $layout = '', $view = '', $meta = [])
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if($layout === false) {
            $this->layout = false;
        }
        else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data) {
        if(is_array($data)) {
            extract($data);
        }

        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";

        if(is_file($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }
        else {
            throw new \Exception("Не найден вид {$viewFile}", 500);
        }

        $metaText = self::getMeta();

        if(false !== $this->layout) {
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";

            if(is_file($layoutFile)) {
                ob_start();
                require_once $layoutFile;
                echo $layout = ob_get_clean();
            }
            else {
                throw new \Exception("Не найден шаблон {$this->layout}", 500);
            }
        }
    }

    //Вернуть разметку с тегами title description keywords
    public function getMeta() {
        $meta = "";

        if(isset($this->meta['keywords'])) {
            $meta .= '<meta name="Keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;
        }

        if(isset($this->meta['desc'])) {
            $meta .= '<meta name="description" content="' . $this->meta['desc'] . '">' . PHP_EOL;
        }

        if(isset($this->meta['title'])) {
            $meta .= "<title>{$this->meta['title']}</title>" . PHP_EOL;
        }

        return $meta;
    }
}