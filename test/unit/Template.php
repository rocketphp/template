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

    public function testMergeReturnsMergedTemplates()
    { 
        $tpl = new MockTemplate($this->file);  
        $tpl->set('myVar', 'Paris');
        $tpl2 = new MockTemplate($this->file);  
        $tpl2->set('myVar', 'London');
        $templates = [$tpl, $tpl2];
        $separator = "\n\n";
        $output = MockTemplate::merge($templates, $separator);

        $result = '<p>Template said "Paris"</p>';
        $result .= "\n\n";
        $result .= '<p>Template said "London"</p>';
        $result .= "\n\n";
        $this->assertEquals($result, $output);
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
     * @dataProvider             badConstructorValues
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Expected string for template file path.
     */
    public function testConstructorInvalidFile($badValue)
    {  
        $tpl = new MockTemplate($badValue);
    }

    /**
     * @dataProvider             badTemplateValues
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Expected Template objects.
     */
    public function testMergeInvalidTemplates($badValue)
    {  
        $tpl = new MockTemplate($this->file);
        $templates = [new MockTemplate($this->file), $badValue];
        $tpl->merge($templates);
    }

    /**
     * @dataProvider             badSeparatorValues
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Expected string for separator.
     */
    public function testMergeInvalidSeparator($badValue)
    {  
        $tpl = new MockTemplate($this->file);
        $templates = [new MockTemplate($this->file), new MockTemplate($this->file)];
        $tpl->merge($templates, $badValue);
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