<?php
namespace app\framework\classes;

class Macros
{
    private array $macros = [];

    public function escape(string $value)
    {
        return $this->macros['escape'] = strip_tags($value);
    }
    
    public function upper(string $value)
    {
        return $this->macros['upper'] = strtoupper($value);
    }
}
