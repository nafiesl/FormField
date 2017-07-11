# Laravel Boostrap Form Field
[![StyleCI](https://styleci.io/repos/79648139/shield?branch=master)](https://styleci.io/repos/79648139)
[![Build Status](https://travis-ci.org/nafiesl/FormField.svg?branch=master)](https://travis-ci.org/nafiesl/FormField)

This is form fields wrapper for laravel 5.3 and 5.4 with bootstrap 3

## How to install

Install this package through [Composer](https://getcomposer.org). Run following from terminal:

#### For laravel 5.3 and 5.4

```
composer require luthfi/formfield
```

Update `config/app.php`, add provider and aliases :
```php
// providers
Luthfi\FormField\FormFieldServiceProvider::class,

// aliases
'FormField' => Luthfi\FormField\FormFieldFacade::class,
'Form'      => Collective\Html\FormFacade::class,
'Html'      => Collective\Html\HtmlFacade::class,
```

#### For laravel 5.5

```
composer require luthfi/formfield dev-master
```
> this package will auto discovered

## How to use

In your `blade` file, use this following sintax :
```blade
{!! FormField::text('name') !!}
```

will produce:
```html
<div class="form-group ">
    <label for="name" class="control-label">Name</label>
    <input class="form-control" name="name" type="text" id="name">
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
    <div class="checkbox">
        <li>
            <label for="group_1">
                <input id="group_1" name="group[]" type="checkbox" value="1">
                Admin
            </label>
        </li>
        <li>
            <label for="group_2">
                <input id="group_2" name="group[]" type="checkbox" value="2">
                Member
            </label>
        </li>
    </div>
</div>

<!-- Radios -->
<div class="form-group ">
    <div class="radio">
        <label for="status_a">
            <input id="status_a" name="status" type="radio" value="a">
            Active
        </label>
        <label for="status_b">
            <input id="status_b" name="status" type="radio" value="b">
            Inactive
        </label>
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