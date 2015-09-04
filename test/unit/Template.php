<?php namespace RocketPHPTest\Template;

/**
 * @group RocketPHP_Template
 */ 
class Template_UnitTest
extends TemplateTestCase
{

    public function testConstructor()
    {
        $tpl = new TemplateMock($this->file); 
        $this->assertInstanceOf('RocketPHP\\Template\\Template', $tpl);
    }

    public function testConstructorSetsFile()
    { 
        $tpl = new TemplateMock($this->file); 
        $this->assertSame($tpl->getProtectedProperty('_file'), $this->file);
    }

    public function testSetSetsTemplateVars()
    { 
        $tpl = new TemplateMock($this->file); 
        $tpl->set('myVar', 'Blue');
        $this->assertSame($tpl->getProtectedProperty('_vars')['myVar'], 'Blue');
    }

    public function testMergeReturnsMergedTemplates()
    { 
        $tpl = new TemplateMock($this->file);  
        $tpl->set('myVar', 'Paris');
        $tpl2 = new TemplateMock($this->file);  
        $tpl2->set('myVar', 'London');
        $templates = [$tpl, $tpl2];
        $separator = "\n\n";
        $output = TemplateMock::merge($templates, $separator);

        $result = '<p>Template said "Paris"</p>';
        $result .= "\n\n";
        $result .= '<p>Template said "London"</p>';
        $result .= "\n\n";
        $this->assertEquals($result, $output);
    }

    public function testOutputReturnsHtml()
    { 
        $tpl = new TemplateMock($this->file);  
        $this->assertEquals('<p>Template said "[@myVar]"</p>', $tpl->output());
    }

    public function testOutputReturnsHtmlAfterSet()
    { 
        $tpl = new TemplateMock($this->file); 
        $tpl->set('myVar', 'Orange'); 
        $this->assertEquals('<p>Template said "Orange"</p>', $tpl->output());
    }

    /**
     * @dataProvider             badConstructorValues
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Expected string for template file path.
     */
    public function testConstructorThrowsExceptionIfInvalidFile($badValue)
    {  
        $tpl = new TemplateMock($badValue);
    }

    /**
     * @dataProvider             badTemplateValues
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Expected Template objects.
     */
    public function testMergeThrowsExceptionIfInvalidTemplates($badValue)
    {  
        $tpl = new TemplateMock($this->file);
        $templates = [new TemplateMock($this->file), $badValue];
        $tpl->merge($templates);
    }

    /**
     * @dataProvider             badSeparatorValues
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Expected string for separator.
     */
    public function testMergeThrowsExceptionIfInvalidSeparator($badValue)
    {  
        $tpl = new TemplateMock($this->file);
        $templates = [new TemplateMock($this->file), new TemplateMock($this->file)];
        $tpl->merge($templates, $badValue);
    }

    /**
     * @expectedException        RuntimeException
     * @expectedExceptionMessage Error loading template file: nofile.tpl.
     */
    public function testOutputThrowsExceptionIfNoTemplateFile()
    { 
        $tpl = new TemplateMock('nofile.tpl');  
        $tpl->output();
    }
}