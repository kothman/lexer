<?php

namespace Kothman\Lexer\Tokens;

class Parenthesis extends Token
{

    protected function validate()
    {
        if ($this->value !== '(' && $this->value !== ')') {
            throw new \Exception("The token '{$this->value}' is not valid for this class");
        }
    }

}