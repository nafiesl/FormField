<?php

namespace Tests;

use Luthfi\FormField\FormField;
use Luthfi\FormField\FormFieldServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected $formField;

    protected function setUp()
    {
        parent::setUp();
        $this->formField = new FormField();
    }

    protected function getPackageProviders($app)
    {
        return [FormFieldServiceProvider::class];
    }
}
