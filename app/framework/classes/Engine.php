<?php
namespace app\framework\classes;

class Engine
{
    private string $layout;
    private array $layoutData;
    private static $content;

    private function getViewPath(string $file):string
    {
        return dirname(__FILE__, 2).DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$file.'.php';
    }

    private function load()
    {
        if (self::$content) {
            return self::$content;
        }
    }

    private function extends(string $layout, array $data = [])
    {
        $this->layout = $this->getViewPath($layout);
        $this->layoutData = $data;
    }

    private function escape(string $content)
    {
        return strip_tags($content);
    }

    public function render(string $path, array $data = [])
    {
        if (!file_exists($path)) {
            $path = $this->getViewPath($path);
        }

        ob_start();

        extract($data);
        
        require $path;
        
        $content = ob_get_contents();
        
        ob_end_clean();

        if (!empty($this->layout)) {
            self::$content = $content;
            $data = array_merge($this->layoutData, $data, );
            $view = view($this->layout, $data);
            return $view;
        }

        return $content;
    }
}
