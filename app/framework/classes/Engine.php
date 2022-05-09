<?php
namespace app\framework\classes;

use Exception;
use ReflectionClass;

class Engine
{
    private ?string $layout;
    private array $data;
    private string $content;
    private array $section;
    private string $actualSection;
    private array $dependencies = [];
    private const TEMPLATE_EXTENSION = 'php';
    private static $countInstances = 0;

    public function __construct()
    {
        self::$countInstances++;
    }

    private function load():string
    {
        return ($this->content) ?? '';
    }

    private function section(string $name)
    {
        echo $this->section[$name] ?? null;
    }

    private function start(string $name)
    {
        ob_start();
        $this->actualSection = $name;
    }
    
    private function end()
    {
        $this->section[$this->actualSection] = ob_get_contents();
        ob_end_clean();
    }

    private function extends(string $layout, array $data = []):void
    {
        $this->layout = $layout;
        $this->data = $data;
    }

    // get the class dependencies from View function in helpers.php
    public function dependencies(array $dependencies)
    {
        foreach ($dependencies as $dependency) {
            $className = strtolower((new ReflectionClass($dependency))->getShortName());
            $this->dependencies[$className] = $dependency;
        }
    }

    // to call macros on template
    public function __call(string $name, array $arguments)
    {
        if (!method_exists($this->dependencies['macros'], $name)) {
            throw new Exception("Macro ${name} does not exist");
        }
        
        if (empty($arguments)) {
            throw new Exception("Macro ${name} need at last one parameter");
        }

        return $this->dependencies['macros']->$name($arguments[0]);
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
                $this->content = $content; // content from template (e.g. home or login)
                $data = array_merge($this->data, $data); // this->data came from extends
                $layout = $this->layout;
                $this->layout = null;
                return $this->render($layout, $data);
            }
            
            return $content;
        } catch (\Throwable $th) {
            echo $th->getMessage(). ' '.$th->getFile() . ' '.$th->getLine();
        }
    }
}
