<?php

namespace Tests\Fields;

use Tests\TestCase;

class CheckBoxesTest extends TestCase
{
    /** @test */
    public function it_returns_checkboxes_field()
    {
        $textFieldString = '<div class="form-group ">';
        $textFieldString .= '<label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;';
        $textFieldString .= '<ul class="checkbox list-inline">';
        $textFieldString .= '<li><label for="checkboxes_1"><input id="checkboxes_1" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li>';
        $textFieldString .= '<li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li>';
        $textFieldString .= '</ul>';
        $textFieldString .= '</div>';
        $this->assertEquals($textFieldString, $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua']));
    }

    /** @test */
    public function it_returns_checkboxes_field_with_checked_value_collection()
    {
        $textFieldString = '<div class="form-group ">';
        $textFieldString .= '<label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;';
        $textFieldString .= '<ul class="checkbox list-inline">';
        $textFieldString .= '<li><label for="checkboxes_1"><input id="checkboxes_1" checked="checked" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li>';
        $textFieldString .= '<li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li>';
        $textFieldString .= '</ul>';
        $textFieldString .= '</div>';

        // Checked option key : 1, formated in Laravel collection
        $options = ['value' => collect([1])];

        $this->assertEquals($textFieldString, $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua'], $options));
    }

    /** @test */
    public function it_returns_checkboxes_field_with_checked_value_array()
    {
        $textFieldString = '<div class="form-group ">';
        $textFieldString .= '<label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;';
        $textFieldString .= '<ul class="checkbox list-inline">';
        $textFieldString .= '<li><label for="checkboxes_1"><input id="checkboxes_1" checked="checked" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li>';
        $textFieldString .= '<li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li>';
        $textFieldString .= '</ul>';
        $textFieldString .= '</div>';

        // Checked option key : 1, formated in array
        $options = ['value' => [1]];

        $this->assertEquals($textFieldString, $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua'], $options));
    }
}
