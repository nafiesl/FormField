<?php

namespace Tests\Fields;

use Tests\TestCase;

class TextFieldTest extends TestCase
{
    /** @test */
    public function it_returns_default_text_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key')
        );
    }

    /** @test */
    public function it_returns_text_field_with_class_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control testing-class" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['class' => 'testing-class'])
        );
    }

    /** @test */
    public function it_returns_text_field_with_disabled_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" disabled name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['disabled' => true])
        );
    }

    /** @test */
    public function it_returns_text_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group required ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" required name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['required' => true])
        );
    }

    /** @test */
    public function it_returns_text_field_with_readonly_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" readonly name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['readonly' => true])
        );
    }

    /** @test */
    public function it_returns_text_field_with_min_and_max_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" min="20" max="100" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['min' => 20, 'max' => 100])
        );
    }

    /** @test */
    public function it_returns_text_field_with_placeholder_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" placeholder="Testing" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['placeholder' => 'Testing'])
        );
    }

    /** @test */
    public function it_returns_text_field_with_style_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" style="color:blue;" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['style' => 'color:blue;'])
        );
    }

    /** @test */
    public function it_returns_text_field_with_id_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" id="the_key_id" name="key" type="text">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['id' => 'the_key_id'])
        );
    }

    /** @test */
    public function it_returns_text_field_with_info_text_line()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '<p class="text-info small">Field text info.</p>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['info' => ['text' => 'Field text info.']])
        );
    }

    /** @test */
    public function it_returns_text_field_with_addon_before()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<span class="input-group-addon">$</span>';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['addon' => ['before' => '$']])
        );
    }

    /** @test */
    public function it_returns_text_field_with_addon_after()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '<span class="input-group-addon">Days</span>';
        $generatedString .= '</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['addon' => ['after' => 'Days']])
        );
    }

    /** @test */
    public function it_shows_text_field_with_validation_error()
    {
        // Mock error message on "key" attribute.
        $errorBag = new \Illuminate\Support\MessageBag();
        $errorBag->add('key', 'The key field is required.');

        $this->formField->errorBag = $errorBag;

        $generatedString = '<div class="form-group has-error">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '<span class="help-block small">The key field is required.</span>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key')
        );
    }

    /** @test */
    public function it_shows_text_field_with_array_name_that_has_correct_validation_error()
    {
        // Mock error message on "key" attribute.
        $errorBag = new \Illuminate\Support\MessageBag();
        $errorBag->add('key.0', 'The key field is required.');

        $this->formField->errorBag = $errorBag;

        $generatedString = '<div class="form-group has-error">';
        $generatedString .= '<label for="key[0]" class="control-label">Key[0]</label>&nbsp;';
        $generatedString .= '<input class="form-control" name="key[0]" type="text" id="key[0]">';
        $generatedString .= '<span class="help-block small">The key field is required.</span>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key[0]')
        );
    }

    /** @test */
    public function it_returns_price_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="price" class="control-label">Price</label>&nbsp;';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<span class="input-group-addon">Rp</span>';
        $generatedString .= '<input class="form-control text-right" name="price" type="text" id="price">';
        $generatedString .= '</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->price('price')
        );
    }

    /** @test */
    public function it_returns_email_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="email" class="control-label">Email</label>&nbsp;';
        $generatedString .= '<input class="form-control" name="email" type="email" id="email">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->email('email')
        );
    }

    /** @test */
    public function it_returns_password_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="password" class="control-label">Password</label>&nbsp;';
        $generatedString .= '<input class="form-control" name="password" type="password" id="password">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->password('password')
        );
    }

    /** @test */
    public function it_returns_plain_text_field_with_view_template()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->plainText('key')
        );
    }
}
