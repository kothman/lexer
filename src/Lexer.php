<?php

namespace Kothman\Lexer;

class Lexer
{

    /**
     * Saves the original expression passed to the Lexer.
     */
    protected $expression;

    /**
     * Rules object, has methods used to determine token type
     */
    protected $rules;

    /**
     * List of rule methods, retrieved from the Rules object
     * passed to the Lexer.
     */
    protected $ruleMethods;

    /**
     * Array of tokens after lexical analysis has been completed.
     */
    protected $tokens;

    /**
     * @param string $expression An expression to be converted into tokens.
     * @param string $rulesClassName The class name for the Rules object we want to use.
     *
     * @return void
     */
    public function __construct($expression, $rulesClassName)
    {
        $this->expression = $expression;
        $this->rules = new $rulesClassName();
        $this->getRules();
        $this->analyze();
    }

    /**
     * Extracts rule methods from our Rules object.
     *
     * @return void
     */
    protected function getRules()
    {
        $methods = get_class_methods($this->rules);
        $ruleMethods = [];

        foreach ($methods as $method)
        {
            if (substr($method, 0, 4) === 'rule')
                $ruleMethods[] = $method;
        }

        $this->ruleMethods = $ruleMethods;
    }

    /**
     * Applies rules to the expression to get the next token.
     *
     * @param string $expression Temporary expression being parsed.
     *
     * @return Token $token
     */
    protected function getToken($expression)
    {
        $result = $this->applyRules($expression);
        // Do stuff here to take the information (pressumably value and type)
        // and convert to token.
        if ($result === false)
            throw new \Exception("Unable to continue parsing expression at '$expression'.");

        $token = $this->convertResultToToken($result);
        return $token;
    }

    /**
     * Converts the result to its corresponding token type.
     *
     * @param RuleResult $result
     *
     * @return Token $token
     */
    protected function convertResultToToken($result)
    {
        $class = __NAMESPACE__ . '\\Tokens\\' . $result->className();
        $value = $result->value();
        return new $class($value);
    }

    /**
     * Strips expression string to account for retreived token.
     *
     * @param string $expression
     * @param Token $token
     *
     * @return String $newExpression
     */
    protected function stripToken($expression, $token)
    {
        return substr($expression, strlen($token->value()));
    }

    /**
     * Apply all available rule methods to the expression.
     *
     * @param string $expression
     *
     * @return RuleResult | false
     */
    protected function applyRules($expression)
    {
        foreach ($this->ruleMethods as $method) {
            $result = $this->rules->{$method}($expression, $this->getLastToken());
            if ($result !== false)
                return $result;
        }
        return false;
    }

    /**
     * The main loop responsible for traversing through the expression string.
     *
     * Converts the stored expression to tokens.
     *
     * @return void
     */
    protected function analyze()
    {
        $this->tokens = [];
        $expression = $this->expression;
        
        while (!empty($expression)) {
            $token = $this->getToken($expression);
            $this->tokens[] = $token;
            $expression = $this->stripToken($expression, $token);
            $expression = trim($expression);
        }

    }

    /**
     * Get tokens.
     *
     * return Token[] $this->tokens
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * Gets the last added token.
     *
     * Helps keep a sense of current state.
     *
     * @return Token
     */
    public function getLastToken()
    {
        if (count($this->tokens) === 0) {
            return new Tokens\EmptyToken();
        }
        return $this->tokens[count($this->tokens) - 1];
    }
}