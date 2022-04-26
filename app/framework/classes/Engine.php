<?php
namespace app\framework\classes;

class Engine
{
    private ?string $layout;
    private array $data;
    private static string $content;
    private static array $section;
    private static string $actualSection;
    private const TEMPLATE_EXTENSION = 'php';

    private function load():string
    {
        return (self::$content) ?? '';
    }

    private function section(string $name)
    {
        echo self::$section[$name] ?? null;
    }

    private function start(string $name)
    {
        ob_start();
        self::$actualSection = $name;
    }
    
    private function end()
    {
        self::$section[self::$actualSection] = ob_get_contents();
        ob_end_clean();
    }

    private function extends(string $layout, array $data = []):void
    {
        $this->layout = $layout;
        $this->data = $data;
    }

    public function render(string $path, array $data = [])
    {
        try {
            $view = getViewPath($path, self::TEMPLATE_EXTENSION);

            ob_start();

            extract($data);

            require $view;

            $content = ob_get_contents();

            ob_end_clean();

            if (!empty($this->layout)) {
                self::$content = $content; // content from template (e.g. home or login)
                $data = array_merge($this->data, $data); // this->data came from extends
                return view($this->layout, $data);
            }
            
            return $content;
        } catch (\Throwable $th) {
            echo $th->getMessage(). ' '.$th->getFile() . ' '.$th->getLine();
        }
    }
}
