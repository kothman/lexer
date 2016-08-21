<?php

use PHPUnit\Framework\TestCase;
use Kothman\Lexer\Lexer;
use Kothman\Lexer\ArithmeticRules;

class LexerTest extends TestCase
{
    public function testExpression()
    {
        $expression = '( 1 +-2/5^-.3 ((( 1 + 2) + 3)-4)*5)';
        $l = new Lexer($expression, ArithmeticRules::class);
    }
}