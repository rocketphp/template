<?php
/**
 * RocketPHP (http://rocketphp.io)
 *
 * @package   RocketPHP
 * @link      https://github.com/rocketphp/template
 * @license   http://opensource.org/licenses/MIT MIT
 */

namespace RocketPHP\Template;

/** 
 * Interface for template objects 
 */
interface TemplateInterface
{
    public function set($key, $value);
    public function output();
    public static function merge(array $templates, $separator = "\n");
}
