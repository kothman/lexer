<?php

namespace Kothman\Lexer\Tokens;

class EmptyToken extends Token
{

    public function __construct()
    {
        parent::__construct('');
    }

    public function validate()
    {

    }
}