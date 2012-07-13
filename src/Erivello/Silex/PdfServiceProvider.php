<?php

/*
 * This file is part of PdfServiceProvider.
 *
 * (c) Edoardo Rivello <edoardo.rivello@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Erivello\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Pdf Provider.
 *
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
class PdfServiceProvider implements ServiceProviderInterface
{
    /**
     * @{inheritDoc}
     */
    public function register(Application $app)
    {
        $app['pdf.generator.class']  = 'Erivello\Pdf\Generator\PdfGenerator';
        $app['pdf.rid.preset.class'] = 'Erivello\Pdf\Preset\RidPdfPreset';
        $app['pdf.cc.preset.class']  = 'Erivello\Pdf\Preset\CCPdfPreset';
        
        $app['pdf.generator'] = $app->share(function() use ($app) {
            
            $pdfGenerator = new $app['pdf.generator.class'];
            
            return $pdfGenerator;
        });
        
        $app['pdf.rid.preset'] = $app->share(function() use ($app) {
        
            $ridPreset = new $app['pdf.rid.preset.class'];
            
            return $ridPreset;
        });

        $app['pdf.cc.preset'] = $app->share(function() use ($app) {
        
            $ccPreset = new $app['pdf.cc.preset.class'];
            
            return $ccPreset;
        });
    }
    
    /**
     * @{inheritDoc}
     */
    public function boot(Application $app) {

    }
}