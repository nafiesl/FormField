<?php

namespace Tests\Fields;

use Tests\TestCase;

class MultiSelectFieldTest extends TestCase
{
    /** @test */
    public function it_returns_multi_select_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" multiple name="key[]" id="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= '<option value="1">Satu</option>';
        $generatedString .= '<option value="2">Dua</option>';
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->multiSelect('key', [1 => 'Satu', 2 => 'Dua'])
        );
    }

    /** @test */
    public function it_returns_multi_select_field_with_array_of_selected_values()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" multiple name="key[]" id="key">';
        $generatedString .= '<option value="">-- Select Key --</option>';
        $generatedString .= '<option value="1">Satu</option>';
        $generatedString .= '<option value="2" selected="selected">Dua</option>';
        $generatedString .= '<option value="3" selected="selected">Tiga</option>';
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->multiSelect('key', [1 => 'Satu', 2 => 'Dua', 3 => 'Tiga'], ['value' => [2, 3]])
        );
    }

    /** @test */
    public function it_returns_multi_select_field_with_collection_of_selected_values()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" multiple name="key[]" id="key">';
        $generatedString .= '<option value="">-- Select Key --</option>';
        $generatedString .= '<option value="1">Satu</option>';
        $generatedString .= '<option value="2" selected="selected">Dua</option>';
        $generatedString .= '<option value="3" selected="selected">Tiga</option>';
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->multiSelect('key', [1 => 'Satu', 2 => 'Dua', 3 => 'Tiga'], ['value' => collect([2, 3])])
        );
    }
}
