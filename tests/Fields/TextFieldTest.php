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
    public function it_returns_textarea_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="key" class="control-label">Key</label>&nbsp;';
        $generatedString .= '<textarea class="form-control" rows="3" name="key" cols="50" id="key"></textarea>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textarea('key')
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
