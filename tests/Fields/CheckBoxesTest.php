<?php

namespace Tests\Fields;

use Tests\TestCase;

class CheckBoxesTest extends TestCase
{
    /** @test */
    public function it_returns_default_checkboxes_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_1" class="form-check-input" name="checkboxes[]" type="checkbox" value="1"><label for="checkboxes_1" class="form-check-label">Satu</label></div>';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_2" class="form-check-input" name="checkboxes[]" type="checkbox" value="2"><label for="checkboxes_2" class="form-check-label">Dua</label></div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua'])
        );
    }

    /** @test */
    public function it_returns_checkboxes_field_with_checked_value_collection()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_1" class="form-check-input" checked="checked" name="checkboxes[]" type="checkbox" value="1"><label for="checkboxes_1" class="form-check-label">Satu</label></div>';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_2" class="form-check-input" name="checkboxes[]" type="checkbox" value="2"><label for="checkboxes_2" class="form-check-label">Dua</label></div>';
        $generatedString .= '</div>';

        // Checked option key : 1, formated in Laravel collection
        $options = ['value' => collect([1])];

        $this->assertEquals(
            $generatedString,
            $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua'], $options)
        );
    }

    /** @test */
    public function it_returns_checkboxes_field_with_checked_value_array()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_1" class="form-check-input" checked="checked" name="checkboxes[]" type="checkbox" value="1"><label for="checkboxes_1" class="form-check-label">Satu</label></div>';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_2" class="form-check-input" checked="checked" name="checkboxes[]" type="checkbox" value="2"><label for="checkboxes_2" class="form-check-label">Dua</label></div>';
        $generatedString .= '</div>';

        // Checked option key : 1 and 2, formated in array
        $options = ['value' => [1, 2]];

        $this->assertEquals(
            $generatedString,
            $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua'], $options)
        );
    }

    /** @test */
    public function it_returns_checkboxes_field_with_info_text_line()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_1" class="form-check-input" name="checkboxes[]" type="checkbox" value="1"><label for="checkboxes_1" class="form-check-label">Satu</label></div>';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_2" class="form-check-input" name="checkboxes[]" type="checkbox" value="2"><label for="checkboxes_2" class="form-check-label">Dua</label></div>';
        $generatedString .= '<p class="text-info small">Field text info.</p>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua'], [
                'info' => ['text' => 'Field text info.'],
            ])
        );
    }

    /** @test */
    public function it_returns_checkboxes_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group required ">';
        $generatedString .= '<label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_1" class="form-check-input" name="checkboxes[]" type="checkbox" value="1"><label for="checkboxes_1" class="form-check-label">Satu</label></div>';
        $generatedString .= '<div class="checkbox form-check"><input id="checkboxes_2" class="form-check-input" name="checkboxes[]" type="checkbox" value="2"><label for="checkboxes_2" class="form-check-label">Dua</label></div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua'], ['required' => true])
        );
    }
}
