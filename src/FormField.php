<?php

namespace Luthfi\FormField;

use Collective\Html\FormFacade;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Session;

/**
 * FormField Class.
 */
class FormField
{
    public $errorBag;
    protected $options;
    protected $fieldParams;

    public function __construct()
    {
        $this->errorBag = Session::get('errors', new MessageBag());
    }

    /**
     * Form opening tag with form atributes.
     *
     * @param  array  $options  The form attributes.
     * @return string The form opening tag.
     */
    public function open($options = [])
    {
        return FormFacade::open($options);
    }

    /**
     * Form closing tag.
     *
     * @return string The form closing tag.
     */
    public function close()
    {
        return FormFacade::close();
    }

    /**
     * Text input field that wrapped with form-group bootstrap div.
     *
     * @param  string  $name  The text field name and id attribute.
     * @param  array  $options  Additional attribute for the text input.
     * @return string Generated text input form field.
     */
    public function text($name, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($this->formatArrayName($name));
        $hasErrorClass = $hasError ? 'has-error' : '';
        $htmlForm = '<div class="form-group mb-3 '.$requiredClass.$hasErrorClass.'">';

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        if (isset($options['addon'])) {
            $htmlForm .= '<div class="input-group">';
        }
        if (isset($options['addon']['before'])) {
            $htmlForm .= '<span class="input-group-text">'.$options['addon']['before'].'</span>';
        }

        $type = isset($options['type']) ? $options['type'] : 'text';
        $value = isset($options['value']) ? $options['value'] : null;
        $fieldAttributes = $this->getFieldAttributes($options);

        if (isset($options['placeholder'])) {
            $fieldAttributes += ['placeholder' => $options['placeholder']];
        }

        if ($hasError) {
            $fieldAttributes['class'] .= ' is-invalid';
        }

        $htmlForm .= FormFacade::input($type, $name, $value, $fieldAttributes);

        if (isset($options['addon']['after'])) {
            $htmlForm .= '<span class="input-group-text">'.$options['addon']['after'].'</span>';
        }

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="invalid-feedback" role="alert">:message</span>');

        if (isset($options['addon'])) {
            $htmlForm .= '</div>';
        }

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * Textarea input field that wrapped with form-group bootstrap div.
     *
     * @param  string  $name  The textarea field name and id attribute.
     * @param  array  $options  Additional attribute for the textarea input.
     * @return string Generated textarea input form field.
     */
    public function textarea($name, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($this->formatArrayName($name));
        $hasErrorClass = $hasError ? 'has-error' : '';
        $htmlForm = '<div class="form-group mb-3 '.$requiredClass.$hasErrorClass.'">';

        $fieldAttributes = $this->getFieldAttributes($options);

        if (isset($options['placeholder'])) {
            $fieldAttributes += ['placeholder' => $options['placeholder']];
        }

        if ($hasError) {
            $fieldAttributes['class'] .= ' is-invalid';
        }

        $rows = isset($options['rows']) ? $options['rows'] : 3;
        $value = isset($options['value']) ? $options['value'] : null;
        $fieldAttributes += ['rows' => $rows];

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $htmlForm .= FormFacade::textarea($name, $value, $fieldAttributes);

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="invalid-feedback" role="alert">:message</span>');
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * Select/dropdown field wrapped with form-group bootstrap div.
     *
     * @param  [type]  $name  Select field name.
     * @param  array|Collection  $selectOptions  Select options.
     * @param  array  $options  Select input attributes.
     * @return string Generated select input form field.
     */
    public function select($name, $selectOptions, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($this->formatArrayName($name));
        $hasErrorClass = $hasError ? 'has-error' : '';
        $htmlForm = '<div class="form-group mb-3 '.$requiredClass.$hasErrorClass.'">';

        if (isset($options['placeholder'])) {
            if ($options['placeholder'] != false) {
                $placeholder = ['' => '-- '.$options['placeholder'].' --'];
            } else {
                $placeholder = [];
            }
        } else {
            if (isset($options['label'])) {
                $placeholder = ['' => '-- Select '.$options['label'].' --'];
            } else {
                $placeholder = ['' => '-- Select '.$this->formatFieldLabel($name).' --'];
            }
        }

        $value = isset($options['value']) ? $options['value'] : null;

        $fieldAttributes = $this->getFieldAttributes($options);

        if (isset($options['multiple']) && $options['multiple'] == true) {
            $fieldAttributes = array_merge($fieldAttributes, ['multiple', 'name' => $name.'[]']);
        }

        if ($hasError) {
            $fieldAttributes['class'] .= ' is-invalid';
        }

        if ($selectOptions instanceof Collection) {
            $selectOptions = !empty($placeholder) ? $selectOptions->prepend($placeholder[''], '') : $selectOptions;
        } else {
            $selectOptions = $placeholder + $selectOptions;
        }

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $htmlForm .= FormFacade::select($name, $selectOptions, $value, $fieldAttributes);

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="invalid-feedback" role="alert">:message</span>');

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * Multi-select/dropdown field wrapped with form-group bootstrap div.
     *
     * @param  string  $name  Select field name which will become array input.
     * @param  array|Collection  $selectOptions  Select options.
     * @param  array  $options  Select input attributes.
     * @return string Generated multi-select input form field.
     */
    public function multiSelect($name, $selectOptions, $options = [])
    {
        $options['multiple'] = true;
        $options['placeholder'] = false;

        return $this->select($name, $selectOptions, $options);
    }

    /**
     * Email input field that wrapped with form-group bootstrap div.
     *
     * @param  string  $name  The email field name and id attribute.
     * @param  array  $options  Additional attribute for the email input.
     * @return string Generated email input form field.
     */
    public function email($name, $options = [])
    {
        $options['type'] = 'email';

        return $this->text($name, $options);
    }

    /**
     * Password input field that wrapped with form-group bootstrap div.
     *
     * @param  string  $name  The password field name and id attribute.
     * @param  array  $options  Additional attribute for the password input.
     * @return string Generated password input form field.
     */
    public function password($name, $options = [])
    {
        $options['type'] = 'password';

        return $this->text($name, $options);
    }

    /**
     * Radio field wrapped with form-group bootstrap div.
     *
     * @param  string  $name  Radio field name.
     * @param  array|Collection  $radioOptions  Radio options.
     * @param  array  $options  Radio input attributes.
     * @return string Generated radio input form field.
     */
    public function radios($name, $radioOptions, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($this->formatArrayName($name));
        $hasErrorClass = $hasError ? 'has-error' : '';

        $htmlForm = '<div class="form-group mb-3 '.$requiredClass.$hasErrorClass.'">';
        $htmlForm .= $this->setFormFieldLabel($name, $options);
        $htmlForm .= '<div>';

        foreach ($radioOptions as $key => $option) {
            $value = null;
            $fieldParams = ['id' => $name.'_'.$key, 'class' => 'form-check-input'];

            if (isset($options['value']) && $options['value'] == $key) {
                $value = true;
            }
            if (isset($options['v-model'])) {
                $fieldParams += ['v-model' => $options['v-model']];
            }
            if (isset($options['required']) && $options['required'] == true) {
                $fieldParams += ['required' => true];
            }
            if ($hasError) {
                $fieldParams['class'] .= ' is-invalid';
            }

            $listStyle = isset($options['list_style']) ? $options['list_style'] : 'form-check-inline';
            $htmlForm .= '<div class="form-check '.$listStyle.'">';
            $htmlForm .= FormFacade::radio($name, $key, $value, $fieldParams);
            $htmlForm .= '<label for="'.$name.'_'.$key.'" class="form-check-label">'.$option.'</label>';
            $htmlForm .= '</div>';
        }
        $htmlForm .= '</div>';

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="small text-danger" role="alert">:message</span>');

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * Multi checkbox with array input, wrapped with bootstrap form-group div.
     *
     * @param  string  $name  Name of checkbox field which become an array input.
     * @param  array  $checkboxOptions  Checkbox options.
     * @param  array  $options  Checkbox input attributes.
     * @return string Generated multi-checkboxes input.
     */
    public function checkboxes($name, array $checkboxOptions, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = (bool) $this->getErrorMessage($name, $checkboxOptions);
        $hasErrorClass = $hasError ? 'has-error' : '';

        $htmlForm = '<div class="form-group mb-3 '.$requiredClass.$hasErrorClass.'">';
        $htmlForm .= $this->setFormFieldLabel($name, $options);
        $htmlForm .= '<div>';

        if (isset($options['value'])) {
            $value = $options['value'];
            if (is_array($options['value'])) {
                $value = new Collection($options['value']);
            }
        } else {
            $value = new Collection();
        }

        foreach ($checkboxOptions as $key => $option) {
            $fieldParams = ['id' => $name.'_'.$key, 'class' => 'form-check-input'];
            if (isset($options['v-model'])) {
                $fieldParams += ['v-model' => $options['v-model']];
            }
            if ($hasError) {
                $fieldParams['class'] .= ' is-invalid';
            }

            $listStyle = isset($options['list_style']) ? $options['list_style'] : 'form-check-inline';
            $htmlForm .= '<div class="form-check '.$listStyle.'">';
            $htmlForm .= FormFacade::checkbox($name.'['.$key.']', $key, $value->contains($key), $fieldParams);
            $htmlForm .= '<label for="'.$name.'_'.$key.'" class="form-check-label">'.$option.'</label>';
            $htmlForm .= '</div>';
        }
        $htmlForm .= '</div>';

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->getErrorMessage($name, $checkboxOptions);
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    private function getErrorMessage($name, $checkboxOptions = [])
    {
        $message = '';
        $message .= $this->errorBag->first($this->formatArrayName($name)).' ';
        foreach ($checkboxOptions as $key => $value) {
            $message .= $this->errorBag->first($name.'.'.$key).' ';
        }
        $message = trim($message);

        return $message ? '<span class="small text-danger" role="alert">'.$message.'</span>' : null;
    }

    /**
     * Display a text on the form as disabled input.
     *
     * @param  string  $name  The disabled text field name.
     * @param  string  $value  The field value (displayed text).
     * @param  array  $options  The attributes for the disabled text field.
     * @return string Generated disabled text field.
     */
    public function textDisplay($name, $value, $options = [])
    {
        $label = isset($options['label']) ? $options['label'] : $this->formatFieldLabel($name);
        $requiredClass = '';

        if (isset($options['required']) && $options['required'] == true) {
            $requiredClass .= ' required ';
        }

        $fieldId = isset($options['id']) ? 'id="'.$options['id'].'" ' : '';

        $htmlForm = '<div class="form-group mb-3'.$requiredClass.'">';
        $htmlForm .= FormFacade::label($name, $label, ['class' => 'form-label fw-bold']);
        $htmlForm .= '<div class="form-control" '.$fieldId.'readonly>'.$value.'</div>';
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * File input field that wrapped with form-group bootstrap div.
     *
     * @param  string  $name  The file field name and id attribute.
     * @param  array  $options  Additional attribute for the file input.
     * @return string Generated file input form field.
     */
    public function file($name, $options = [])
    {
        $options['type'] = 'file';

        return $this->text($name, $options);
    }

    /**
     * Drop file input field with drag-and-drop and clipboard paste functionality.
     *
     * @param  string  $name  The file field name and id attribute.
     * @param  array  $options  Additional attribute for the file input.
     * @return string Generated drop file input form field.
     */
    public function fileDrop($name, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($this->formatArrayName($name));
        $hasErrorClass = $hasError ? 'has-error' : '';
        $htmlForm = '<div class="form-group mb-3 '.$requiredClass.$hasErrorClass.'">';

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $fieldId = isset($options['id']) ? $options['id'] : $name;
        $accept = isset($options['accept']) ? $options['accept'] : '*/*';
        $multiple = isset($options['multiple']) && $options['multiple'] ? 'multiple' : '';
        $maxSize = isset($options['max_size']) ? $options['max_size'] : '10MB';
        $allowedTypes = isset($options['allowed_types']) ? implode(', ', $options['allowed_types']) : 'All files';

        // Sanitize field ID for use in HTML IDs (remove square brackets and other invalid characters)
        $sanitizedFieldId = preg_replace('/[^a-zA-Z0-9_-]/', '', $fieldId);

        $dropzoneId = 'dropzone-'.$sanitizedFieldId;
        $fileInputId = 'file-input-'.$sanitizedFieldId;
        $previewId = 'preview-'.$sanitizedFieldId;

        // Container with dropzone styling
        $htmlForm .= '<div id="'.$dropzoneId.'" class="file-dropzone border border-2 border-dashed rounded p-4 text-center position-relative" style="min-height: 150px; cursor: pointer; transition: all 0.3s ease;">';

        // Hidden file input
        $htmlForm .= '<input type="file" id="'.$fileInputId.'" name="'.$name.'" class="d-none" accept="'.$accept.'" '.$multiple;
        if (isset($options['required']) && $options['required'] == true) {
            $htmlForm .= ' required';
        }
        $htmlForm .= '>';

        // Dropzone content
        $htmlForm .= '<div class="dropzone-content">';
        $htmlForm .= '<div class="mb-3">';
        $htmlForm .= '<svg width="48" height="48" fill="currentColor" class="text-muted" viewBox="0 0 16 16">';
        $htmlForm .= '<path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>';
        $htmlForm .= '<path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>';
        $htmlForm .= '</svg>';
        $htmlForm .= '</div>';
        $htmlForm .= '<h5 class="mb-2">Drop files here or click to browse</h5>';
        $htmlForm .= '<p class="text-muted mb-2">Or paste images from clipboard (Ctrl+V)</p>';
        $htmlForm .= '<small class="text-muted">Accepted: '.$allowedTypes.' | Max size: '.$maxSize.'</small>';
        $htmlForm .= '</div>';

        // Preview area
        $htmlForm .= '<div id="'.$previewId.'" class="file-preview mt-3" style="display: none;"></div>';

        $htmlForm .= '</div>';

        // Add the JavaScript for drag-and-drop and clipboard functionality
        $htmlForm .= $this->getFileDropScript($dropzoneId, $fileInputId, $previewId, $accept, $multiple);

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="invalid-feedback" role="alert">:message</span>');

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * Generate JavaScript for drop file input functionality.
     *
     * @param  string  $dropzoneId  The dropzone element ID.
     * @param  string  $fileInputId  The file input element ID.
     * @param  string  $previewId  The preview element ID.
     * @param  string  $accept  File accept types.
     * @param  string  $multiple  Multiple files flag.
     * @return string JavaScript code.
     */
    private function getFileDropScript($dropzoneId, $fileInputId, $previewId, $accept, $multiple)
    {
        $script = '<script>';
        $script .= '(function() {';
        $script .= 'const dropzone = document.getElementById("'.$dropzoneId.'");';
        $script .= 'const fileInput = document.getElementById("'.$fileInputId.'");';
        $script .= 'const preview = document.getElementById("'.$previewId.'");';
        $script .= 'let selectedFiles = [];';

        // Click handler
        $script .= 'dropzone.addEventListener("click", function(e) {';
        $script .= 'if (e.target === dropzone || e.target.closest(".dropzone-content")) {';
        $script .= 'fileInput.click();';
        $script .= '}';
        $script .= '});';

        // Drag and drop handlers
        $script .= 'dropzone.addEventListener("dragover", function(e) {';
        $script .= 'e.preventDefault();';
        $script .= 'dropzone.style.borderColor = "#007bff";';
        $script .= 'dropzone.style.backgroundColor = "#f8f9fa";';
        $script .= '});';

        $script .= 'dropzone.addEventListener("dragleave", function(e) {';
        $script .= 'e.preventDefault();';
        $script .= 'dropzone.style.borderColor = "";';
        $script .= 'dropzone.style.backgroundColor = "";';
        $script .= '});';

        $script .= 'dropzone.addEventListener("drop", function(e) {';
        $script .= 'e.preventDefault();';
        $script .= 'dropzone.style.borderColor = "";';
        $script .= 'dropzone.style.backgroundColor = "";';
        $script .= 'const files = Array.from(e.dataTransfer.files);';
        $script .= 'if (files.length > 0) {';
        $script .= 'addFiles(files);';
        $script .= '}';
        $script .= '});';

        // File input change handler
        $script .= 'fileInput.addEventListener("change", function(e) {';
        $script .= 'const files = Array.from(e.target.files);';
        $script .= 'addFiles(files);';
        $script .= '});';

        // Clipboard paste handler
        $script .= 'let lastDropzoneInteraction = null;';
        $script .= 'let dropzoneInteractionTimeout = null;';

        // Track interactions with the dropzone
        $script .= 'dropzone.addEventListener("click", function() {';
        $script .= 'lastDropzoneInteraction = Date.now();';
        $script .= 'clearTimeout(dropzoneInteractionTimeout);';
        $script .= 'dropzoneInteractionTimeout = setTimeout(() => { lastDropzoneInteraction = null; }, 10000);';
        $script .= '});';

        $script .= 'dropzone.addEventListener("focus", function() {';
        $script .= 'lastDropzoneInteraction = Date.now();';
        $script .= 'clearTimeout(dropzoneInteractionTimeout);';
        $script .= 'dropzoneInteractionTimeout = setTimeout(() => { lastDropzoneInteraction = null; }, 10000);';
        $script .= '}, true);';

        $script .= 'document.addEventListener("paste", function(e) {';
        $script .= 'let shouldHandle = false;';

        // Check if activeElement is inside dropzone
        $script .= 'if (document.activeElement && (dropzone.contains(document.activeElement) || document.activeElement.closest("#'.$dropzoneId.'"))) {';
        $script .= 'shouldHandle = true;';
        $script .= '}';

        // Check if dropzone was recently interacted with
        $script .= 'if (!shouldHandle && lastDropzoneInteraction && (Date.now() - lastDropzoneInteraction < 5000)) {';
        $script .= 'shouldHandle = true;';
        $script .= '}';

        // Check if dropzone is visible and cursor is over it
        $script .= 'if (!shouldHandle) {';
        $script .= 'const rect = dropzone.getBoundingClientRect();';
        $script .= 'const centerX = rect.left + rect.width / 2;';
        $script .= 'const centerY = rect.top + rect.height / 2;';
        $script .= 'const elementAtCenter = document.elementFromPoint(centerX, centerY);';
        $script .= 'if (elementAtCenter && (dropzone.contains(elementAtCenter) || elementAtCenter === dropzone)) {';
        $script .= 'shouldHandle = true;';
        $script .= '}';
        $script .= '}';

        $script .= 'if (shouldHandle) {';
        $script .= 'const items = e.clipboardData.items;';
        $script .= 'const files = [];';
        $script .= 'for (let i = 0; i < items.length; i++) {';
        $script .= 'if (items[i].type.indexOf("image") !== -1) {';
        $script .= 'const file = items[i].getAsFile();';
        $script .= 'if (isFileAccepted(file, "'.$accept.'")) {';
        $script .= 'files.push(file);';
        $script .= '}';
        $script .= '}';
        $script .= '}';
        $script .= 'if (files.length > 0) {';
        $script .= 'addFiles(files);';
        $script .= 'e.preventDefault();';
        $script .= '}';
        $script .= '}';
        $script .= '});';

        // File handling functions with validation
        $script .= 'function isFileAccepted(file, acceptString) {';
        $script .= 'if (!acceptString || acceptString === "*/*") return true;';
        $script .= 'const accepts = acceptString.split(",").map(s => s.trim());';
        $script .= 'for (let accept of accepts) {';
        $script .= 'if (accept.startsWith(".")) {';
        $script .= 'if (file.name.toLowerCase().endsWith(accept.toLowerCase())) return true;';
        $script .= '} else if (accept.includes("/*")) {';
        $script .= 'const baseType = accept.split("/")[0];';
        $script .= 'if (file.type.startsWith(baseType + "/")) return true;';
        $script .= '} else if (file.type === accept) {';
        $script .= 'return true;';
        $script .= '}';
        $script .= '}';
        $script .= 'return false;';
        $script .= '}';

        $script .= 'function addFiles(newFiles) {';
        $script .= 'const acceptedFiles = [];';
        $script .= 'const rejectedFiles = [];';
        $script .= 'for (let file of newFiles) {';
        $script .= 'if (isFileAccepted(file, "'.$accept.'")) {';
        $script .= 'acceptedFiles.push(file);';
        $script .= '} else {';
        $script .= 'rejectedFiles.push(file);';
        $script .= '}';
        $script .= '}';

        $script .= 'if (rejectedFiles.length > 0) {';
        $script .= 'const rejectedNames = rejectedFiles.map(f => f.name).join(", ");';
        $script .= 'alert("The following files are not accepted based on the file type restrictions: " + rejectedNames);';
        $script .= '}';

        $script .= 'if (acceptedFiles.length > 0) {';
        $script .= 'if ("'.$multiple.'" === "multiple") {';
        $script .= 'selectedFiles = selectedFiles.concat(acceptedFiles);';
        $script .= '} else {';
        $script .= 'selectedFiles = [acceptedFiles[0]];';
        $script .= '}';
        $script .= 'updateFileInput();';
        $script .= 'renderFiles();';
        $script .= '}';
        $script .= '}';

        $script .= 'function removeFile(index) {';
        $script .= 'selectedFiles.splice(index, 1);';
        $script .= 'updateFileInput();';
        $script .= 'renderFiles();';
        $script .= '}';

        $script .= 'function updateFileInput() {';
        $script .= 'const dt = new DataTransfer();';
        $script .= 'selectedFiles.forEach(file => dt.items.add(file));';
        $script .= 'fileInput.files = dt.files;';
        $script .= '}';

        $script .= 'function renderFiles() {';
        $script .= 'preview.innerHTML = "";';
        $script .= 'if (selectedFiles.length > 0) {';
        $script .= 'preview.style.display = "block";';
        $script .= 'const fileList = document.createElement("div");';
        $script .= 'fileList.className = "list-group";';

        $script .= 'for (let i = 0; i < selectedFiles.length; i++) {';
        $script .= 'const file = selectedFiles[i];';
        $script .= 'const fileItem = document.createElement("div");';
        $script .= 'fileItem.className = "list-group-item d-flex justify-content-between align-items-center";';
        $script .= 'fileItem.setAttribute("data-file-index", i);';

        $script .= 'const fileInfo = document.createElement("div");';
        $script .= 'fileInfo.innerHTML = "<strong>" + file.name + "</strong><br><small class=\"text-muted\">" + formatFileSize(file.size) + "</small>";';

        $script .= 'const fileActions = document.createElement("div");';
        $script .= 'fileActions.className = "d-flex align-items-center gap-2";';

        $script .= 'const fileIcon = document.createElement("span");';
        $script .= 'if (file.type.startsWith("image/")) {';
        $script .= 'fileIcon.innerHTML = "🖼️";';
        $script .= '} else if (file.type.includes("pdf")) {';
        $script .= 'fileIcon.innerHTML = "📄";';
        $script .= '} else {';
        $script .= 'fileIcon.innerHTML = "📎";';
        $script .= '}';

        $script .= 'const deleteBtn = document.createElement("button");';
        $script .= 'deleteBtn.type = "button";';
        $script .= 'deleteBtn.className = "btn btn-sm btn-outline-danger";';
        $script .= 'deleteBtn.innerHTML = "×";';
        $script .= 'deleteBtn.title = "Remove file";';
        $script .= 'deleteBtn.setAttribute("data-file-index", i);';
        $script .= 'deleteBtn.addEventListener("click", function(e) {';
        $script .= 'e.preventDefault();';
        $script .= 'removeFile(parseInt(this.getAttribute("data-file-index")));';
        $script .= '});';

        $script .= 'fileActions.appendChild(fileIcon);';
        $script .= 'fileActions.appendChild(deleteBtn);';

        $script .= 'fileItem.appendChild(fileInfo);';
        $script .= 'fileItem.appendChild(fileActions);';
        $script .= 'fileList.appendChild(fileItem);';
        $script .= '}';

        $script .= 'preview.appendChild(fileList);';
        $script .= '} else {';
        $script .= 'preview.style.display = "none";';
        $script .= '}';
        $script .= '}';

        // File size formatter
        $script .= 'function formatFileSize(bytes) {';
        $script .= 'if (bytes === 0) return "0 Bytes";';
        $script .= 'const k = 1024;';
        $script .= 'const sizes = ["Bytes", "KB", "MB", "GB"];';
        $script .= 'const i = Math.floor(Math.log(bytes) / Math.log(k));';
        $script .= 'return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];';
        $script .= '}';

        // Make dropzone focusable for accessibility
        $script .= 'dropzone.setAttribute("tabindex", "0");';
        $script .= 'dropzone.addEventListener("keydown", function(e) {';
        $script .= 'if (e.key === "Enter" || e.key === " ") {';
        $script .= 'e.preventDefault();';
        $script .= 'fileInput.click();';
        $script .= '}';
        $script .= '});';

        $script .= '})();';
        $script .= '</script>';

        return $script;
    }

    /**
     * One form which only have "one button" and "hidden fields".
     * This is suitable for, e.g. set status, delete button,
     * or any other "one-click-action" button.
     *
     * @param  array  $form_params  The form attribtues.
     * @param  string  $button_label  The button text or label.
     * @param  array  $button_options  The button attributes.
     * @param  array  $hiddenFields  Additional hidden fields.
     * @return string Generated form button.
     */
    public function formButton($form_params = [], $button_label = 'x', $button_options = [], $hiddenFields = [])
    {
        $form_params['method'] = isset($form_params['method']) ? $form_params['method'] : 'post';
        $form_params['class'] = isset($form_params['class']) ? $form_params['class'] : '';
        $form_params['style'] = isset($form_params['style']) ? $form_params['style'] : 'display:inline';
        if (isset($form_params['onsubmit']) && $form_params['onsubmit'] != false) {
            $form_params['onsubmit'] = 'return confirm("'.$form_params['onsubmit'].'")';
        }

        $htmlForm = FormFacade::open($form_params);
        if (!empty($hiddenFields)) {
            foreach ($hiddenFields as $k => $v) {
                $htmlForm .= FormFacade::hidden($k, $v);
            }
        }

        $btnOptions = '';
        foreach ($button_options as $key => $value) {
            $btnOptions .= $key.'="'.$value.'" ';
        }

        $htmlForm .= '<button '.$btnOptions.'type="submit">'.$button_label.'</button>';
        $htmlForm .= FormFacade::close();

        return $htmlForm;
    }

    /**
     * A form button that dedicated for submitting a delete request.
     *
     * @param  array  $form_params  The form attribtues.
     * @param  string  $button_label  The delete button text or label.
     * @param  array  $button_options  The button attributes.
     * @param  array  $hiddenFields  Additional hidden fields.
     * @return string Generated delete form button.
     */
    public function delete($form_params = [], $button_label = 'x', $button_options = [], $hiddenFields = [])
    {
        $form_params['method'] = 'delete';
        $form_params['class'] = isset($form_params['class']) ? $form_params['class'] : 'del-form pull-right float-right float-end';
        if (isset($form_params['onsubmit'])) {
            if ($form_params['onsubmit'] != false) {
                $form_params['onsubmit'] = $form_params['onsubmit'];
            }
        } else {
            $form_params['onsubmit'] = 'Are you sure to delete this?';
        }

        if (!isset($button_options['title'])) {
            $button_options['title'] = 'Delete this item';
        }

        return $this->formButton($form_params, $button_label, $button_options, $hiddenFields);
    }

    public function arrays($name, array $fieldKeys, $options = [])
    {
        $hasError = $this->errorBag->has($name) ? 'has-error' : '';
        $label = isset($options['label']) ? $options['label'] : $this->formatFieldLabel($name);

        $htmlForm = '<div class="form-group mb-3 '.$hasError.'">';
        $htmlForm .= FormFacade::label($name, $label, ['class' => 'form-label fw-bold']);

        if (empty($contents) == false) {
            foreach ($checkboxOptions as $key => $option) {
                $htmlForm .= '<div class="row">';
                $htmlForm .= FormFacade::text($name.'[]', $key);
                $htmlForm .= '</div>';
            }
        }

        $htmlForm .= '<div class="new-'.$name.' row">';
        $htmlForm .= '<div class="col-md-4">';
        $htmlForm .= FormFacade::text($fieldKeys[0], null, ['class' => 'form-control']);
        $htmlForm .= '</div>';
        $htmlForm .= '<div class="col-md-8 row">';
        $htmlForm .= FormFacade::text($fieldKeys[1], null, ['class' => 'form-control']);
        $htmlForm .= '</div>';
        $htmlForm .= '</div>';
        $htmlForm .= '<a id="add-service" class="btn btn-info btn-xs pull-right"><i class="fa fa-plus fa-fw"></i></a>';

        $htmlForm .= $this->errorBag->first($name, '<span class="help-block small">:message</span>');
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    public function plainText()
    {
        return view('form-field::text')->render();
    }

    /**
     * Price input field that wrapped with form-group bootstrap div.
     *
     * @param  string  $name  The price field name and id attribute.
     * @param  array  $options  Additional attribute for the price input.
     * @return string Generated price input form field.
     */
    public function price($name, $options = [])
    {
        $options['addon'] = ['before' => isset($options['currency']) ? $options['currency'] : 'Rp'];
        $options['class'] = isset($options['class']) ? $options['class'].' text-right' : 'text-right';
        $options['pattern'] = isset($options['pattern']) ? $options['pattern'] : '[0-9]*';

        return $this->text($name, $options);
    }

    /**
     * Set the form field label.
     *
     * @param  string  $name  The field name.
     * @param  array  $options  The field attributes.
     * @return string Generated form field label.
     */
    private function setFormFieldLabel($name, $options)
    {
        if (isset($options['label']) && $options['label'] != false) {
            $label = isset($options['label']) ? $options['label'] : $this->formatFieldLabel($name);
            if (isset($options['required']) && $options['required'] == true) {
                $label .= ' <span class="text-danger">*</span>';
            }

            return FormFacade::label($name, $label, ['class' => 'form-label fw-bold'], false);
        } elseif (!isset($options['label'])) {
            $label = $this->formatFieldLabel($name);
            if (isset($options['required']) && $options['required'] == true) {
                $label .= ' <span class="text-danger">*</span>';
            }

            return FormFacade::label($name, $label, ['class' => 'form-label fw-bold'], false);
        }
    }

    /**
     * Reformat the field label.
     *
     * @param  string  $fieldName  The field name.
     * @return string Generated field name.
     */
    private function formatFieldLabel($fieldName)
    {
        return ucwords(preg_replace('/(_id$|_)/im', ' ', $fieldName));
    }

    /**
     * Format the name attribute for muti-select and checkbox input field.
     *
     * @param  string  $name  Field name.
     * @return string Generated field name as array square bracket.
     */
    private function formatArrayName($name)
    {
        return str_replace(['[', ']'], ['.', ''], $name);
    }

    /**
     * Get field attributes based on given option.
     *
     * @param  array  $options  Additional form field attributes.
     * @return array Array of attributes for the field.
     */
    private function getFieldAttributes(array $options)
    {
        $fieldAttributes = ['class' => 'form-control'];

        if (isset($options['class'])) {
            $fieldAttributes['class'] .= ' '.$options['class'];
        }

        if (isset($options['id'])) {
            $fieldAttributes += ['id' => $options['id']];
        }
        if (isset($options['readonly']) && $options['readonly'] == true) {
            $fieldAttributes += ['readonly'];
        }
        if (isset($options['autofocus']) && $options['autofocus'] == true) {
            $fieldAttributes += ['autofocus'];
        }
        if (isset($options['disabled']) && $options['disabled'] == true) {
            $fieldAttributes += ['disabled'];
        }
        if (isset($options['required']) && $options['required'] == true) {
            $fieldAttributes += ['required'];
        }
        if (isset($options['min'])) {
            $fieldAttributes += ['min' => $options['min']];
        }
        if (isset($options['max'])) {
            $fieldAttributes += ['max' => $options['max']];
        }
        if (isset($options['step'])) {
            $fieldAttributes += ['step' => $options['step']];
        }
        if (isset($options['pattern'])) {
            $fieldAttributes += ['pattern' => $options['pattern']];
        }
        if (isset($options['style'])) {
            $fieldAttributes += ['style' => $options['style']];
        }

        return $fieldAttributes;
    }

    /**
     * Get the info text line for input field.
     *
     * @param  array  $options  Additional field attributes.
     * @return string Info text line.
     */
    private function getInfoTextLine($options)
    {
        $htmlForm = '';

        if (isset($options['info'])) {
            $class = isset($options['info']['class']) ? $options['info']['class'] : 'info';
            $htmlForm .= '<p class="text-'.$class.' small">'.$options['info']['text'].'</p>';
        }

        return $htmlForm;
    }
}
