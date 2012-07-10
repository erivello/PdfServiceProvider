<?php

namespace Erivello\Pdf;

/**
 *
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
interface PdfPresetInterface 
{
    /**
     * Get position for the given key
     * 
     * @param string $key
     * @return array of coordinates (array('left' => 1234, 'bottom' => 12345))
     */
    function getPositionFor($key);
}
