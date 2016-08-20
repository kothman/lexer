<?php

namespace Kothman\Lexer;

trait Operators
{

    protected $operators = [
        '+',
        '-',
        '*',
        '/',
        '^'
    ];

    protected function isOperator($char)
    {
        return in_array($char, $this->operators);
    }

}