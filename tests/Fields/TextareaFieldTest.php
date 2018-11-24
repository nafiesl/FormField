<?php

namespace Tests\Fields;

use Tests\TestCase;

class TextareaFieldTest extends TestCase
{
    /** @test */
    public function it_returns_default_textarea_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key')
        );
    }

    /** @test */
    public function it_returns_textarea_field_with_rows_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" rows="5" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', ['rows' => 5])
        );
    }

    /** @test */
    public function it_returns_textarea_field_with_class_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control testing-class" rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', ['class' => 'testing-class'])
        );
    }

    /** @test */
    public function it_returns_text_field_with_disabled_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" disabled rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', ['disabled' => true])
        );
    }

    /** @test */
    public function it_returns_text_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group required ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" required rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', ['required' => true])
        );
    }

    /** @test */
    public function it_returns_text_field_with_readonly_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" readonly rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', ['readonly' => true])
        );
    }

    /** @test */
    public function it_returns_text_field_with_placeholder_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" placeholder="Testing" rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', ['placeholder' => 'Testing'])
        );
    }

    /** @test */
    public function it_returns_textarea_field_with_style_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" style="color:blue;" rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', ['style' => 'color:blue;'])
        );
    }

    /** @test */
    public function it_returns_textarea_field_with_id_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" id="the_key_id" rows="3" name="key" cols="50"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', ['id' => 'the_key_id'])
        );
    }

    /** @test */
    public function it_returns_textarea_field_with_info_text_line()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '<p class="text-info small">Field text info.</p>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', ['info' => ['text' => 'Field text info.']])
        );

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key', [
                'info' => ['text' => 'Field text info.', 'class' => 'info'],
            ])
        );
    }

    /** @test */
    public function it_shows_textarea_field_with_validation_error()
    {
        // Mock error message on "key" attribute.
        $errorBag = new \Illuminate\Support\MessageBag();
        $errorBag->add('key', 'The key field is required.');

        $this->formField->errorBag = $errorBag;

        $generatedString = '<div class="form-group has-error">';
        $generatedString .= '<label for="key" class="form-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control is-invalid" rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '<span class="invalid-feedback" role="alert">The key field is required.</span>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key')
        );
    }

    /** @test */
    public function it_shows_textarea_field_with_array_name_that_has_correct_validation_error()
    {
        // Mock error message on "key" attribute.
        $errorBag = new \Illuminate\Support\MessageBag();
        $errorBag->add('key.0', 'The key field is required.');

        $this->formField->errorBag = $errorBag;

        $generatedString = '<div class="form-group has-error">';
        $generatedString .= '<label for="key[0]" class="form-label">Key[0]</label>&nbsp;';
        $generatedString .= '<textarea class="form-control is-invalid" rows="3" name="key[0]" cols="50" id="key[0]"></textarea>';
        $generatedString .= '<span class="invalid-feedback" role="alert">The key field is required.</span>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key[0]')
        );
    }
}
