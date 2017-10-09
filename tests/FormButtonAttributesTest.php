<?php

namespace Tests;

class FormButtonAttributesTest extends TestCase
{
    /** @test */
    public function form_button_can_have_onsubmit_property()
    {
        $textFieldString = '<form method="POST" action="'.url('/').'"';
        $textFieldString .= ' accept-charset="UTF-8"';
        $textFieldString .= ' onsubmit="return confirm(&quot;Sure to submit?&quot;)"';
        $textFieldString .= ' class="" style="display:inline">';
        $textFieldString .= '<input name="_token" type="hidden">';
        $textFieldString .= '<input name="hidden_field" type="hidden" value="hidden_field_value">';
        $textFieldString .= '<button class="btn btn-default" type="submit">Submit with Button</button>';
        $textFieldString .= '</form>';
        $this->assertEquals(
            $textFieldString,
            $this->formField->formButton(
                ['url'=> '/', 'onsubmit' => 'Sure to submit?'],
                'Submit with Button',
                ['class'       => 'btn btn-default'],
                ['hidden_field'=> 'hidden_field_value']
            )
        );
    }

    /** @test */
    public function delete_form_button_can_have_onsubmit_property()
    {
        $textFieldString = '<form method="POST" action="'.url('/').'"';
        $textFieldString .= ' accept-charset="UTF-8"';
        $textFieldString .= ' onsubmit="return confirm(&quot;Sure to delete?&quot;)"';
        $textFieldString .= ' class="del-form pull-right" style="display:inline">';
        $textFieldString .= '<input name="_method" type="hidden" value="DELETE">';
        $textFieldString .= '<input name="_token" type="hidden">';
        $textFieldString .= '<input name="hidden_field" type="hidden" value="hidden_field_value">';
        $textFieldString .= '<button class="btn btn-default" title="Delete this item" type="submit">Delete this Item</button>';
        $textFieldString .= '</form>';
        $this->assertEquals(
            $textFieldString,
            $this->formField->delete(
                ['url'=> '/', 'onsubmit' => 'Sure to delete?'],
                'Delete this Item',
                ['class'       => 'btn btn-default'],
                ['hidden_field'=> 'hidden_field_value']
            )
        );
    }
}
