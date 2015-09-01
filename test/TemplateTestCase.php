<?php
/**
 * RocketPHP (http://rocketphp.io)
 *
 * @package   RocketPHP
 * @link      https://github.com/rocketphp/template
 * @license   http://opensource.org/licenses/MIT MIT
 */

namespace RocketPHPTest\Template;

use RocketPHP\Template\Template;

/** 
 * Test case for Template
 */ 
abstract class TemplateTestCase
extends \PHPUnit_Framework_TestCase
{
    public $file;

    public function badConstructorValues()
    {
        return [
            [''],
            [null],
            [-1],
            [1],
            [1.5],
            [true],
            [false],
            [array()],
            [new \stdClass()]
        ];
    }

    public function badTemplateValues()
    {
        return [
            [''],
            ['A template'],
            [null],
            [-1],
            [1],
            [1.5],
            [true],
            [false],
            [array()],
            [new \stdClass()]
        ];
    }

    public function badSeparatorValues()
    {
        return [
            [null],
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
        $this->file = __DIR__ . DIRECTORY_SEPARATOR . 'test.tpl';
    }

    public function tearDown()
    { 
    }
}