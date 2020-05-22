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
     * @param array $options The form attributes.
     *
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
     * @param string $name    The text field name and id attribute.
     * @param array  $options Additional attribute for the text input.
     *
     * @return string Generated text input form field.
     */
    public function text($name, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($this->formatArrayName($name)) ? 'has-error' : '';
        $htmlForm = '<div class="form-group '.$requiredClass.$hasError.'">';

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        if (isset($options['addon'])) {
            $htmlForm .= '<div class="input-group">';
        }
        if (isset($options['addon']['before'])) {
            $htmlForm .= '<span class="input-group-addon">'.$options['addon']['before'].'</span>';
        }

        $type = isset($options['type']) ? $options['type'] : 'text';
        $value = isset($options['value']) ? $options['value'] : null;
        $fieldAttributes = $this->getFieldAttributes($options);

        if (isset($options['placeholder'])) {
            $fieldAttributes += ['placeholder' => $options['placeholder']];
        }

        $htmlForm .= FormFacade::input($type, $name, $value, $fieldAttributes);

        if (isset($options['addon']['after'])) {
            $htmlForm .= '<span class="input-group-addon">'.$options['addon']['after'].'</span>';
        }
        if (isset($options['addon'])) {
            $htmlForm .= '</div>';
        }

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="help-block small">:message</span>');

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * Textarea input field that wrapped with form-group bootstrap div.
     *
     * @param string $name    The textarea field name and id attribute.
     * @param array  $options Additional attribute for the textarea input.
     *
     * @return string Generated textarea input form field.
     */
    public function textarea($name, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($this->formatArrayName($name)) ? 'has-error' : '';
        $htmlForm = '<div class="form-group '.$requiredClass.$hasError.'">';

        $fieldAttributes = $this->getFieldAttributes($options);

        if (isset($options['placeholder'])) {
            $fieldAttributes += ['placeholder' => $options['placeholder']];
        }

        $rows = isset($options['rows']) ? $options['rows'] : 3;
        $value = isset($options['value']) ? $options['value'] : null;
        $fieldAttributes += ['rows' => $rows];

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $htmlForm .= FormFacade::textarea($name, $value, $fieldAttributes);

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="help-block small">:message</span>');
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * Select/dropdown field wrapped with form-group bootstrap div.
     *
     * @param [type]           $name          Select field name.
     * @param array|Collection $selectOptions Select options.
     * @param array            $options       Select input attributes.
     *
     * @return string Generated select input form field.
     */
    public function select($name, $selectOptions, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($name) ? 'has-error' : '';
        $htmlForm = '<div class="form-group '.$requiredClass.$hasError.'">';

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

        if ($selectOptions instanceof Collection) {
            $selectOptions = !empty($placeholder) ? $selectOptions->prepend($placeholder[''], '') : $selectOptions;
        } else {
            $selectOptions = $placeholder + $selectOptions;
        }

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $htmlForm .= FormFacade::select($name, $selectOptions, $value, $fieldAttributes);

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="help-block small">:message</span>');

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * Multi-select/dropdown field wrapped with form-group bootstrap div.
     *
     * @param [type]           $name          Select field name which will become array input.
     * @param array|Collection $selectOptions Select options.
     * @param array            $options       Select input attributes.
     *
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
     * @param string $name    The email field name and id attribute.
     * @param array  $options Additional attribute for the email input.
     *
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
     * @param string $name    The password field name and id attribute.
     * @param array  $options Additional attribute for the password input.
     *
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
     * @param [type]           $name         Radio field name.
     * @param array|Collection $radioOptions Radio options.
     * @param array            $options      Radio input attributes.
     *
     * @return string Generated radio input form field.
     */
    public function radios($name, $radioOptions, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($name) ? 'has-error' : '';

        $htmlForm = '<div class="form-group '.$requiredClass.$hasError.'">';
        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $listStyle = isset($options['list_style']) ? $options['list_style'] : 'inline';
        $htmlForm .= '<ul class="radio list-'.$listStyle.'">';

        foreach ($radioOptions as $key => $option) {
            $value = null;
            $fieldParams = ['id' => $name.'_'.$key];

            if (isset($options['value']) && $options['value'] == $key) {
                $value = true;
            }
            if (isset($options['v-model'])) {
                $fieldParams += ['v-model' => $options['v-model']];
            }
            if (isset($options['required']) && $options['required'] == true) {
                $fieldParams += ['required' => true];
            }

            $htmlForm .= '<li><label for="'.$name.'_'.$key.'">';
            $htmlForm .= FormFacade::radio($name, $key, $value, $fieldParams);
            $htmlForm .= $option;
            $htmlForm .= '&nbsp;</label></li>';
        }
        $htmlForm .= '</ul>';

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="help-block small">:message</span>');

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * Multi checkbox with array input, wrapped with bootstrap form-group div.
     *
     * @param string $name            Name of checkbox field which become an array input.
     * @param array  $checkboxOptions Checkbox options.
     * @param array  $options         Checkbox input attributes.
     *
     * @return string Generated multi-checkboxes input.
     */
    public function checkboxes($name, array $checkboxOptions, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = (bool) $this->getErrorMessage($name, $checkboxOptions) ? 'has-error' : '';

        $htmlForm = '<div class="form-group '.$requiredClass.$hasError.'">';
        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $listStyle = isset($options['list_style']) ? $options['list_style'] : 'inline';
        $htmlForm .= '<ul class="checkbox list-'.$listStyle.'">';

        if (isset($options['value'])) {
            $value = $options['value'];
            if (is_array($options['value'])) {
                $value = new Collection($options['value']);
            }
        } else {
            $value = new Collection();
        }

        foreach ($checkboxOptions as $key => $option) {
            $fieldParams = ['id' => $name.'_'.$key];
            if (isset($options['v-model'])) {
                $fieldParams += ['v-model' => $options['v-model']];
            }

            $htmlForm .= '<li><label for="'.$name.'_'.$key.'">';
            $htmlForm .= FormFacade::checkbox($name.'[]', $key, $value->contains($key), $fieldParams);
            $htmlForm .= $option;
            $htmlForm .= '&nbsp;</label></li>';
        }
        $htmlForm .= '</ul>';

        $htmlForm .= $this->getInfoTextLine($options);

        $htmlForm .= $this->getErrorMessage($name, $checkboxOptions);
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    private function getErrorMessage($name, $checkboxOptions = [])
    {
        $message = '';
        $message .= $this->errorBag->first($this->formatArrayName($name)).' ';
        foreach (array_keys($checkboxOptions) as $index => $key) {
            $message .= $this->errorBag->first($name.'.'.$index).' ';
        }
        $message = trim($message);

        return $message ? '<span class="help-block small">'.$message.'</span>' : null;
    }

    /**
     * Display a text on the form as disabled input.
     *
     * @param string $name    The disabled text field name.
     * @param string $value   The field value (displayed text).
     * @param array  $options The attributes for the disabled text field.
     *
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

        $htmlForm = '<div class="form-group'.$requiredClass.'">';
        $htmlForm .= FormFacade::label($name, $label, ['class' => 'control-label']);
        $htmlForm .= '<div class="form-control" '.$fieldId.'readonly>'.$value.'</div>';
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    /**
     * File input field that wrapped with form-group bootstrap div.
     *
     * @param string $name    The file field name and id attribute.
     * @param array  $options Additional attribute for the file input.
     *
     * @return string Generated file input form field.
     */
    public function file($name, $options = [])
    {
        $options['type'] = 'file';

        return $this->text($name, $options);
    }

    /**
     * One form which only have "one button" and "hidden fields".
     * This is suitable for, e.g. set status, delete button,
     * or any other "one-click-action" button.
     *
     * @param array  $form_params    The form attribtues.
     * @param string $button_label   The button text or label.
     * @param array  $button_options The button attributes.
     * @param array  $hiddenFields   Additional hidden fields.
     *
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
     * @param array  $form_params    The form attribtues.
     * @param string $button_label   The delete button text or label.
     * @param array  $button_options The button attributes.
     * @param array  $hiddenFields   Additional hidden fields.
     *
     * @return string Generated delete form button.
     */
    public function delete($form_params = [], $button_label = 'x', $button_options = [], $hiddenFields = [])
    {
        $form_params['method'] = 'delete';
        $form_params['class'] = isset($form_params['class']) ? $form_params['class'] : 'del-form pull-right';
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

        $htmlForm = '<div class="form-group '.$hasError.'">';
        $htmlForm .= FormFacade::label($name, $label, ['class' => 'control-label']);

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
     * @param string $name    The price field name and id attribute.
     * @param array  $options Additional attribute for the price input.
     *
     * @return string Generated price input form field.
     */
    public function price($name, $options = [])
    {
        $options['addon'] = ['before' => isset($options['currency']) ? $options['currency'] : 'Rp'];
        $options['class'] = isset($options['class']) ? $options['class'].' text-right' : 'text-right';

        return $this->text($name, $options);
    }

    /**
     * Set the form field label.
     *
     * @param string $name    The field name.
     * @param array  $options The field attributes.
     *
     * @return string Generated form field label.
     */
    private function setFormFieldLabel($name, $options)
    {
        if (isset($options['label']) && $options['label'] != false) {
            $label = isset($options['label']) ? $options['label'] : $this->formatFieldLabel($name);

            return FormFacade::label($name, $label, ['class' => 'control-label']).'&nbsp;';
        } elseif (!isset($options['label'])) {
            return FormFacade::label($name, $this->formatFieldLabel($name), ['class' => 'control-label']).'&nbsp;';
        }
    }

    /**
     * Reformat the field label.
     *
     * @param string $fieldName The field name.
     *
     * @return string Generated field name.
     */
    private function formatFieldLabel($fieldName)
    {
        return ucwords(preg_replace('/(_id$|_)/im', ' ', $fieldName));
    }

    /**
     * Format the name attribute for muti-select and checkbox input field.
     *
     * @param string $name Field name.
     *
     * @return string Generated field name as array square bracket.
     */
    private function formatArrayName($name)
    {
        return str_replace(['[', ']'], ['.', ''], $name);
    }

    /**
     * Get field attributes based on given option.
     *
     * @param array $options Additional form field attributes.
     *
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
        if (isset($options['disabled']) && $options['disabled'] == true) {
            $fieldAttributes += ['disabled'];
        }
        if (isset($options['required']) && $options['required'] == true) {
            $fieldAttributes += ['required'];
        }
        if (isset($options['autofocus']) && $options['autofocus'] == true) {
            $fieldAttributes += ['autofocus'];
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
        if (isset($options['style'])) {
            $fieldAttributes += ['style' => $options['style']];
        }

        return $fieldAttributes;
    }

    /**
     * Get the info text line for input field.
     *
     * @param array $options Additional field attributes.
     *
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
