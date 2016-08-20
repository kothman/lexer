<?php

namespace Kothman\Lexer;

trait StringHelpers
{

    protected function getChar($str)
    {
        return substr($str, 0, 1);
    }

    protected function getSecondChar($str)
    {
        if (strlen($str) > 1) {
            return substr($str, 1, 1);
        }
        return false;
    }

}