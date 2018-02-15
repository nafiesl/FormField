<?php

namespace Tests\Fields;

use Tests\TestCase;

class RadiosTest extends TestCase
{
    /** @test */
    public function it_returns_radios_field_with_array_of_radio_options()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="radios" class="control-label">Radios</label>&nbsp;';
        $generatedString .= '<ul class="radio list-inline">';
        $generatedString .= '<li><label for="radios_1"><input id="radios_1" name="radios" type="radio" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="radios_2"><input id="radios_2" name="radios" type="radio" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->radios('radios', [1 => 'Satu', 2 => 'Dua'])
        );
    }

    /** @test */
    public function it_returns_radios_field_with_collection_of_radio_options()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="radios" class="control-label">Radios</label>&nbsp;';
        $generatedString .= '<ul class="radio list-inline">';
        $generatedString .= '<li><label for="radios_1"><input id="radios_1" name="radios" type="radio" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="radios_2"><input id="radios_2" name="radios" type="radio" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->radios('radios', collect([1 => 'Satu', 2 => 'Dua']))
        );
    }

    /** @test */
    public function it_returns_radios_field_with_default_value()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="radios" class="control-label">Radios</label>&nbsp;';
        $generatedString .= '<ul class="radio list-inline">';
        $generatedString .= '<li><label for="radios_1"><input id="radios_1" name="radios" type="radio" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="radios_2"><input id="radios_2" checked="checked" name="radios" type="radio" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->radios('radios', [1 => 'Satu', 2 => 'Dua'], ['value' => 2])
        );
    }

    /** @test */
    public function it_returns_radios_field_with_info_text_line()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="radios" class="control-label">Radios</label>&nbsp;';
        $generatedString .= '<ul class="radio list-inline">';
        $generatedString .= '<li><label for="radios_1"><input id="radios_1" name="radios" type="radio" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="radios_2"><input id="radios_2" name="radios" type="radio" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
        $generatedString .= '<p class="text-info small">Field text info.</p>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->radios('radios', [1 => 'Satu', 2 => 'Dua'], [
                'info' => ['text' => 'Field text info.'],
            ])
        );
    }

    /** @test */
    public function it_returns_radios_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group required ">';
        $generatedString .= '<label for="radios" class="control-label">Radios</label>&nbsp;';
        $generatedString .= '<ul class="radio list-inline">';
        $generatedString .= '<li><label for="radios_1"><input id="radios_1" required name="radios" type="radio" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="radios_2"><input id="radios_2" required name="radios" type="radio" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->radios('radios', [1 => 'Satu', 2 => 'Dua'], [
                'required' => true,
            ])
        );
    }
}
