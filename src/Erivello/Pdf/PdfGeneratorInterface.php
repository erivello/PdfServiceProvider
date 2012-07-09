<?php

namespace Erivello\Pdf;

/**
 * PdfGeneratorInterface
 * 
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
interface PdfGeneratorInterface
{
    /**
     * Pages collection
     * 
     * @param  \Zend\Pdf\PdfDocument $pdfDocument PDF document
     * @return array array of \Zend\Pdf\Page object
     */
    function getPages($pdfDocument);

    /**
     * Obtain one of the standard 14 PDF fonts
     * 
     * @param  string $font Full PostScript name of font.
     * @return \Zend\Pdf\Resource\Font\AbstractFont
     */
    function getFontByName($font);

    /**
     * Obtain one color for graphics objects
     * 
     * @param  mixed $color Typical HTML representations (#f00, red)
     * @return \Zend\Pdf\Color
     */
    function getColorHtml($color);
    
    /**
     * Draw text at the drawing coordinates given in points
     * 
     * @param  \Zend\Pdf\Page $page The page to draw text in
     * @param  string $text Text to be drawn
     * @param  float $left Left coordinate
     * @param  float $right Right coordinate
     * @param  string $encoding Character encoding of source text
     * @return \Zend\Pdf\Page
     */
    function drawTextOnPage($page, $text, $leftCoordinate, $bottomCoordinate, $encoding = 'UTF-8');
    
    /**
     * Set current font in the given page
     * 
     * @param  \Zend\Pdf\Page $page The page to draw text in
     * @param  \Zend\Pdf\Resource\Font\AbstractFont $font The font to be drawn
     * @param  float $fontSize
     * @return \Zend\Pdf\Page
     */
    function setPageFont($page, $font, $fontSize);
    
    /**
     * Set fill color in the given page
     * 
     * @param  \Zend\Pdf\Page $page The page to draw text in
     * @param  \Zend\Pdf\Color $color 
     * @return \Zend\Pdf\Page
     */
    function setPageFillColor($page, $color);
    
    /**
     * Draw text given in input
     * 
     * @param $preset
     * @param array $args Array of texts to be drawn ('tel => '1234567')
     */
    function bind($preset, $args);
    
    /**
     * Render the completed PDF to a string.
     * 
     * @return string
     * @throws \Zend\Pdf\Exception
     */
    function render();

    /**
     * Render PDF document and save it.
     * 
     * @param string $filename
     * @throws \Zend\Pdf\Exception
     */
    function save($filename);
}