ZendPdfServiceProvider
======================

A [Zend_Pdf][1] Service Provider for [Silex][2].

[![Build Status](https://secure.travis-ci.org/erivello/PdfServiceProvider.png?branch=master)](http://travis-ci.org/erivello/PdfServiceProvider)

Installation
------------

Installation is very easy, it makes use of [Composer][3].

### Install Composer

Run this in your command line:

``` bash
$ curl -s http://getcomposer.org/installer | php
```

Or [download composer.phar][4] into the project root.

### Add ZendPdfServiceProvider to your composer.json

    "require": {
        "php": "> 5.3.3",
        "erivello/zend-pdf-service-provider": "dev-master"
    }

### Install Dependencies

Run the following command:

``` bash
$ php composer.phar install
```

Now ZendPdfServiceProvider is installed into your vendor directory.

Registering
-----------

    $app->register(new Erivello\Silex\ZendPdfServiceProvider(), array(
        'zend.pdf.source'   => __DIR__.'/Fixtures/Silex.pdf',
        'zend.pdf.revision' => 1,
        'zend.pdf.load'     => true
    ));

Options
-------

* ```zend.pdf.source``` - PDF file to load.
* ```zend.pdf.revision``` - revision used to roll back document to specified version (0 - currtent version, 1 - previous version, 2 - ...).
* ```zend.pdf.load``` - If ```zend.pdf.source``` is a string and ```zend.pdf.load``` is false, then it loads document from a binary string. If ```zend.pdf.source``` is a string and ```zend.pdf.load``` is true, then it loads document from a file.

Services
--------

* ```zend.pdf``` - The ```Zend\Pdf\PdfDocument``` instance.

Usage
--------

You can access the ZendPdfServiceProvider by calling ``$app['zend.pdf']``.


Tests
-----

``` bash
$ php composer.phar install && phpunit
```

License
-------

The ZendPdfServiceProvider is licensed under the MIT license.

[1]: http://framework.zend.com/manual/en/zend.pdf.html
[2]: http://silex.sensiolabs.org/
[3]: http://getcomposer.org/
[4]: http://getcomposer.org/composer.phar
