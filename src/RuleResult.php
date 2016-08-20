<?php

namespace Kothman\Lexer;

class RuleResult
{
    protected $value = null;
    protected $className = null;

    public function __construct($value, $class)
    {
        $this->value = $value;
        $this->className = $class;
    }

    public function value()
    {
        return $this->value;
    }

    public function className()
    {
        return $this->className;
    }

}