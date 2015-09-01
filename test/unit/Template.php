<?php namespace RocketPHPTest\Template;

/**
 * @group RocketPHP_Template
 */ 
class Template_UnitTest
extends TemplateTestCase
{

    public function testConstructor()
    {
        $tpl = new MockTemplate($this->file); 
        $this->assertInstanceOf('RocketPHP\\Template\\Template', $tpl);
    }

    public function testConstructorSetsFile()
    { 
        $tpl = new MockTemplate($this->file); 
        $this->assertSame($tpl->getProtectedProperty('_file'), $this->file);
    }

    public function testSetSetsTemplateVars()
    { 
        $tpl = new MockTemplate($this->file); 
        $tpl->set('myVar', 'Blue');
        $this->assertSame($tpl->getProtectedProperty('_vars')['myVar'], 'Blue');
    }

    public function testOutputReturnsHTML()
    { 
        $tpl = new MockTemplate($this->file);  
        $this->assertEquals('<p>Template said "[@myVar]"</p>', $tpl->output());
    }

    public function testOutputReturnsHTMLAfterSet()
    { 
        $tpl = new MockTemplate($this->file); 
        $tpl->set('myVar', 'Orange'); 
        $this->assertEquals('<p>Template said "Orange"</p>', $tpl->output());
    }

    /**
     * @dataProvider             badValues
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Expected string for template file path.
     */
    public function testConstructorInvalidFile($badValue)
    {  
        $h = new MockTemplate($badValue);
    }

    /**
     * @expectedException        RuntimeException
     * @expectedExceptionMessage Error loading template file: nofile.tpl.
     */
    public function testOutputNoTemplateFile()
    { 
        $tpl = new MockTemplate('nofile.tpl');  
        $tpl->output();
    }
}