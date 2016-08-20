<?php

namespace Kothman\Lexer\Tokens;

class Number extends Token
{

    protected function validate()
    {
        if ( !is_numeric($this->value)) {
            throw new \Exception("The token '{$this->value}' is not valid for this class");
        }
    }

}