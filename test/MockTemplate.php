<?php namespace RocketPHPTest\Template;
use RocketPHP\Template\Template;
/** 
 * Mock Template
 */ 
class MockTemplate
extends Template
{
    public function getProtectedProperty($name)
    {
        return $this->{$name};
    }
}