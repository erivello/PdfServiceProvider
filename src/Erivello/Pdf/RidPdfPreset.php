<?php

namespace Erivello\Pdf;

use Erivello\Pdf\PdfPreset;

/**
 * RidPdfPreset
 *
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
class RidPdfPreset extends PdfPreset
{
    protected $coordinates = array(
        'nome' => '1234,98.76',
        'cognome' => '',
        'indirizzo' => '',
        'n_civico' => '',
        'cap' => '',
        'provincia' => '',
        'citta' => '',
        'telefono_fisso' => '',
        'telefono_cellulare' => '',
        'email' => '',
        'codice_fiscale' => '',
        'sesso' => '',
        'data_di_nascita' => 
            array(
                'year' => '',
                'month' => '',
                'day' => '',
            ),
        'comune_di_nascita' => '',
        'sei_gia_donatore_telethon' => '',
        'codice_donatore' => '',
        'periodicita' => '',
        'importo_prestabilito' => '',
        'altro_importo' => '',
        'iban' => '',
        'istituto_bancario_ufficio_postale' => '',
        'delega_di_pagamento' => 
            array(
                'delega_pagamento' => false
            ),
        'privacy' => 
            array(
                'privacy' => false
            ),
    );
}
