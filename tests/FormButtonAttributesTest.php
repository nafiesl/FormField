<?php

namespace Tests;

class FormButtonAttributesTest extends TestCase
{
    /** @test */
    public function form_button_with_default_properties()
    {
        $generatedString = '<form method="POST" action="'.url('/').'"';
        $generatedString .= ' accept-charset="UTF-8"';
        $generatedString .= ' class="" style="display:inline">';
        $generatedString .= '<input name="_token" type="hidden">';
        $generatedString .= '<button type="submit">Submit with Button</button>';
        $generatedString .= '</form>';

        $this->assertEquals(
            $generatedString,
            $this->formField->formButton(
                ['url' => '/'],
                'Submit with Button'
            )
        );
    }

    /** @test */
    public function form_button_can_have_button_property()
    {
        $generatedString = '<form method="POST" action="'.url('/').'"';
        $generatedString .= ' accept-charset="UTF-8"';
        $generatedString .= ' class="" style="display:inline">';
        $generatedString .= '<input name="_token" type="hidden">';
        $generatedString .= '<button class="btn btn-default" type="submit">Submit with Button</button>';
        $generatedString .= '</form>';

        $this->assertEquals(
            $generatedString,
            $this->formField->formButton(
                ['url' => '/'],
                'Submit with Button',
                ['class' => 'btn btn-default']
            )
        );
    }

    /** @test */
    public function form_button_can_have_onsubmit_property()
    {
        $generatedString = '<form method="POST" action="'.url('/').'"';
        $generatedString .= ' accept-charset="UTF-8"';
        $generatedString .= ' onsubmit="return confirm(&quot;Sure to submit?&quot;)"';
        $generatedString .= ' class="" style="display:inline">';
        $generatedString .= '<input name="_token" type="hidden">';
        $generatedString .= '<input name="hidden_field" type="hidden" value="hidden_field_value">';
        $generatedString .= '<button class="btn btn-default" type="submit">Submit with Button</button>';
        $generatedString .= '</form>';

        $this->assertEquals(
            $generatedString,
            $this->formField->formButton(
                ['url' => '/', 'onsubmit' => 'Sure to submit?'],
                'Submit with Button',
                ['class' => 'btn btn-default'],
                ['hidden_field' => 'hidden_field_value']
            )
        );
    }

    /** @test */
    public function delete_button_with_default_properties()
    {
        $generatedString = '<form method="POST" action="'.url('/').'"';
        $generatedString .= ' accept-charset="UTF-8" class="del-form pull-right float-right"';
        $generatedString .= ' onsubmit="return confirm(&quot;Are you sure to delete this?&quot;)"';
        $generatedString .= ' style="display:inline">';
        $generatedString .= '<input name="_method" type="hidden" value="DELETE">';
        $generatedString .= '<input name="_token" type="hidden">';
        $generatedString .= '<button class="btn btn-default" title="Delete this item" type="submit">Delete this Item</button>';
        $generatedString .= '</form>';

        $this->assertEquals(
            $generatedString,
            $this->formField->delete(
                ['url' => '/'],
                'Delete this Item',
                ['class' => 'btn btn-default']
            )
        );
    }

    /** @test */
    public function delete_form_button_can_have_additional_hidden_fields()
    {
        $generatedString = '<form method="POST" action="'.url('/').'"';
        $generatedString .= ' accept-charset="UTF-8"';
        $generatedString .= ' class="del-form pull-right float-right"';
        $generatedString .= ' onsubmit="return confirm(&quot;Are you sure to delete this?&quot;)" style="display:inline">';
        $generatedString .= '<input name="_method" type="hidden" value="DELETE">';
        $generatedString .= '<input name="_token" type="hidden">';
        $generatedString .= '<input name="hidden_field" type="hidden" value="hidden_field_value">';
        $generatedString .= '<button class="btn btn-default" title="Delete this item" type="submit">Delete this Item</button>';
        $generatedString .= '</form>';

        $this->assertEquals(
            $generatedString,
            $this->formField->delete(
                ['url' => '/'],
                'Delete this Item',
                ['class' => 'btn btn-default'],
                ['hidden_field' => 'hidden_field_value']
            )
        );
    }

    /** @test */
    public function delete_form_button_can_have_custom_onsubmit_property()
    {
        $generatedString = '<form method="POST" action="'.url('/').'"';
        $generatedString .= ' accept-charset="UTF-8"';
        $generatedString .= ' onsubmit="return confirm(&quot;Sure to delete?&quot;)"';
        $generatedString .= ' class="del-form pull-right float-right" style="display:inline">';
        $generatedString .= '<input name="_method" type="hidden" value="DELETE">';
        $generatedString .= '<input name="_token" type="hidden">';
        $generatedString .= '<input name="hidden_field" type="hidden" value="hidden_field_value">';
        $generatedString .= '<button class="btn btn-default" title="Delete this item" type="submit">Delete this Item</button>';
        $generatedString .= '</form>';

        $this->assertEquals(
            $generatedString,
            $this->formField->delete(
                ['url' => '/', 'onsubmit' => 'Sure to delete?'],
                'Delete this Item',
                ['class' => 'btn btn-default'],
                ['hidden_field' => 'hidden_field_value']
            )
        );
    }
}
