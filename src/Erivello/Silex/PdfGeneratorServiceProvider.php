<?php

/*
 * This file is part of PdfGeneratorServiceProvider.
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
 * PdfGenerator Provider.
 *
 * @author Edoardo Rivello <edoardo.rivello@gmail.com>
 */
class PdfGeneratorServiceProvider implements ServiceProviderInterface
{
    /**
     * @{inheritDoc}
     */
    public function register(Application $app)
    {
        $app['pdf.generator.class'] = 'Erivello\Pdf\PdfGenerator';
        
        $app['pdf.generator'] = $app->share(function() use ($app) {
            
            $pdfGenerator = new $app['pdf.generator.class'];
            
            return $pdfGenerator;
            
        });
    }
    
    /**
     * @{inheritDoc}
     */
    public function boot(Application $app) {

    }
}