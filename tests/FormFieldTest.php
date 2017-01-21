<?php

use Luthfi\FormField\FormField;
use Luthfi\FormField\FormFieldFacade as FFF;

class FormFieldTest extends TestCase
{
    private $formField;

    public function setUp()
    {
        parent::setUp();
        $this->formField = new FormField;
    }

    /** @test */
    public function it_has_facade_accessor()
    {
        $this->assertEquals(FFF::text('key'), $this->formField->text('key'));
    }

    /** @test */
    public function it_returns_text_field()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<input class="form-control" name="key" type="text" id="key"></div>';
        $this->assertEquals($textFieldString, $this->formField->text('key'));
    }

    /** @test */
    public function it_returns_plain_text_field()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<input class="form-control" name="key" type="text" id="key"></div>';
        $this->assertEquals($textFieldString, $this->formField->plainText('key'));
    }

    /** @test */
    public function it_returns_textarea_field()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<input class="form-control" name="key" type="text" id="key"></div>';
        $this->assertEquals($textFieldString, $this->formField->text('key'));
    }

    /** @test */
    public function it_returns_select_field()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<select class="form-control" id="key" name="key"><option selected="selected" value="">-- Pilih Key --</option><option value="1">Satu</option><option value="2">Dua</option></select></div>';
        $this->assertEquals($textFieldString, $this->formField->select('key', [1 => 'Satu',2 => 'Dua']));
    }

    /** @test */
    public function it_returns_multi_select_field()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<select class="form-control" multiple="multiple" name="key[]" id="key"><option selected="selected" value="">-- Pilih Key --</option><option value="1">Satu</option><option value="2">Dua</option></select></div>';
        $this->assertEquals($textFieldString, $this->formField->multiSelect('key', [1 => 'Satu',2 => 'Dua']));
    }

    /** @test */
    public function it_returns_email_field()
    {
        $textFieldString = '<div class="form-group "><label for="email" class="control-label">Email</label>&nbsp;<input class="form-control" name="email" type="email" id="email"></div>';
        $this->assertEquals($textFieldString, $this->formField->email('email'));
    }

    /** @test */
    public function it_returns_password_field()
    {
        $textFieldString = '<div class="form-group "><label for="password" class="control-label">Password</label>&nbsp;<input class="form-control" name="password" type="password" id="password"></div>';
        $this->assertEquals($textFieldString, $this->formField->password('password'));
    }

    /** @test */
    public function it_returns_radios_field()
    {
        $textFieldString = '<div class="form-group "><label for="radios" class="control-label">Radios</label>&nbsp;<ul class="radio list-inline"><li><label for="radios_1"><input id="radios_1" name="radios" type="radio" value="1">Satu&nbsp;</label></li><li><label for="radios_2"><input id="radios_2" name="radios" type="radio" value="2">Dua&nbsp;</label></li></ul></div>';
        $this->assertEquals($textFieldString, $this->formField->radios('radios', [1 => 'Satu',2 => 'Dua']));
    }

    /** @test */
    public function it_returns_checkboxes_field()
    {
        $textFieldString = '<div class="form-group "><label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;<ul class="checkbox list-inline"><li><label for="checkboxes_1"><input id="checkboxes_1" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li><li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li></ul></div>';
        $this->assertEquals($textFieldString, $this->formField->checkboxes('checkboxes', [1 => 'Satu',2 => 'Dua']));
    }

    /** @test */
    public function it_returns_text_display_field()
    {
        $textFieldString = '<div class="form-group"><label for="name" class="control-label">Name</label><div class="form-control" readonly>Nama Saya</div></div>';
        $this->assertEquals($textFieldString, $this->formField->textDisplay('name', 'Nama Saya'));
    }

    /** @test */
    public function it_returns_file_upload_field()
    {
        $textFieldString = '<div class="form-group "><label for="file_name" class="control-label">File Name</label>&nbsp;<input class="form-control" name="file_name" type="file" id="file_name"></div>';
        $this->assertEquals($textFieldString, $this->formField->file('file_name'));
    }

    /** @test */
    public function it_returns_price_field()
    {
        $textFieldString = '<div class="form-group "><label for="price" class="control-label">Price</label>&nbsp;<div class="input-group"><span class="input-group-addon">Rp</span><input class="form-control text-right" name="price" type="text" id="price"></div></div>';
        $this->assertEquals($textFieldString, $this->formField->price('price'));
    }

    /** @test */
    public function it_returns_text_field_with_addon_before()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<div class="input-group"><span class="input-group-addon">$</span><input class="form-control" name="key" type="text" id="key"></div></div>';
        $this->assertEquals($textFieldString, $this->formField->text('key', ['addon' => ['before' => '$']]));
    }

    /** @test */
    public function it_returns_text_field_with_addon_after()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<div class="input-group"><input class="form-control" name="key" type="text" id="key"><span class="input-group-addon">Days</span></div></div>';
        $this->assertEquals($textFieldString, $this->formField->text('key', ['addon' => ['after' => 'Days']]));
    }
}
