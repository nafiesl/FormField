<?php

use Luthfi\FormField\FormField;
use Luthfi\FormField\FormFieldFacade as FFF;
use Orchestra\Testbench\TestCase;

class FormFieldTest extends TestCase
{
    private $formField;

    public function setUp()
    {
        parent::setUp();
        $this->formField = new FormField();
    }

    protected function getPackageProviders($app)
    {
        return [
            Luthfi\FormField\FormFieldServiceProvider::class,
        ];
    }

    /** @test */
    public function it_has_facade_accessor()
    {
        $this->assertEquals(FFF::text('key'), $this->formField->text('key'));
    }

    /** @test */
    public function it_returns_form_open()
    {
        $textFieldString = '<form method="POST" action="http://localhost" accept-charset="UTF-8"><input name="_token" type="hidden">';
        $this->assertEquals($textFieldString, $this->formField->open());
    }

    /** @test */
    public function it_returns_form_close()
    {
        $textFieldString = '</form>';
        $this->assertEquals($textFieldString, $this->formField->close());
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
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<select class="form-control" id="key" name="key"><option value="" selected="selected">-- Select Key --</option><option value="1">Satu</option><option value="2">Dua</option></select></div>';
        $this->assertEquals($textFieldString, $this->formField->select('key', [1 => 'Satu', 2 => 'Dua']));
    }

    /** @test */
    public function it_returns_select_field_with_collection_select_options()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<select class="form-control" id="key" name="key"><option value="" selected="selected">-- Select Key --</option><option value="1">Satu</option><option value="2">Dua</option></select></div>';
        $this->assertEquals($textFieldString, $this->formField->select('key', collect([1 => 'Satu', 2 => 'Dua'])));
    }

    /** @test */
    public function it_returns_select_field_with_placeholder_set_to_false()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<select class="form-control" id="key" name="key"><option value="1">Satu</option><option value="2">Dua</option></select></div>';
        $this->assertEquals($textFieldString, $this->formField->select('key', [1 => 'Satu', 2 => 'Dua'], ['placeholder' => false]));
        $this->assertEquals($textFieldString, $this->formField->select('key', collect([1 => 'Satu', 2 => 'Dua']), ['placeholder' => false]));
    }

    /** @test */
    public function it_returns_multi_select_field()
    {
        $textFieldString = '<div class="form-group "><label for="key" class="control-label">Key</label>&nbsp;<select class="form-control" multiple name="key[]" id="key"><option value="" selected="selected">-- Select Key --</option><option value="1">Satu</option><option value="2">Dua</option></select></div>';
        $this->assertEquals($textFieldString, $this->formField->multiSelect('key', [1 => 'Satu', 2 => 'Dua']));
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
        $this->assertEquals($textFieldString, $this->formField->radios('radios', [1 => 'Satu', 2 => 'Dua']));
    }

    /** @test */
    public function it_returns_checkboxes_field()
    {
        $textFieldString = '<div class="form-group "><label for="checkboxes" class="control-label">Checkboxes</label>&nbsp;<ul class="checkbox list-inline"><li><label for="checkboxes_1"><input id="checkboxes_1" name="checkboxes[]" type="checkbox" value="1">Satu&nbsp;</label></li><li><label for="checkboxes_2"><input id="checkboxes_2" name="checkboxes[]" type="checkbox" value="2">Dua&nbsp;</label></li></ul></div>';
        $this->assertEquals($textFieldString, $this->formField->checkboxes('checkboxes', [1 => 'Satu', 2 => 'Dua']));
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

    /** @test */
    public function it_returns_form_button()
    {
        $textFieldString = '<form method="POST" action="'.url('/').'" accept-charset="UTF-8" class="" style="display:inline">';
        $textFieldString .= '<input name="_token" type="hidden">';
        $textFieldString .= '<button class="btn btn-default" type="submit">Submit with Button</button>';
        $textFieldString .= '</form>';
        $this->assertEquals(
            $textFieldString,
            $this->formField->formButton(
                ['url'=> '/'],
                'Submit with Button',
                ['class'       => 'btn btn-default']
            )
        );
    }

    /** @test */
    public function it_returns_delete_button()
    {
        $textFieldString = '<form method="POST" action="'.url('/').'"';
        $textFieldString .= ' accept-charset="UTF-8" class="del-form pull-right"';
        $textFieldString .= ' onsubmit="return confirm(&quot;Are you sure to delete this?&quot;)"';
        $textFieldString .= ' style="display:inline">';
        $textFieldString .= '<input name="_method" type="hidden" value="DELETE">';
        $textFieldString .= '<input name="_token" type="hidden">';
        $textFieldString .= '<button class="btn btn-default" title="Delete this item" type="submit">Delete this Item</button>';
        $textFieldString .= '</form>';
        $this->assertEquals(
            $textFieldString,
            $this->formField->delete(
                ['url'=> '/'],
                'Delete this Item',
                ['class'       => 'btn btn-default']
            )
        );
    }
}
