<?php
/*
* This file is part of ZendPDFServiceProvider.
*
* (c) Edoardo Rivello <edoardo.rivello@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Erivello\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ZendPdfServiceProvider implements ServiceProviderInterface
{
    /**
     * @{inheritDoc}
     */
    public function register(Application $app)
    {
        $app['zend.pdf'] = $app->share(function() use ($app) {
            
            $source   = isset ($app['zend.pdf.source']) ? $app['zend.pdf.source'] : null;
            $revision = isset ($app['zend.pdf.revision']) ? $app['zend.pdf.revision'] : null;
            $load     = isset ($app['zend.pdf.load']) ? $app['zend.pdf.load'] : false;
            
            return new \Zend\Pdf\PdfDocument($source, $revision, $load);
        });
    }
    
    /**
     * @{inheritDoc}
     */
    public function boot(Application $app) {

    }
}