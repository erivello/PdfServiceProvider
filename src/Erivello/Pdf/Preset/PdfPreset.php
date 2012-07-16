<?php

namespace Erivello\Pdf\Preset;

/**
 * PdfPreset
 *
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
class PdfPreset implements PdfPresetInterface
{
    /**
     * @{inheritDoc}
     */
    public function getPositionFor($key)
    {
        if (!array_key_exists($key, $this->coordinates)) {
            return false;
        }

        $value = $this->coordinates[$key];
        $coordinates = explode(',', $value);

        $position = array(
            'left'   => (float) $coordinates[0],
            'bottom' => (float) $coordinates[1]
        );

        return $position;
    }
}
