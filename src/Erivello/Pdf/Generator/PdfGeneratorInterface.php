<?php

namespace Erivello\Pdf\Generator;

/**
 * PdfGeneratorInterface
 *
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
interface PdfGeneratorInterface
{
    /**
     * Get {@link \Zend\Pdf\PdfDocument} object
     *
     * @return \Zend\Pdf\PdfDocument
     */
    public function getPdf();

    /**
     * Set {@link \Erivello\Pdf\PdfGenerator} object
     *
     * @param  \Zend\Pdf\PdfDocument      $pdf
     * @return \Erivello\Pdf\PdfGenerator
     */
    public function setPdf(\Zend\Pdf\PdfDocument $pdf);

    /**
     * Pages collection
     *
     * @return array array of \Zend\Pdf\Page object
     */
    public function getPages();

    /**
     * Create a {@link \Zend\Pdf\Page} object, attached to the PDF document.
     *
     * @param string $pageSize
     * @return
     */
    public function newPage($pageSize);

    /**
     * Obtain a {@link \Zend\ZPdf\Resource\Font\AbstractFont}, one of the standard 14 PDF fonts
     *
     * @param  string                                $fontName Full PostScript name of font.
     * @return \Zend\ZPdf\Resource\Font\AbstractFont
     */
    public function getFontByName($fontName);

    /**
     * Obtain a {@link \Zend\Pdf\Color\Html} for graphics objects
     *
     * @param  mixed                $color Typical HTML representations (#f00, red)
     * @return \Zend\Pdf\Color\Html
     */
    public function getColorHtml($color);

    /**
     * Returns a {@link \Zend\Pdf\Resource\Image\AbstractImage} object by file path.
     *
     * @param  string                                 $filePath Full path to the image file.
     * @return \Zend\Pdf\Resource\Image\AbstractImage
     * @throws \Zend\Pdf\Exception
     */
    public function getImage($filePath);

    /**
     * Get document property
     *
     * @param  string $property
     * @return string the property value
     *
     * Standard document properties: Title (must be set for PDF/X documents), Author,
     * Subject, Keywords (comma separated list), Creator (the name of the application,
     * that created document, if it was converted from other format), Trapped (must be
     * true, false or null, can not be null for PDF/X documents)
     */
    public function getPropertyValue($property);

    /**
     * Set document property
     *
     * @param  string                     $property
     * @param  string                     $value
     * @return \Erivello\Pdf\PdfGenerator
     *
     * Standard document properties: Title (must be set for PDF/X documents), Author,
     * Subject, Keywords (comma separated list), Creator (the name of the application,
     * that created document, if it was converted from other format), Trapped (must be
     * true, false or null, can not be null for PDF/X documents)
     */
    public function setPropertyValue($property, $value);

    /**
     * Draw text at the specified position on the page.
     *
     * @param  \Zend\Pdf\Page      $page     The page to draw text in
     * @param  string              $text
     * @param  float               $left
     * @param  float               $bottom
     * @param  string              $encoding Character encoding of source text
     * @throws \Zend\Pdf\Exception
     * @return \Zend\Pdf\Page
     */
    public function drawTextOnPage(\Zend\Pdf\Page $page, $text, $left, $bottom, $encoding = 'UTF-8');

    /**
     * Draw an image at the specified position on the page.
     *
     * @param  \Zend\Pdf\Page  $page   The page to draw text in
     * @param  \Zend\Pdf\Image $image
     * @param  float           $left
     * @param  float           $bottom
     * @param  float           $right
     * @param  float           $top
     * @return \Zend\Pdf\Page
     */
    public function drawImageOnPage(\Zend\Pdf\Page $page, $image, $left, $bottom, $right, $top);

    /**
     * Set current font in the given page
     *
     * @param  \Zend\Pdf\Page $page     The page to draw text in
     * @param  string         $fontName Full PostScript name of font.
     * @param  float          $fontSize
     * @return \Zend\Pdf\Page
     */
    public function setPageFont(\Zend\Pdf\Page $page, $fontName, $fontSize);

    /**
     * Set fill color in the given page
     *
     * @param  \Zend\Pdf\Page  $page  The page to draw text in
     * @param  \Zend\Pdf\Color $color
     * @return \Zend\Pdf\Page
     */
    public function setPageFillColor(\Zend\Pdf\Page $page, \Zend\Pdf\Color\ColorInterface $color);

    /**
     * Draw text given in input
     *
     * @param PdfPreset $preset
     * @param array     $args   Array of texts to be drawn ('tel => '1234567')
     */
    public function bind(\Erivello\Pdf\Preset\PdfPreset $preset, $args);

    /**
     * Render the completed PDF to a string.
     *
     * @return string
     * @throws \Zend\Pdf\Exception
     */
    public function render();

    /**
     * Render PDF document and save it.
     *
     * @param  string                     $filename
     * @throws \Zend\Pdf\Exception
     * @return \Erivello\Pdf\PdfGenerator
     */
    public function save($filename);
}
