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