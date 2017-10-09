<?php

namespace Luthfi\FormField;

use Collective\Html\FormFacade;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Session;

/**
 * FormField Class (Site FormField Service).
 */
class FormField
{
    protected $errorBag;
    protected $options;
    protected $fieldParams;

    public function __construct()
    {
        $this->errorBag = Session::get('errors', new MessageBag());
    }

    public function open($options = [])
    {
        return FormFacade::open($options);
    }

    public function close()
    {
        return FormFacade::close();
    }

    public function text($name, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($this->formatArrayName($name)) ? 'has-error' : '';
        $htmlForm = '<div class="form-group '.$requiredClass.$hasError.'">';

        $value = isset($options['value']) ? $options['value'] : null;
        $type = isset($options['type']) ? $options['type'] : 'text';

        $fieldParams = ['class'=>'form-control'];
        if (isset($options['class'])) {
            $fieldParams['class'] .= ' '.$options['class'];
        }

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        if (isset($options['addon'])) {
            $htmlForm .= '<div class="input-group">';
        }
        if (isset($options['addon']['before'])) {
            $htmlForm .= '<span class="input-group-addon">'.$options['addon']['before'].'</span>';
        }
        if (isset($options['readonly']) && $options['readonly'] == true) {
            $fieldParams += ['readonly'];
        }
        if (isset($options['disabled']) && $options['disabled'] == true) {
            $fieldParams += ['disabled'];
        }
        if (isset($options['required']) && $options['required'] == true) {
            $fieldParams += ['required'];
        }
        if (isset($options['min'])) {
            $fieldParams += ['min' => $options['min']];
        }
        if (isset($options['placeholder'])) {
            $fieldParams += ['placeholder' => $options['placeholder']];
        }
        if (isset($options['style'])) {
            $fieldParams += ['style' => $options['style']];
        }
        if (isset($options['id'])) {
            $fieldParams += ['id' => $options['id']];
        }

        $htmlForm .= FormFacade::input($type, $name, $value, $fieldParams);

        if (isset($options['addon']['after'])) {
            $htmlForm .= '<span class="input-group-addon">'.$options['addon']['after'].'</span>';
        }
        if (isset($options['addon'])) {
            $htmlForm .= '</div>';
        }
        if (isset($options['info'])) {
            $class = isset($options['info']['class']) ? $options['info']['class'] : 'info';
            $htmlForm .= '<p class="text-'.$class.' small">'.$options['info']['text'].'</p>';
        }
        $htmlForm .= $this->errorBag->first($this->formatArrayName($name), '<span class="help-block small">:message</span>');

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    public function textarea($name, $options = [])
    {
        $hasError = $this->errorBag->has($name) ? 'has-error' : '';
        $htmlForm = '<div class="form-group '.$hasError.'">';

        $rows = isset($options['rows']) ? $options['rows'] : 3;
        $value = isset($options['value']) ? $options['value'] : null;

        $fieldParams = ['class'=>'form-control', 'rows' => $rows];

        if (isset($options['readonly']) && $options['readonly'] == true) {
            $fieldParams += ['readonly'];
        }
        if (isset($options['disabled']) && $options['disabled'] == true) {
            $fieldParams += ['disabled'];
        }
        if (isset($options['required']) && $options['required'] == true) {
            $fieldParams += ['required'];
        }
        if (isset($options['placeholder'])) {
            $fieldParams += ['placeholder' => $options['placeholder']];
        }

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $htmlForm .= FormFacade::textarea($name, $value, $fieldParams);
        $htmlForm .= $this->errorBag->first($name, '<span class="help-block small">:message</span>');
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    public function select($name, $selectOptions, $options = [])
    {
        $requiredClass = (isset($options['required']) && $options['required'] == true) ? 'required ' : '';
        $hasError = $this->errorBag->has($name) ? 'has-error' : '';
        $htmlForm = '<div class="form-group '.$requiredClass.$hasError.'">';

        $value = isset($options['value']) ? $options['value'] : null;

        $fieldParams = ['class'=>'form-control'];
        if (isset($options['class'])) {
            $fieldParams['class'] .= ' '.$options['class'];
        }

        if (isset($options['readonly']) && $options['readonly'] == true) {
            $fieldParams += ['readonly'];
        }
        if (isset($options['disabled']) && $options['disabled'] == true) {
            $fieldParams += ['disabled'];
        }
        if (isset($options['required']) && $options['required'] == true) {
            $fieldParams += ['required'];
        }
        if (isset($options['multiple']) && $options['multiple'] == true) {
            $fieldParams += ['multiple', 'name' => $name.'[]'];
        }
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

        if ($selectOptions instanceof Collection) {
            $selectOptions = !empty($placeholder) ? $selectOptions->prepend($placeholder[''], '') : $selectOptions;
        } else {
            $selectOptions = $placeholder + $selectOptions;
        }

        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $htmlForm .= FormFacade::select($name, $selectOptions, $value, $fieldParams);
        $htmlForm .= $this->errorBag->first($name, '<span class="help-block small">:message</span>');

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    public function multiSelect($name, $selectOptions, $options = [])
    {
        $options['multiple'] = true;

        return $this->select($name, $selectOptions, $options);
    }

    public function email($name, $options = [])
    {
        $options['type'] = 'email';

        return $this->text($name, $options);
    }

    public function password($name, $options = [])
    {
        $options['type'] = 'password';

        return $this->text($name, $options);
    }

    public function radios($name, array $radioOptions, $options = [])
    {
        $hasError = $this->errorBag->has($name) ? 'has-error' : '';

        $htmlForm = '<div class="form-group '.$hasError.'">';
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

            $htmlForm .= '<li><label for="'.$name.'_'.$key.'">';
            $htmlForm .= FormFacade::radio($name, $key, $value, $fieldParams);
            $htmlForm .= $option;
            $htmlForm .= '&nbsp;</label></li>';
        }
        $htmlForm .= '</ul>';
        $htmlForm .= $this->errorBag->first($name, '<span class="help-block small">:message</span>');

        $htmlForm .= '</div>';

        return $htmlForm;
    }

    public function checkboxes($name, array $checkboxOptions, $options = [])
    {
        $hasError = $this->errorBag->has($name) ? 'has-error' : '';
        $htmlForm = '<div class="form-group '.$hasError.'">';

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
        $htmlForm .= $this->errorBag->first($name, '<span class="help-block small">:message</span>');
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    public function textDisplay($name, $value, $options = [])
    {
        $label = isset($options['label']) ? $options['label'] : $this->formatFieldLabel($name);

        $htmlForm = '<div class="form-group">';
        $htmlForm .= FormFacade::label($name, $label, ['class'=>'control-label']);
        $htmlForm .= '<div class="form-control" readonly>'.$value.'</div>';
        $htmlForm .= '</div>';

        return $htmlForm;
    }

    public function file($name, $options = [])
    {
        $hasError = $this->errorBag->has($name) ? 'has-error' : '';
        $label = isset($options['label']) ? $options['label'] : $this->formatFieldLabel($name);

        $htmlForm = '<div class="form-group '.$hasError.'">';
        $htmlForm .= $this->setFormFieldLabel($name, $options);

        $fieldParams = ['class'=>'form-control'];
        if (isset($options['class'])) {
            $fieldParams['class'] .= ' '.$options['class'];
        }
        if (isset($options['multiple']) && $options['multiple'] == true) {
            $name = $name.'[]';
            $fieldParams += ['multiple' => true];
        }

        $htmlForm .= FormFacade::file($name, $fieldParams);
        if (isset($options['info'])) {
            $htmlForm .= '<p class="text-'.$options['info']['class'].' small">'.$options['info']['text'].'</p>';
        }
        $htmlForm .= $this->errorBag->first($name, '<span class="help-block small">:message</span>');
        $htmlForm .= '</div>';

        return $htmlForm;
    }

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
        $htmlForm .= FormFacade::label($name, $label, ['class'=>'control-label']);

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

    public function price($name, $options = [])
    {
        $options['addon'] = ['before' => isset($options['currency']) ? $options['currency'] : 'Rp'];
        $options['class'] = 'text-right';

        return $this->text($name, $options);
    }

    private function setFormFieldLabel($name, $options)
    {
        if (isset($options['label']) && $options['label'] != false) {
            $label = isset($options['label']) ? $options['label'] : $this->formatFieldLabel($name);

            return FormFacade::label($name, $label, ['class'=>'control-label']).'&nbsp;';
        } elseif (!isset($options['label'])) {
            return FormFacade::label($name, $this->formatFieldLabel($name), ['class'=>'control-label']).'&nbsp;';
        }
    }

    private function formatFieldLabel($fieldName)
    {
        return ucwords(preg_replace('/(_id$|_)/im', ' ', $fieldName));
    }

    private function formatArrayName($name)
    {
        return str_replace(['[', ']'], ['.', ''], $name);
    }
}
