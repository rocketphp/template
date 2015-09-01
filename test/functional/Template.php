<?php 
namespace RocketPHPTest\Template;
/**
 * @group RocketPHP_Template
 */ 
class Template_Functional
extends TemplateTestCase
{

    public function testTestTpl()
    {
        $tpl = new MockTemplate($this->file); 
        $tpl->set('myVar', 'Donut');
        $this->assertEquals('<p>Template said "Donut"</p>', $tpl->output());
    }
}