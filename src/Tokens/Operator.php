<?php

namespace Kothman\Lexer\Tokens;

class Operator extends Token
{

    use \Kothman\Lexer\Operators;

    protected function validate()
    {
        if (!$this->isOperator($this->value)) {
            throw new \Exception("The token '{$this->value}' is not valid for this class");
        }
    }

}