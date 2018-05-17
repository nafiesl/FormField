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
    public function it_returns_text_display_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group required ">';
        $generatedString .= '<label for="name" class="control-label">Name</label>';
        $generatedString .= '<div class="form-control" readonly>Nama Saya</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textDisplay('name', 'Nama Saya', ['required' => true])
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

    /** @test */
    public function it_returns_file_upload_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group required ">';
        $generatedString .= '<label for="file_name" class="control-label">File Name</label>&nbsp;';
        $generatedString .= '<input class="form-control" required name="file_name" type="file" id="file_name">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->file('file_name', ['required' => true])
        );
    }

    /** @test */
    public function it_returns_file_upload_field_with_info_text_line()
    {
        $generatedString = '<div class="form-group ">';
        $generatedString .= '<label for="file_name" class="control-label">File Name</label>&nbsp;';
        $generatedString .= '<input class="form-control" name="file_name" type="file" id="file_name">';
        $generatedString .= '<p class="text-info small">Field text info.</p>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->file('file_name', [
                'info' => ['text' => 'Field text info.', 'class' => 'info'],
            ])
        );

        $this->assertEquals(
            $generatedString,
            $this->formField->file('file_name', [
                'info' => ['text' => 'Field text info.'],
            ])
        );
    }
}
