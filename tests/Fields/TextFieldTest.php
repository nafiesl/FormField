<?php

namespace Tests\Fields;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TextFieldTest extends TestCase
{
    #[Test]
    public function it_returns_default_text_field()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key')
        );
    }

    #[Test]
    public function it_returns_text_field_with_class_attribute()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control testing-class" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['class' => 'testing-class'])
        );
    }

    #[Test]
    public function it_returns_text_field_with_disabled_attribute()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" disabled name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['disabled' => true])
        );
    }

    #[Test]
    public function it_returns_text_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group mb-3 required ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key <span class="text-danger">*</span></label>';
        $generatedString .= '<input class="form-control" required name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['required' => true])
        );
    }

    #[Test]
    public function it_returns_text_field_with_readonly_attribute()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" readonly name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['readonly' => true])
        );
    }

    #[Test]
    public function it_returns_text_field_with_autofocus_attribute()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" autofocus name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['autofocus' => true])
        );
    }

    #[Test]
    public function it_returns_text_field_with_min_and_max_attribute()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" min="20" max="100" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['min' => 20, 'max' => 100])
        );
    }

    #[Test]
    public function it_returns_range_field_with_min_max_and_step_attribute()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" min="20" max="100" step="5" name="key" type="range" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['type' => 'range', 'min' => 20, 'max' => 100, 'step' => 5])
        );
    }

    #[Test]
    public function it_returns_text_field_with_placeholder_attribute()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" placeholder="Testing" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['placeholder' => 'Testing'])
        );
    }

    #[Test]
    public function it_returns_text_field_with_style_attribute()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" style="color:blue;" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['style' => 'color:blue;'])
        );
    }

    #[Test]
    public function it_returns_text_field_with_id_attribute()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" id="the_key_id" name="key" type="text">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['id' => 'the_key_id'])
        );
    }

    #[Test]
    public function it_returns_text_field_with_info_text_line()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '<p class="text-info small">Field text info.</p>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['info' => ['text' => 'Field text info.']])
        );
    }

    #[Test]
    public function it_returns_text_field_with_addon_before()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<span class="input-group-text">$</span>';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['addon' => ['before' => '$']])
        );
    }

    #[Test]
    public function it_returns_text_field_with_addon_after()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '<span class="input-group-text">Days</span>';
        $generatedString .= '</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key', ['addon' => ['after' => 'Days']])
        );
    }

    #[Test]
    public function it_shows_text_field_with_validation_error()
    {
        // Mock error message on "key" attribute.
        $errorBag = new \Illuminate\Support\MessageBag();
        $errorBag->add('key', 'The key field is required.');

        $this->formField->errorBag = $errorBag;

        $generatedString = '<div class="form-group mb-3 has-error">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control is-invalid" name="key" type="text" id="key">';
        $generatedString .= '<span class="invalid-feedback" role="alert">The key field is required.</span>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key')
        );
    }

    #[Test]
    public function it_shows_text_field_with_array_name_that_has_correct_validation_error()
    {
        // Mock error message on "key" attribute.
        $errorBag = new \Illuminate\Support\MessageBag();
        $errorBag->add('key.0', 'The key field is required.');

        $this->formField->errorBag = $errorBag;

        $generatedString = '<div class="form-group mb-3 has-error">';
        $generatedString .= '<label for="key[0]" class="form-label fw-bold">Key[0]</label>';
        $generatedString .= '<input class="form-control is-invalid" name="key[0]" type="text" id="key[0]">';
        $generatedString .= '<span class="invalid-feedback" role="alert">The key field is required.</span>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->text('key[0]')
        );
    }

    #[Test]
    public function it_returns_price_field()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="price" class="form-label fw-bold">Price</label>';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<span class="input-group-text">Rp</span>';
        $generatedString .= '<input class="form-control text-right" name="price" type="text" id="price">';
        $generatedString .= '</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->price('price')
        );
    }

    #[Test]
    public function it_returns_price_field_with_correct_given_class()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="price" class="form-label fw-bold">Price</label>';
        $generatedString .= '<div class="input-group">';
        $generatedString .= '<span class="input-group-text">Rp</span>';
        $generatedString .= '<input class="form-control custom-class text-right" name="price" type="text" id="price">';
        $generatedString .= '</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->price('price', ['class' => 'custom-class'])
        );
    }

    #[Test]
    public function it_returns_email_field()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="email" class="form-label fw-bold">Email</label>';
        $generatedString .= '<input class="form-control" name="email" type="email" id="email">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->email('email')
        );
    }

    #[Test]
    public function it_returns_password_field()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="password" class="form-label fw-bold">Password</label>';
        $generatedString .= '<input class="form-control" name="password" type="password" id="password">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->password('password')
        );
    }

    #[Test]
    public function it_returns_plain_text_field_with_view_template()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="key" class="form-label fw-bold">Key</label>';
        $generatedString .= '<input class="form-control" name="key" type="text" id="key">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->plainText('key')
        );
    }
}
