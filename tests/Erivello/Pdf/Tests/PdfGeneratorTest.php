<?php

namespace Erivello\Pdf\Tests;

use Silex\Application;
use Erivello\Pdf\Generator\PdfGenerator;

class PdfGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->page = $this->getMockBuilder('\Zend\Pdf\Page')
            ->disableOriginalConstructor()
            ->getMock();        
        
        $this->pdf = $this->getMockBuilder('\Zend\Pdf\PdfDocument')
            ->disableOriginalConstructor()
            ->getMock();        
        
        $this->pdfPreset = $this->getMock('\Erivello\Pdf\Preset\PdfPreset');        
    }
    
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
    * @expectedException \Zend\Pdf\Exception\InvalidArgumentException
    */
    public function testGetColorHtmlFails()
    {
        $pdfGenerator = new PdfGenerator();
        
        $colorHtml = 'jimbo';
        $color = $pdfGenerator->getColorHtml($colorHtml);
    }
    
    public function testNewPage()
    {
        $pdfGenerator = new PdfGenerator();
        
        $this->assertEmpty($pdfGenerator->getPages());
        
        $pageSize = 'SIZE_A4';
        $page = $pdfGenerator->newPage($pageSize);
        
        $this->assertInstanceOf('\Zend\Pdf\Page', $page);
        $this->assertEquals(1, count($pdfGenerator->getPages()));
    }
    
    /**
    * @expectedException \Zend\Pdf\Exception\IOException
    */
    public function testGetImageFails()
    {
        $pdfGenerator = new PdfGenerator();
        
        $filePath = '';
        $image = $pdfGenerator->getImage($filePath);
    }

    public function testGetImage()
    {
        $pdfGenerator = new PdfGenerator();
        
        $filePath = __DIR__.'/Fixtures/sensio-labs-product.png';
        $image = $pdfGenerator->getImage($filePath);
        
        $this->assertInstanceOf('\Zend\Pdf\Resource\Image\AbstractImage', $image);
    }
    
    public function testDrawTextOnPage()
    {
        $pdfGenerator = new PdfGenerator();
        
        $this->page->expects($this->once())
            ->method('drawText')
            ->will($this->returnValue($this->page));
                
        $pageDrawn = $pdfGenerator->drawTextOnPage($this->page, 'text', 10, 123);

        $this->assertInstanceOf('\Zend\Pdf\Page', $pageDrawn);
    }
    
    public function testDrawImageOnPage()
    {
        $pdfGenerator = new PdfGenerator();

        $this->page->expects($this->once())
            ->method('drawImage')
            ->will($this->returnValue($this->page));
        
        $filePath = __DIR__.'/Fixtures/sensio-labs-product.png';
        $image = $pdfGenerator->getImage($filePath);
        
        $pageDrawn = $pdfGenerator->drawImageOnPage($this->page, $image, 10, 123, 1234, 12345);

        $this->assertInstanceOf('\Zend\Pdf\Page', $pageDrawn);
    }
    
    public function testSetPageFont()
    {
        $pdfGenerator = new PdfGenerator();

        $this->page->expects($this->once())
            ->method('setFont')
            ->will($this->returnValue($this->page));
        
        $fontName = 'FONT_HELVETICA';
        
        $pageDrawn = $pdfGenerator->setPageFont($this->page, $fontName, 10);

        $this->assertInstanceOf('\Zend\Pdf\Page', $pageDrawn);
    }

    public function testSetPageFillColor()
    {
        $pdfGenerator = new PdfGenerator();

        $this->page->expects($this->once())
            ->method('setFillColor')
            ->will($this->returnValue($this->page));
        
        $colorHtml = '#650D0E';
        $color = $pdfGenerator->getColorHtml($colorHtml);
        
        $pageDrawn = $pdfGenerator->setPageFillColor($this->page, $color);

        $this->assertInstanceOf('\Zend\Pdf\Page', $pageDrawn);
    }
    
    public function testBindWithArgsValueString()
    {
        $pdfGenerator = new PdfGenerator();
        
        $this->pdfPreset->expects($this->once())
            ->method('getPositionFor')
            ->will($this->returnValue(array('left' => 1234, 'bottom' => 98.76)));
        
        $args = array('nome' => '1234,98.76');
        $pdfGenerator->bind($this->pdfPreset, $args);
    }
    
    public function testBindWithArgsValueArray()
    {
        $pdfGenerator = new PdfGenerator();
        
        $this->pdfPreset->expects($this->exactly(3))
            ->method('getPositionFor')
            ->will($this->returnValue(array('left' => 1234, 'bottom' => 98.76)));
        
        $args = array('nome' => '1234,98.76', 'data_di_nascita' => array('year' => '1234,98.76', 'month' => '43.21,987'));
        $pdfGenerator->bind($this->pdfPreset, $args);
    }

}
