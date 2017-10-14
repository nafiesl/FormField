<?php

namespace Tests\Fields;

use Tests\TestCase;

class OtherFieldTest extends TestCase
{
    /** @test */
    public function it_returns_text_display_field()
    {
        $generatedString = '<div class="form-group">';
        $generatedString .= '<label for="name" class="control-label">Name</label>';
        $generatedString .= '<div class="form-control" readonly>Nama Saya</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textDisplay('name', 'Nama Saya')
        );
    }

    /** @test */
    public function it_returns_file_upload_field()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="file_name" class="control-label">File Name</label>&nbsp;';
        $generatedString .= '<input class="form-control" name="file_name" type="file" id="file_name">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->file('file_name')
        );
    }
}
