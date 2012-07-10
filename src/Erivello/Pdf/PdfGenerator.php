<?php

namespace Erivello\Pdf;

use Zend\Pdf\PdfDocument;
use Zend\Pdf\Font;
use Zend\Pdf\Color\Html;
use Zend\Pdf\Image;

/**
 * PdfGenerator
 *
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
class PdfGenerator implements PdfGeneratorInterface
{
    /**
     * @var \Zend\Pdf\PdfDocument
     */
    protected $pdf;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pdf = new PdfDocument();
    }

    /**
     * @{inheritDoc}
     */      
    public function getPdf() 
    {
        return $this->pdf;
    }

    /**
     * @{inheritDoc}
     */      
    public function setPdf($pdf) 
    {
        $this->pdf = $pdf;
        
        return $this;
    }

    /**
     * @{inheritDoc}
     */    
    public function getPages()
    {
        return $this->pdf->pages;
    }
    
    /**
     * @{inheritDoc}
     */    
    public function getFontByName($fontName)
    {
        $fontConstant = constant('\Zend\Pdf\Font::' . $fontName);
        
        return Font::fontWithName($fontConstant);
    }
    
    /**
     * @{inheritDoc}
     */    
    public function getColorHtml($color)
    {
        return new Html($color);
    }
    
    /**
     * @{inheritDoc}
     */
    public function getImage($filePath)
    {
        return $image = Image::imageWithPath($filePath);
    }
    
    /**
     * @{inheritDoc}
     */
    public function getPropertyValue($property)
    {
        return $this->pdf->properties[$property];
    }
    
    /**
     * @{inheritDoc}
     */
    public function setPropertyValue($property, $value)
    {
        $this->pdf->properties[$property] = $value;
        
        return $this;
    }

    /**
     * @{inheritDoc}
     */    
    public function drawTextOnPage($page, $text, $left, $bottom, $encoding = 'UTF-8')
    {
        return $page->drawText($text, $left, $bottom);
    }
    
    /**
     * @{inheritDoc}
     */    
    public function drawImageOnPage($page, $image, $left, $bottom, $right, $top)
    {
        return $page->drawImage($image, $left, $bottom, $right, $top);
    }
    
    /**
     * @{inheritDoc}
     */    
    public function setPageFont($page, $font, $fontSize)
    {
        return $page->setFont($font, $fontSize);
    }
    
    /**
     * @{inheritDoc}
     */    
    public function setPageFillColor($page, $color)
    {
        return $page->setFillColor($color);
    }
    
    /**
     * @{inheritDoc}
     */    
    public function bind($preset, $args)
    {
        
    }
    
    /**
     * @{inheritDoc}
     */    
    public function render()
    {
        return $this->pdf->render(); 
    }
    
    /**
     * @{inheritDoc}
     */    
    public function save($filename)
    {
        $this->pdf->save($filename);
        
        return $this;
    }
}
