<?php namespace RocketPHPTest\Template;
use RocketPHP\Template\Template;
/** 
 * Template Test Case
 *
 */ 
abstract class TemplateTestCase
extends \PHPUnit_Framework_TestCase
{
    public $file = __DIR__ . DIRECTORY_SEPARATOR . 'test.tpl';

    public function badValues()
    {
        return [
            [''],
            [-1],
            [1],
            [1.5],
            [true],
            [false],
            [array()],
            [new \stdClass()]
        ];
    }

    public function setUp()
    {
    }

    public function tearDown()
    { 
    }
}