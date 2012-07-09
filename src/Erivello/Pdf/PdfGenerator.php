<?php

namespace Erivello\Pdf;

use Zend\Pdf\PdfDocument;

/**
 * PdfGenerator
 *
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
class PdfGenerator implements PdfGeneratorInterface
{
    /**
     * @var \Zend\Pdf\PdfDocument instance
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
    public function getPages($pdfDocument)
    {
        
    }
    
    /**
     * @{inheritDoc}
     */    
    public function getFontByName($font)
    {
        
    }
    
    /**
     * @{inheritDoc}
     */    
    public function getColorHtml($color)
    {
        
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