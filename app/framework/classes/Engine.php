<?php
namespace app\framework\classes;

class Engine
{
    private string $layout;
    private array $layoutData;
    private static $content;
    private const EXTENSION = '.php';

    private function getViewPath(string $file):string
    {
        $file = dirname(__FILE__, 2).DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$file.self::EXTENSION;
        if (!file_exists($file)) {
            throw new \Exception("Template {$file} does not exist");
        }
        return $file;
    }

    private function load()
    {
        if (self::$content) {
            return self::$content;
        }
    }

    private function extends(string $layout, array $data = [])
    {
        $this->layout = $layout;
        $this->layoutData = $data;
    }

    public function render(string $path, array $data = [])
    {
        try {
            $path = $this->getViewPath($path);

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
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
