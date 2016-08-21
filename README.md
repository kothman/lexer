# Lexer

Performs lexical analysis on a string given a set of rules.

## Installation
Via Composer
```
composer require kothman\lexer
```

## Usage

```
$expression = '( 1 + 2 )-3';
$lexer = new Kothman\Lexer\Lexer($expression, Kothman\Lexer\ArithmeticRules::class);
print_r($lexer->getTokens());
```
