# Laravel Boostrap Form Field
[![StyleCI](https://styleci.io/repos/79648139/shield?branch=master)](https://styleci.io/repos/79648139)
[![Build Status](https://travis-ci.org/nafiesl/FormField.svg?branch=master)](https://travis-ci.org/nafiesl/FormField)
[![Total Downloads](https://poser.pugx.org/luthfi/formfield/downloads)](https://packagist.org/packages/luthfi/formfield)

This package is the extension of Laravelcollective Form for Laravel 5.3, 5.4 and 5.5 with Twitter Bootstrap 3 and 4 form fields wrapper.

## How to install

Install this package through [Composer](https://getcomposer.org). Run following from terminal:

```
composer require luthfi/formfield
```

##### For laravel 5.5 and newer

> this package will auto discovered

##### For laravel 5.3 and 5.4

Update `config/app.php`, add provider and aliases :
```php
// providers
Luthfi\FormField\FormFieldServiceProvider::class,

// aliases
'FormField' => Luthfi\FormField\FormFieldFacade::class,
'Form'      => Collective\Html\FormFacade::class,
'Html'      => Collective\Html\HtmlFacade::class,
```

##### For Bootstrap 3

If you are using Bootstrap 3, please use `1.*` version instead:

```bash
composer require luthfi/formfield 1.*
```

## How to use

In your `blade` file, use this following sintax :

```blade
{!! FormField::text('name') !!}
```

will produce:

```html
<div class="form-group ">
    <label for="name" class="control-label">Name</label>
    <input class="form-control" name="name" id="name" type="text">
</div>
```

Or other example for Checkbox and Radios. We can use **numeric array** or **associative array** for Labels and Values :

```blade
{!! FormField::checkboxes('group', [1 => 'Admin', 'Member']) !!}
{!! FormField::radios('status', ['a' => 'Active', 'b' => 'Inactive']) !!}
```

And they will produce :

```html
<!-- Checkboxes -->
<div class="form-group ">
    <label for="group" class="control-label">Group</label>
    <div>
        <div class="form-check form-check-inline">
            <input id="group_1" class="form-check-input" name="group[]" value="1" type="checkbox">
            <label for="group_1" class="form-check-label">Admin</label>
        </div>
        <div class="form-check form-check-inline">
            <input id="group_2" class="form-check-input" name="group[]" value="2" type="checkbox">
            <label for="group_2" class="form-check-label">Member</label>
        </div>
    </div>
</div>

<!-- Radios -->
<div class="form-group ">
    <label for="status" class="control-label">Status</label>
    <div>
        <div class="form-check form-check-inline">
            <input id="status_a" class="form-check-input" name="status" value="a" type="radio">
            <label for="status_a" class="form-check-label">Active</label>
        </div>
        <div class="form-check form-check-inline">
            <input id="status_b" class="form-check-input" name="status" value="b" type="radio">
            <label for="status_b" class="form-check-label">Inactive</label>
        </div>
    </div>
</div>
```
## Avaliable Form Fields

```blade
{!! FormField::open($options) !!}
{!! FormField::text('name') !!}
{!! FormField::textarea('field_name') !!}
{!! FormField::select('field_name', $options) !!}
{!! FormField::multiSelect('field_name', $options) !!}
{!! FormField::email('email_field') !!}
{!! FormField::password('password_field') !!}
{!! FormField::radios('status', ['a' => 'Active', 'b' => 'Inactive']) !!}
{!! FormField::checkboxes('group', [1 => 'Admin', 'Member']) !!}
{!! FormField::textDisplay('label', 'value_to_display') !!}
{!! FormField::file('file_field') !!}
{!! FormField::price('price_field') !!}
{!! FormField::close() !!}
```