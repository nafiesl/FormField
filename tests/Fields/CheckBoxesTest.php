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
        $generatedString .= '<ul class="checkbox list-inline">';
        $generatedString .= '<li><label for="checkboxes_1"><input id="checkboxes_1" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
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
        $generatedString .= '<ul class="checkbox list-inline">';
        $generatedString .= '<li><label for="checkboxes_1"><input id="checkboxes_1" checked="checked" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
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
        $generatedString .= '<ul class="checkbox list-inline">';
        $generatedString .= '<li><label for="checkboxes_1"><input id="checkboxes_1" checked="checked" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="checkboxes_2"><input id="checkboxes_2" checked="checked" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
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
        $generatedString .= '<ul class="checkbox list-inline">';
        $generatedString .= '<li><label for="checkboxes_1"><input id="checkboxes_1" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
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
        $generatedString .= '<ul class="checkbox list-inline">';
        $generatedString .= '<li><label for="checkboxes_1"><input id="checkboxes_1" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua'], ['required' => true])
        );
    }

    /** @test */
    public function it_shows_checkboxes_with_validation_error()
    {
        // Mock error message on "checkboxes" attribute.
        $errorBag = new \Illuminate\Support\MessageBag();
        $errorBag->add('checkboxes', 'The checkboxes field is required.');

        $this->formField->errorBag = $errorBag;

        $generatedString = '<div class="form-group has-error">';
        $generatedString .= '<label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;';
        $generatedString .= '<ul class="checkbox list-inline">';
        $generatedString .= '<li><label for="checkboxes_1"><input id="checkboxes_1" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li>';
        $generatedString .= '<li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li>';
        $generatedString .= '</ul>';
        $generatedString .= '<span class="help-block small">The checkboxes field is required.</span>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua'])
        );
    }
}
