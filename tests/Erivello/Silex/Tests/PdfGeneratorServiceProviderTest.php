<?php

namespace Erivello\Silex\Tests;

use Silex\Application;
use Erivello\Silex\PdfGeneratorServiceProvider;

class PdfGeneratorServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        $app = new Application();
        
        $app->register(new PdfGeneratorServiceProvider());
        
        $this->assertTrue($app['pdf.generator'] instanceof \Erivello\Pdf\Generator\PdfGenerator);
    }  
}
