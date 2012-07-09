<?php

namespace Erivello\Pdf\Tests;

use Silex\Application;
use Erivello\Pdf\PdfGenerator;

class PdfGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $pdfGenerator = new PdfGenerator();
        
        $this->assertInstanceOf('\Zend\Pdf\PdfDocument', $pdfGenerator->getPdf());
        $this->assertEmpty($pdfGenerator->getPages());
        $this->assertEquals($pdfGenerator->getPages(), array());
    }  
    
    public function testGetFontByName()
    {
        $pdfGenerator = new PdfGenerator();
        
        $fontName = 'FONT_HELVETICA';
        $font = $pdfGenerator->getFontByName($fontName);
        
        $this->assertInstanceOf('\Zend\Pdf\Resource\Font\AbstractFont', $font);
    }
    
    public function testGetColorHtml()
    {
        $pdfGenerator = new PdfGenerator();
        
        $colorHtml = '#650D0E';
        $color = $pdfGenerator->getColorHtml($colorHtml);
        
        $this->assertInstanceOf('\Zend\Pdf\Color\Html', $color);
    }
    
    /**
    * @expectedException \Zend\Pdf\Exception
    */
    public function testGetColorHtmlFails()
    {
        $pdfGenerator = new PdfGenerator();
        
        $colorHtml = 'jimbo';
        $color = $pdfGenerator->getColorHtml($colorHtml);
    }
}
