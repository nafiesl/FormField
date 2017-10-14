<?php

namespace Tests;

use Luthfi\FormField\FormFieldFacade as FFF;

class FormFieldTest extends TestCase
{
    /** @test */
    public function it_has_facade_accessor()
    {
        $this->assertEquals(FFF::text('key'), $this->formField->text('key'));
    }

    /** @test */
    public function it_returns_form_open()
    {
        $generatedString = '<form method="POST" action="http://localhost" accept-charset="UTF-8">';
        $generatedString .= '<input name="_token" type="hidden">';

        $this->assertEquals($generatedString, $this->formField->open());
    }

    /** @test */
    public function it_returns_form_close()
    {
        $genereatedString = '</form>';

        $this->assertEquals($genereatedString, $this->formField->close());
    }
}
