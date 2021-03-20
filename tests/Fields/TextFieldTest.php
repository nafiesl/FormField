<?php

namespace Tests\Fields;

use Tests\TestCase;

class TextFieldTest extends TestCase
{
    /** @test */
    public function it_returns_default_text_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
        $generatedString .= '<input class="form-control" readonly name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['readonly' => true])
        );
    }

    /** @test */
    public function it_returns_text_field_with_autofocus_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>';
        $generatedString .= '<input class="form-control" autofocus name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['autofocus' => true])
        );
    }

    /** @test */
    public function it_returns_text_field_with_min_and_max_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>';
        $generatedString .= '<input class="form-control" min="20" max="100" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['min' => 20, 'max' => 100])
        );
    }

    /** @test */
    public function it_returns_range_field_with_min_max_and_step_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>';
        $generatedString .= '<input class="form-control" min="20" max="100" step="5" name="key" type="range" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['type' => 'range', 'min' => 20, 'max' => 100, 'step' => 5])
        );
    }

    /** @test */
    public function it_returns_text_field_with_placeholder_attribute()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="form-label">Key</label>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<span class="input-group-prepend"><div class="input-group-text">$</div></span>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '<span class="input-group-append"><div class="input-group-text">Days</div></span>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
        $generatedString .= '<input class="form-control is-invalid" name="key" type="text" id="key">';
        $generatedString .= '<span class="invalid-feedback" role="alert">The key field is required.</span>';
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
        $generatedString .= '<label for="key[0]" class="form-label">Key[0]</label>';
        $generatedString .= '<input class="form-control is-invalid" name="key[0]" type="text" id="key[0]">';
        $generatedString .= '<span class="invalid-feedback" role="alert">The key field is required.</span>';
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
        $generatedString .= '<label for="price" class="form-label">Price</label>';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<span class="input-group-prepend"><div class="input-group-text">Rp</div></span>';
        $generatedString .= '<input class="form-control text-right" name="price" type="text" id="price">';
        $generatedString .= '</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->price('price')
        );
    }

    /** @test */
    public function it_returns_price_field_with_correct_given_class()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="price" class="form-label">Price</label>';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<span class="input-group-prepend"><div class="input-group-text">Rp</div></span>';
        $generatedString .= '<input class="form-control custom-class text-right" name="price" type="text" id="price">';
        $generatedString .= '</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->price('price', ['class' => 'custom-class'])
        );
    }

    /** @test */
    public function it_returns_email_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="email" class="form-label">Email</label>';
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
        $generatedString .= '<label for="password" class="form-label">Password</label>';
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
        $generatedString .= '<label for="key" class="form-label">Key</label>';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->plainText('key')
        );
    }
}
