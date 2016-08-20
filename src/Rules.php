<?php

namespace Kothman\Lexer;

class Rules
{
    use StringHelpers;
    use Operators;

    public function ruleOperator($expression, $lastToken)
    {
        if ($this->isOperator($this->getChar($expression)) &&
            (get_class($lastToken) === __NAMESPACE__ . '\\Tokens\\Number' ||
             $lastToken->value() === ')')
        ) {
            return new RuleResult($this->getChar($expression), 'Operator');
        }

        return false;
    }

    public function ruleNumber($expression, $lastToken)
    {
        $char = $this->getChar($expression);
        $secondChar = $this->getSecondChar($expression);

        if ( is_numeric($char) ||
             $char === '.' ||
             ( $char === '-' && get_class($lastToken) !== __NAMESPACE__ . '\\Tokens\\Number' &&
               ( $secondChar === '.' || is_numeric($secondChar) )
             ))
        {
            return new RuleResult($this->extractNumber($expression), 'Number');
        }

        return false;
    }

    protected function extractNumber($expression)
    {
        $char = $this->getChar($expression);
        $number = '';
        while ( !empty($expression) && (
                is_numeric($char) ||
                ($char === '-' && strlen($number) === 0) ||
                ($char === '.' && substr_count($number, '.') === 0)))
        {
            $number .= $char;
            $expression = substr($expression, 1);
            $char = $this->getChar($expression);
        }
        return $number;
    }

    public function ruleParenthesis($expression, $lastToken)
    {
        $char = $this->getChar($expression);
        if ($char === ')' || $char === '(') {
            return new RuleResult($char, 'Parenthesis');
        }
        return false;
    }
}