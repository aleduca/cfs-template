<?php
namespace app\framework\classes;

class Engine
{
    private string $layout;
    private array $layoutData;
    private static $content;
    private const TEMPLATE_EXTENSION = '.php';
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
            $path = getViewPath($path, 'php');

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
