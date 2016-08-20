<?php

use PHPUnit\Framework\TestCase;
use Kothman\Lexer\Lexer;
use Kothman\Lexer\Rules;

class LexerTest extends TestCase
{
    public function testSingleDigit()
    {
        $expression = '( + )';
        $l = new Lexer($expression, Rules::class);
    }
}