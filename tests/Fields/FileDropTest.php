<?php

namespace Tests\Fields;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FileDropTest extends TestCase
{
    #[Test]
    public function it_returns_drop_file_upload_field()
    {
        $result = $this->formField->fileDrop('document');

        $this->assertTrue(str_contains($result, 'file-dropzone'));
        $this->assertTrue(str_contains($result, 'Drop files here or click to browse'));
        $this->assertTrue(str_contains($result, 'Or paste images from clipboard'));
        $this->assertTrue(str_contains($result, 'type="file"'));
        $this->assertTrue(str_contains($result, 'name="document"'));
        $this->assertTrue(str_contains($result, 'id="file-input-document"'));
        $this->assertTrue(str_contains($result, '<script>'));
    }

    #[Test]
    public function it_returns_drop_file_upload_field_with_accept_option()
    {
        $result = $this->formField->fileDrop('images', ['accept' => 'image/*']);

        $this->assertTrue(str_contains($result, 'accept="image/*"'));
    }

    #[Test]
    public function it_returns_drop_file_upload_field_with_multiple_option()
    {
        $result = $this->formField->fileDrop('files', ['multiple' => true]);

        $this->assertTrue(str_contains($result, 'multiple'));
    }

    #[Test]
    public function it_returns_drop_file_upload_field_with_required_attribute()
    {
        $generatedString = $this->formField->fileDrop('required_file', ['required' => true]);

        $this->assertTrue(str_contains($generatedString, 'required '));
        $this->assertTrue(str_contains($generatedString, ' required'));
    }

    #[Test]
    public function it_returns_drop_file_upload_field_with_custom_options()
    {
        $result = $this->formField->fileDrop('custom_file', [
            'id' => 'custom_id',
            'max_size' => '5MB',
            'allowed_types' => ['JPG', 'PNG', 'PDF'],
            'label' => 'Custom File Upload',
        ]);

        $this->assertTrue(str_contains($result, 'id="file-input-custom_id"'));
        $this->assertTrue(str_contains($result, 'Max size: 5MB'));
        $this->assertTrue(str_contains($result, 'Accepted: JPG, PNG, PDF'));
        $this->assertTrue(str_contains($result, 'Custom File Upload'));
    }

    #[Test]
    public function it_returns_drop_file_upload_field_with_info_text()
    {
        $result = $this->formField->fileDrop('info_file', [
            'info' => ['text' => 'This is help text', 'class' => 'warning'],
        ]);

        $this->assertTrue(str_contains($result, 'This is help text'));
        $this->assertTrue(str_contains($result, 'text-warning'));
    }

    #[Test]
    public function it_generates_unique_ids_for_multiple_instances()
    {
        $result1 = $this->formField->fileDrop('file1');
        $result2 = $this->formField->fileDrop('file2');

        $this->assertTrue(str_contains($result1, 'dropzone-file1'));
        $this->assertTrue(str_contains($result2, 'dropzone-file2'));
        $this->assertTrue(str_contains($result1, 'file-input-file1'));
        $this->assertTrue(str_contains($result2, 'file-input-file2'));
    }

    #[Test]
    public function it_includes_javascript_for_drag_and_drop_functionality()
    {
        $result = $this->formField->fileDrop('js_test');

        $this->assertTrue(str_contains($result, 'addEventListener("dragover"'));
        $this->assertTrue(str_contains($result, 'addEventListener("drop"'));
        $this->assertTrue(str_contains($result, 'addEventListener("paste"'));
        $this->assertTrue(str_contains($result, 'addEventListener("click"'));
        $this->assertTrue(str_contains($result, 'addFiles'));
        $this->assertTrue(str_contains($result, 'formatFileSize'));
    }

    #[Test]
    public function it_includes_accessibility_features()
    {
        $result = $this->formField->fileDrop('accessible_file');

        $this->assertTrue(str_contains($result, 'tabindex'));
        $this->assertTrue(str_contains($result, 'addEventListener("keydown"'));
        $this->assertTrue(str_contains($result, 'e.key === "Enter"'));
        $this->assertTrue(str_contains($result, 'e.key === " "'));
    }

    #[Test]
    public function it_includes_delete_file_functionality()
    {
        $result = $this->formField->fileDrop('deletable_files');

        $this->assertTrue(str_contains($result, 'removeFile'));
        $this->assertTrue(str_contains($result, 'btn-outline-danger'));
        $this->assertTrue(str_contains($result, 'Remove file'));
        $this->assertTrue(str_contains($result, 'selectedFiles'));
    }

    #[Test]
    public function it_handles_array_field_names_correctly()
    {
        $result = $this->formField->fileDrop('files[]');

        $this->assertTrue(str_contains($result, 'id="dropzone-files"'));
        $this->assertTrue(str_contains($result, 'id="file-input-files"'));
        $this->assertTrue(str_contains($result, 'id="preview-files"'));
        $this->assertTrue(str_contains($result, 'name="files[]"'));
        $this->assertTrue(str_contains($result, 'getElementById("dropzone-files")'));
    }

    #[Test]
    public function it_includes_clipboard_paste_detection()
    {
        $result = $this->formField->fileDrop('paste_test');

        $this->assertTrue(str_contains($result, 'lastDropzoneInteraction'));
        $this->assertTrue(str_contains($result, 'dropzoneInteractionTimeout'));

        $this->assertTrue(str_contains($result, 'shouldHandle = false'));
        $this->assertTrue(str_contains($result, 'dropzone.contains(document.activeElement)'));
        $this->assertTrue(str_contains($result, 'Date.now() - lastDropzoneInteraction'));
        $this->assertTrue(str_contains($result, 'getBoundingClientRect()'));
        $this->assertTrue(str_contains($result, 'elementFromPoint'));

        $this->assertTrue(str_contains($result, 'dropzone.addEventListener("click"'));
        $this->assertTrue(str_contains($result, 'dropzone.addEventListener("focus"'));
    }

    #[Test]
    public function it_includes_file_validation_logic()
    {
        $result = $this->formField->fileDrop('images', ['accept' => 'image/*']);

        // Should include file validation function
        $this->assertTrue(str_contains($result, 'function isFileAccepted'));
        $this->assertTrue(str_contains($result, 'acceptString.split'));
        $this->assertTrue(str_contains($result, 'file.name.toLowerCase().endsWith'));
        $this->assertTrue(str_contains($result, 'file.type.startsWith'));

        // Should validate files in addFiles function
        $this->assertTrue(str_contains($result, 'const acceptedFiles = []'));
        $this->assertTrue(str_contains($result, 'const rejectedFiles = []'));
        $this->assertTrue(str_contains($result, 'isFileAccepted(file, "image/*")'));

        // Should show rejection message
        $this->assertTrue(str_contains($result, 'files are not accepted based on the file type restrictions'));
    }

    #[Test]
    public function it_validates_clipboard_paste_files()
    {
        $result = $this->formField->fileDrop('docs', ['accept' => '.pdf,.doc']);

        // Should validate pasted files
        $this->assertTrue(str_contains($result, 'isFileAccepted(file, ".pdf,.doc")'));
    }
}
