<?php

namespace Erivello\Pdf\Generator;

use ZendPdf\PdfDocument;
use ZendPdf\Page;
use ZendPdf\Font;
use ZendPdf\Color;
use ZendPdf\Image;
use Erivello\Pdf\Preset\PdfPreset;

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
     * @var \ZendPdf\PdfDocument
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
        $pageSizeConstant = constant('\ZendPdf\Page::' . $pageSize);

        $page = $this->pdf->newPage($pageSizeConstant);
        $this->pdf->pages[] = $page;

        return $page;
    }

    /**
     * @{inheritDoc}
     */
    public function getFontByName($fontName)
    {
        $fontConstant = constant('\ZendPdf\Font::' . $fontName);

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
        return $page->drawText($text, $left, $bottom, $encoding);
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
    public function drawLineOnPage(Page $page, $width, $x1, $y1, $x2, $y2)
    {
        return $page
                ->setLineWidth($width)
                ->drawLine($x1, $y1, $x2, $y2)
            ;
    }

    /**
     * @{inheritDoc}
     */
    public function setPageFont(Page $page, $fontName, $fontSize)
    {
        $font = $this->getFontByName($fontName);

        return $page->setFont($font, $fontSize);
    }

    /**
     * @{inheritDoc}
     */
    public function setPageFillColor(Page $page, Color\ColorInterface $color)
    {
        return $page->setFillColor($color);
    }

    /**
     * @{inheritDoc}
     */
    public function bind(PdfPreset $preset, $args, $pageSize = self::DEFAULT_PAGE_SIZE, $fontName = self::DEFAULT_FONT)
    {
        $newPage = $this->newPage($pageSize);

        $this->setPageFont($newPage, $fontName, 14);

        foreach ($args as $key => $value) {
            if (!is_array($value)) {
                $coordinates = $preset->getPositionFor($key);

                if ($coordinates) {
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
