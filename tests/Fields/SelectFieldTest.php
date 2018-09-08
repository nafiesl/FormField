<?php

namespace Tests\Fields;

use Tests\TestCase;

class SelectFieldTest extends TestCase
{
    protected $selectOptions = [1 => 'Satu', 2 => 'Dua'];
    protected $selectOptionsString = '<option value="1">Satu</option><option value="2">Dua</option>';

    /** @test */
    public function it_returns_select_field_with_array_of_select_options()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" id="key" name="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= $this->selectOptionsString;
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', $this->selectOptions)
        );
    }

    /** @test */
    public function it_returns_select_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group required ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" required id="key" name="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= $this->selectOptionsString;
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', $this->selectOptions, ['required' => true])
        );
    }

    /** @test */
    public function it_returns_select_field_with_disabled_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" disabled id="key" name="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= $this->selectOptionsString;
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', $this->selectOptions, ['disabled' => true])
        );
    }

    /** @test */
    public function it_returns_select_field_with_readonly_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" readonly id="key" name="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= $this->selectOptionsString;
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', $this->selectOptions, ['readonly' => true])
        );
    }

    /** @test */
    public function it_returns_select_field_with_collection_of_select_options()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" id="key" name="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= $this->selectOptionsString;
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', collect($this->selectOptions))
        );
    }

    /** @test */
    public function it_returns_select_field_with_placeholder_set_to_false()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" id="key" name="key">';
        $generatedString .= $this->selectOptionsString;
        $generatedString .= '</select>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', $this->selectOptions, ['placeholder' => false])
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
            $this->formField->select('key', $this->selectOptions, ['value' => 2])
        );
    }

    /** @test */
    public function it_returns_select_field_with_info_text_line()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control" id="key" name="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= $this->selectOptionsString;
        $generatedString .= '</select>';
        $generatedString .= '<p class="text-info small">Field text info.</p>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', $this->selectOptions, [
                'info' => ['text' => 'Field text info.'],
            ])
        );
    }

    /** @test */
    public function it_shows_select_field_with_validation_error()
    {
        // Mock error message on "key" attribute.
        $errorBag = new \Illuminate\Support\MessageBag();
        $errorBag->add('key', 'The key field is required.');

        $this->formField->errorBag = $errorBag;

        $generatedString = '<div class="form-group has-error">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<select class="form-control is-invalid" id="key" name="key">';
        $generatedString .= '<option value="" selected="selected">-- Select Key --</option>';
        $generatedString .= $this->selectOptionsString;
        $generatedString .= '</select>';
        $generatedString .= '<span class="help-block small invalid-feedback">The key field is required.</span>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->select('key', $this->selectOptions)
        );
    }
}
