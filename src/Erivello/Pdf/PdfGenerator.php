<?php

namespace Erivello\Pdf;

use Zend\Pdf\PdfDocument;
use Zend\Pdf\Font;
use Zend\Pdf\Color\Html;

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
    public function drawTextOnPage($page, $text, $leftCoordinate, $bottomCoordinate, $encoding = 'UTF-8')
    {
        
    }
    
    /**
     * @{inheritDoc}
     */    
    public function setPageFont($page, $font, $fontSize)
    {
        
    }
    
    /**
     * @{inheritDoc}
     */    
    public function setPageFillColor($page, $color)
    {
        
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
        
    }
    
    /**
     * @{inheritDoc}
     */    
    public function save($filename)
    {
        
    }
}
