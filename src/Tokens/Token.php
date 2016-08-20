<?php

namespace Kothman\Lexer\Tokens;

abstract class Token
{
    protected $value = null;

    public function __construct($value)
    {
        $this->value = $value;
        $this->validate($value);
    }

    public function value()
    {
        return $this->value;
    }

    protected function validate($value)
    {
        throw new \Exception('This method must be defined by the extending class.');
    }

}