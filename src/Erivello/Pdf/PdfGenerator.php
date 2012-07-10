<?php

namespace Erivello\Pdf;

use Zend\Pdf\PdfDocument;
use Zend\Pdf\Page;
use Zend\Pdf\Font;
use Zend\Pdf\Color;
use Zend\Pdf\Image;

/**
 * PdfGenerator
 *
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
class PdfGenerator implements PdfGeneratorInterface
{
    const DEFAULT_FONT = 'FONT_HELVETICA';
    
    const DEFAULT_PAGE_SIZE = 'SIZE_A4';

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
    public function setPdf(PdfDocument $pdf) 
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
    public function newPage($pageSize)
    {
        $pageSizeConstant = constant('\Zend\Pdf\Page::' . $pageSize);
        
        $page = $this->pdf->newPage($pageSizeConstant);
        $this->pdf->pages[] = $page;
        
        return $page;
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
        return new Color\Html($color);
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
    public function drawTextOnPage(Page $page, $text, $left, $bottom, $encoding = 'UTF-8')
    {
        return $page->drawText($text, $left, $bottom);
    }
    
    /**
     * @{inheritDoc}
     */    
    public function drawImageOnPage(Page $page, $image, $left, $bottom, $right, $top)
    {
        return $page->drawImage($image, $left, $bottom, $right, $top);
    }
    
    /**
     * @{inheritDoc}
     */    
    public function setPageFont(Page $page, $font, $fontSize)
    {
        return $page->setFont($font, $fontSize);
    }
    
    /**
     * @{inheritDoc}
     */    
    public function setPageFillColor(Page $page, Color $color)
    {
        return $page->setFillColor($color);
    }
    
    /**
     * @{inheritDoc}
     */    
    public function bind(PdfPreset $preset, $args)
    {
        $newPage = $this->newPage(self::DEFAULT_PAGE_SIZE);

        $font = $this->getFontByName(self::DEFAULT_FONT);
        $this->setPageFont($newPage, $font, 14);
        
        foreach ($args as $key => $value) {
            if(!is_array($value)) {
                $coordinates = $preset->getPositionFor($key);

                if($coordinates) {
                    $this->drawTextOnPage($newPage, $value, $coordinates['left'], $coordinates['bottom']);
                }
            } else {
                $this->bind($preset, $value);
            }
        }
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
