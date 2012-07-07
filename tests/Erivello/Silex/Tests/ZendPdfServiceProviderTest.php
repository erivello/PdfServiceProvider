<?php

namespace Erivello\Silex\Tests;

use Silex\Application;
use Erivello\Silex\ZendPdfServiceProvider;

class ZendPdfServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterWithNewDocument()
    {
        $app = new Application();
        
        $app->register(new ZendPdfServiceProvider());
        
        $this->assertTrue($app['zend.pdf'] instanceof \Zend\Pdf\PdfDocument);
    }
    
    /**
    * @expectedException \Zend\Pdf\Exception\CorruptedPdfException
    */
    public function testRegisterFailsIfSourceIsNotABinaryStringAndLoadIsFalse()
    {
        $app = new Application();
        
        $app->register(new ZendPdfServiceProvider(array(
            'zend.pdf.source' => 'Fixtures/Silex.pdf'
        )));        
    }    
    
    /**
    * @expectedException \Zend\Pdf\Exception\IOException
    */
    public function testRegisterFailsIfSourceIsNotAFileAndLoadIsTrue()
    {
        $app = new Application();
        
        $app->register(new ZendPdfServiceProvider(array(
            'zend.pdf.source' => 'Fixtures/Silez.pdf',
            'zend.pdf.load'   => true
        )));
    }    
    
    public function testRegisterWithValidSource()
    {
        $app = new Application();
        
        $app->register(new ZendPdfServiceProvider(array(
            'zend.pdf.source' => 'Fixtures/Silex.pdf',
            'zend.pdf.load'   => true
        )));
        
        $this->assertTrue($app['zend.pdf'] instanceof \Zend\Pdf\PdfDocument);
        $this->assertCount(87, count($app['zend.pdf']->pages));
        $this->assertEquals($app['zend.pdf']->properties['Title'], 'The Silex Book');
    }    
}