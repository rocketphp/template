<?php
/**
 * RocketPHP (http://rocketphp.io)
 *
 * @package   RocketPHP
 * @link      https://github.com/rocketphp/template
 * @license   http://opensource.org/licenses/MIT MIT
 */

namespace RocketPHP\Template;

use RuntimeException;
use InvalidArgumentException;

/** 
 * Template: Dynamic HTML templates
 *
 * Use Template when you want to use static files
 * (e.g. .tpl) for HTML generation.
 */
class Template
implements TemplateInterface
{
    
    /**
     * Template filename to load
     * @access protected
     * @var string
     */
    protected $_file;
    
    /**
     * Template vars to replace
     * @access protected
     * @var array
     */
    protected $_vars = [];
    
    /**
     * Construct
     *
     * @param string $file Template filename
     */
    public function __construct($file)
    {
        if(!is_string($file) || $file === '')
            throw new InvalidArgumentException(
                "Expected string for template file path.", 
                1
            );
        $this->_file = $file;
    }
    
    /**
     * Sets a template var
     *
     * @param string $key   Name
     * @param string $value Value
     *
     * @return void
     */
    public function set($key, $value)
    {
        $this->_vars[$key] = $value;
    }
    
    /**
     * Outputs interpreted template content
     *
     * @return string
     */
    public function output()
    {
        if (!file_exists($this->_file))
            throw new RuntimeException(
                "Error loading template file: $this->_file.", 
                1
            );

        $output = file_get_contents($this->_file);
        
        foreach ($this->_vars as $key => $value) {
            $tagToReplace = "[@$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }

        return $output;
    }
    
    /**
     * Merges templates separated by $separator
     *
     * @param  array  $templates Template objects to merge
     * @param  string $separator Separator string
     *
     * @return string
     */
    public static function merge($templates, $separator = "\n")
    {
        $output = "";
        foreach ($templates as $template) {
            $content = (get_class($template) !== "Template")
                ? "Error, incorrect type - expected Template."
                : $template->output();
            $output .= $content . $separator;
        }
        return $output;
    }

}