<?php

namespace Tests\Fields;

use Tests\TestCase;

class SelectFieldTest extends TestCase
{
    /** @test */
    public function it_returns_select_field_with_array_of_select_options()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" id="key" name="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= '<option value="1">Satu</option><option value="2">Dua</option></select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', [1 => 'Satu', 2 => 'Dua'])
        );
    }

    /** @test */
    public function it_returns_select_field_with_collection_of_select_options()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" id="key" name="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= '<option value="1">Satu</option>';
        $generatedString .= '<option value="2">Dua</option>';
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', collect([1 => 'Satu', 2 => 'Dua']))
        );
    }

    /** @test */
    public function it_returns_select_field_with_placeholder_set_to_false()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" id="key" name="key">';
        $generatedString .= '<option value="1">Satu</option>';
        $generatedString .= '<option value="2">Dua</option>';
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', [1 => 'Satu', 2 => 'Dua'], ['placeholder' => false])
        );
    }

    /** @test */
    public function it_returns_select_field_with_selected_values()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" id="key" name="key">';
        $generatedString .= '<option value="">-- Select Key --</option>';
        $generatedString .= '<option value="1">Satu</option>';
        $generatedString .= '<option value="2" selected="selected">Dua</option>';
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', [1 => 'Satu', 2 => 'Dua'], ['value' => 2])
        );
    }
}
