<?php

namespace Tests\Fields;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OtherFieldTest extends TestCase
{
    #[Test]
    public function it_returns_text_display_field()
    {
        $generatedString = '<div class="form-group mb-3">';
        $generatedString .= '<label for="name" class="form-label fw-bold">Name</label>';
        $generatedString .= '<div class="form-control" readonly>Nama Saya</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textDisplay('name', 'Nama Saya')
        );
    }

    #[Test]
    public function it_returns_text_display_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group mb-3 required ">';
        $generatedString .= '<label for="name" class="form-label fw-bold">Name</label>';
        $generatedString .= '<div class="form-control" readonly>Nama Saya</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textDisplay('name', 'Nama Saya', ['required' => true])
        );
    }

    #[Test]
    public function it_returns_text_display_field_with_id_attribute()
    {
        $generatedString = '<div class="form-group mb-3">';
        $generatedString .= '<label for="name" class="form-label fw-bold">Name</label>';
        $generatedString .= '<div class="form-control" id="text-display-id" readonly>Nama Saya</div>';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->textDisplay('name', 'Nama Saya', ['id' => 'text-display-id'])
        );
    }

    #[Test]
    public function it_returns_file_upload_field()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="file_name" class="form-label fw-bold">File Name</label>';
        $generatedString .= '<input class="form-control" name="file_name" type="file" id="file_name">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->file('file_name')
        );
    }

    #[Test]
    public function it_returns_file_upload_field_with_required_attribute()
    {
        $generatedString = '<div class="form-group mb-3 required ">';
        $generatedString .= '<label for="file_name" class="form-label fw-bold">File Name <span class="text-danger">*</span></label>';
        $generatedString .= '<input class="form-control" required name="file_name" type="file" id="file_name">';
        $generatedString .= '</div>';

        $this->assertEquals(
            $generatedString,
            $this->formField->file('file_name', ['required' => true])
        );
    }

    #[Test]
    public function it_returns_file_upload_field_with_info_text_line()
    {
        $generatedString = '<div class="form-group mb-3 ">';
        $generatedString .= '<label for="file_name" class="form-label fw-bold">File Name</label>';
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
