# Base Starter Package
My personal base configuration for new Laravel projects. This package modifies a fresh Laravel 5.3 installation to include:
> * AWS support ([aws/aws-sdk-php](https://aws.amazon.com/sdk-for-php/) and [league/flysystem-aws-s3-v3](https://packagist.org/packages/league/flysystem-aws-s3-v3))
* The [Laravel Collective](https://laravelcollective.com/docs/5.3/html) package
* Jeffrey Way's [Laracast Generators](https://github.com/laracasts/Laravel-5-Generators-Extended)
* [barryvdh](https://github.com/barryvdh/)'s [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper)
* [Font Awesome](http://fontawesome.io/) (pulled in via Bower)
* [Sweet Alert 2](https://limonte.github.io/sweetalert2/) (pulled in via Bower)
* [Animate.css](https://daneden.github.io/animate.css/) and [Cookies.js](https://developer.mozilla.org/en-US/docs/Web/API/document.cookie)
* Laravel [Notifications](https://laravel.com/docs/5.3/notifications) and [Pagination](https://laravel.com/docs/5.3/pagination) views already published
* Migrations for [Failed Queue Jobs](https://laravel.com/docs/5.3/queues#dealing-with-failed-jobs) and [Notifications](https://laravel.com/docs/5.3/notifications) already generated
* A Global View Composer to add global variables to every view
* Customized [flash messages](#flash-messages) based on [Jeffrey Way](https://github.com/JeffreyWay)'s [Elegant Flash Messaging](https://laracasts.com/series/build-project-flyer-with-me/episodes/9) lesson on [Laracasts](https://laracasts.com)
* Custom [ajax form](#ajax-forms) script with styled form errors
* Custom [delete confirmation button](#delete-confirmation) for use within both Blade and Vue
* Custom [feedback button](#feedback-button) for use within both Blade and Vue
* Custom helpers.php file with some basic global helper functions for use throughout the app
* gulpfile customized to copy files, compile scripts and styles, translate ES2015 to ES5, and version all files so they can be accessed appropriately in (new/custom) app.blade.php blade wrapper.

If this configuration works for your purposes, feel free to use/fork it in any way you see fit. A complete list of packages, directory, and file additions/changes is [listed below](#modifications).

## Installation:

1. [Fork](https://help.github.com/articles/fork-a-repo/) this [repo](https://github.com/dojorob76/laravel-5-3-vue-2-app-starter) and clone it into your project directory, then run `composer install`, `npm install`, `bower install`, and `gulp`. 
2. Copy .env.example to a new file called .env in the same directory 
3. Install the *Laravel Key* with the following command:
    ```` $ php artisan key:generate ````
3. Open app/Providers/AppServiceProvider.php and uncomment the code within the 'register' function
4. `composer update` to generate the IDE Helper files for [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)

## Custom Elements:
#### <a name="flash-messages"></a>Flash Messages
As mentioned above, this is a slight modification of [Jeffrey Way](https://github.com/JeffreyWay)'s [Elegant Flash Messaging](https://laracasts.com/series/build-project-flyer-with-me/episodes/9) lesson on [Laracasts](https://laracasts.com).

##### Files
1. Back End
    * _app/Http/Flasher.php_ the 'Flasher' class.
    * _app/Http/helpers.php_ ('flasher' function) allows us to call the Flasher 'message' function from anywhere within the app.
2. Front End
    * _resources/views/global/partials/boot-flash-messages.blade.php_ contains the Bootstrap style messages
    * _resources/views/global/scripts/global-scripts.blade.php_ (bottom of file) contains the Sweet Alert 2 style messages
    
##### Variables

1. 'message' - String - The message that should be displayed
2. 'title' - String - The title of the message
3. 'level' - String - The message status level, options include:
    * 'success'
    * 'warning'
    * 'info'
    * 'danger' (Bootstrap only)
    * 'error' (Sweet Alert only)
    * 'question' (Sweet Alert only)
4. 'type' - String - The flash message type, options include:
    * 'boot_flash' - a Bootstrap style alert message
    * 'boot_dismiss' - a Bootstrap style alert message that is dismissible
    * 'sweet_flash' - a Sweet Alert 2 timed message (currently set to 5 seconds, options can be changed in the front end file listed above)
    * 'sweet_dismiss' - a Sweet Alert 2 message that must be clicked to be dismissed

##### Implementation
```` flasher()->message('message', 'title', 'level', 'type')````

##### Examples
```` flasher()->message('My awesome message', 'Hey!', 'success', 'boot_dismiss')````
Will generate a Bootstrap style dismissible success message that says: "__Hey!__ My awesome message"

```` flasher()->message('My awesomer message', 'Yo!', 'warning', 'sweet_flash')````
Will generate a Sweet Alert 2 style timed warning message that says: "__Yo!__ My awesomer message"

If you do not provide anything but the message variable, the flasher will default to a 'boot_flash' 'info' message with a title of 'FYI', so...
```` flasher()->message('My awesomest message so far')````
Will generate a Bootstrap style info message that says: "__FYI__ My awesomest message so far".
Default message parameters can be changed in the Flasher class ('message' function).

##### Try it out
Open _routes/web.php_, and change...
```
Route::get('/', function () {
    return view('welcome');
});
```
to... 
```
Route::get('/', function () {
    flasher()->message('your-message-here', 'your-title-here', 'your-level-here', 'your-type-here')
    
    return view('welcome');
});
```
... then hit the welcome route to see it in action out of the box.

##### Notes
(Obviously...) The front end files must be present in the view in order for the flash messages to display. Out of the box, both files are included in _app.blade.php_, which is used as the view layout wrapper (currently extended by  _welcome.blade.php_)

#### <a name="ajax-forms"></a>Ajax Forms
Ajax forms allow us to make an `$.ajax` request outside of vue-resource, and display styled form errors (which can also be implemented within a Vue component using vue-resource for app consistency).
__Note:__ The ajaxForm 'validate' method also makes use of the custom [feedback button](#feedback-button).

##### Files
1. Back End
    * _app/resources/js/custom/ajax-form.js_ - process ajaxForm outside of vue-resource
    * _app/resources/js/custom/form-errors.js_ - display form errors after plain ajax or vue-resource call
    * _app/views/global/scripts/global-scripts.blade.php_ - ajaxForm 'validate' call for Blade + Ajax Headers setup
    * _resources/assets/sass/elements/form-errors.scss_ - Form Error styling
2. Front End
    * _resources/views/global/partials/forms/ajax-errors.blade.php_ - Form error partial for Blade
    * _resources/js/components/forms/AjaxErrors.vue_ - Form error component for Vue
    * _resources/views/global.partials/buttons/ajax-form-feedback-button.blade.php_ - Feedback display Submit button to process form via Ajax
    
##### Implementation
By way of explanation, we will use the 'create user' form as our example below.

1. Give each form an ID
    * Example: 
    `<form method="POST" action="{{action('UserController@store')}}" id="create-user-form">`
2. Place each field within a `form-group` with it's own ID, which should be the form id where '-form' is replaced by the field name.
    * Example (for the 'email' field):
    `<div class="form-group" id="create-user-email">`
3. Inside the form group, beneath the label and input, include a div with a class of `errlist` and `the-form-group-id` + `-error-msg`. This div will contain an empty `<ul></ul>`
    * Full HTML Example:
    ```
    <div class="form-group" id="create-user-email">
        <label for="email" class="control-label">Email:</label>
        <input type="email" name="email" value={{old('email')}} class="form-control">
        <div class="errlist create-user-email-error-msg"><ul class="mb0"></ul></div>
    </div>
    ```
    * Blade Template Example: 
    The error div is available as a Blade partial that takes the `error-msg` class prefix as an argument at _resources/views/global/partials/forms/ajax-errors.blade.php_, so the above can be written in a Blade template as:
    ```
    <div class="form-group" id="create-user-email">
        <label for="email" class="control-label">Email:</label>
        <input type="email" name="email" value={{old('email')}} class="form-control">
        @include('global.partials.forms._ajax-errors', ['e_pre' => 'create-user-email'])
    </div>
    ```
    * Vue Component Example:
    The error div is available as a Vue Component that takes the `error-msg` class prefix as a prop at _resources/js/components/forms/AjaxErrors.vue_. In this case, you would do the following:
    ```
    <div class="form-group" id="create-user-email">
        <label for="email" class="control-label">Email:</label>
        <input type="email" name="email" value={{old('email')}} class="form-control">
        <ajax-errors prefix="create-user-email"></ajax-errors>
    </div>
    ```
    * __NOTE:__ For hidden form fields that still require feedback, the "rounded" and/or "inline" class can be added to the error div for better presentation as follows:
        * Full HTML:
        `<div class="errlist create-user-email-error-msg rounded"><ul class="mb0"></ul></div>`
        * Blade Template - accepts an optional 'e_class' argument
        `@include('global.partials.forms._ajax-errors', [$e_pre => 'create-user-email', 'e_class' => 'rounded'])`
        * Vue Component - accepts an optional 'subClass' prop
        `<ajax-errors prefix="create-user-email sub-class="rounded"></ajax-errors>`
4. Pass the form, the error prefix (in this case "create-user-"), and the form data to the ajaxForm "validate" function with optional success and error callbacks.
    * Example:
    ```
    <div class="form-group">
        <button type="submit" class="btn btn-primary example-button">
            Submit
        </button>
    </div>
    
    $('.example-button').on('click', function (e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var prefix = 'create-user-';
        var data = form.serialize();
        
        var successMsg = function () {
            swal(
                'Success!',
                'The new user was created.',
                'success'
            )
        };
        
        var errorMsg = function(){
            swal(
                'Whoops!',
                'The new user could not be created.',
                'error'
            )
        };

        ajaxForm.validate(form, prefix, data, successMsg, errorMsg);
    });
    ```
    This would process the form via Ajax, display any validation errors, then display a Sweet Alert 2 success or error message after successful or unsuccessful form submission.
    
    * The `.ajax-validate-blade` class is available out of the box, and requires a `data-prefix` data attribute. 
    Adding this class to a submit button will run ajaxForm.validate with no success or error callbacks.
    Example:
    ```
    <div class="form-group">
        <button type="submit" class="btn btn-primary ajax-validate-blade" data-prefix='create-user-'>
            Submit
        </button>
    </div>
    ```
    This will automatically process the form via Ajax and display any validation errors.
    
5. If you wish to combine `ajaxForm` with `buttonFeedback` in Blade templates, the _ajax-form-feedback-button_ partial is available at _global/partials/buttons/_ajax-form-feedback-button.blade.php_. It accepts the following variables:
    * form_id : __required__ (would be "create-user-form" in this case)
    * field_prefix : __required__ (would be "create-user-" in this case)
    * btn_class : _optional_, defaults to primary
    * ajax_class : _optional_, defaults to ajax-validate-blade
    * btn_icon : _optional_, must be a [Font Awesome](http://fontawesome.io/icons/) icon name only (i.e., "user", not "fa-user")
    * btn_text : _optional_, defaults to 'Submit'
    * wait_text : _optional_, (the text to display while form is being submitted) defaults to 'Working...'
    
    So, to display a primary button that reads 'Submit', then changes to 'Working...' when the user clicks it and submits a form via ajax, displaying any validation errors, you could simply replace the code above with:
    
    ```
    <div class="form-group">
        @include('global.partials.buttons._ajax-form-feedback-button', ['form_id' => 'create-user-form', 'field_prefix' => 'create-user-'])
    </div>
    ```
    
6. To use `formErrors` only within vue-resource (i.e., not using `ajaxForm.validate`), the following methods are available:
    * `set`, which accepts the errors and the prefix as arguments, and will populate the form with its corresponding error messages
    * `clear`, which removes all error messages that have been displayed
    * Example:
    ```
    data(){
        return{
            userFields: {
                email: '',
                name: '',
                password: '',
                password_confirmation: ''
            },
            prefix: 'create-user-'
        }
    },
    methods: {
        processForm(form){
            // Show button feedback
            buttonFeedback.toggleFeedback(form, 'form', 'show');
            // Clear any form errors that may have already been set
            formErrors.clear();
            
            var self = this;
            // Submit the form via vue-resource
            this.$http.post(form.attr('action'), self.userFields)
                .then(function(response){
                    // do something on success
                })
                .catch(function(response){
                    // Display the validation errors in the form
                    formErrors.set(response.data, self.prefix)
                })
                .finally(function(){
                    // Return the submit button to it's original state
                    buttonFeedback.toggleFeedback(form, 'form', 'hide')
                })
        }
    }
    ```
    This will display feedback on the submit button, process the form via vue-resource, and display any validation errors exactly the same as within the Blade template.
    
#### <a name="delete-confirmation"></a>Delete Confirmation

Show a Sweet Alert 2 confirmation modal when a user clicks a delete button. If they confirm, process the item deletion via `$.ajax`, and if they cancel, display 'your item is safe' feedback.

##### Files

1. Back End
    * _resources/assets/js/custom/confirm-delete.js_ - contains the `swalConfirmDelete` function
    * _resources/views/global/scripts/global-scripts.blade.php_ - contains the call to `swalConfirmDelete` when the 'sweet-delete-blade' class is clicked
2. Front End
    * _resources/assets/js/components/buttons/DeleteButton.vue_ - 'confirm delete' Vue component
    * _resources/views/global/partials/buttons/delete-button.blade.php_ - 'confirm delete' Blade partial
    
##### Implementation

The `confirmDelete.swalConfirmDelete` function can be easily accessed in Blade via a dedicated _delete-button_ partial, or in Vue via the _DeleteButton_ component. Each takes its own unique arguments listed below.

1. Via Blade - include the _delete-button_ partial with the following arguments:
    * 'delete_path' : __required__ - The path to the delete route for the item
    * 'btn_txt' : _optional_ - The text for the delete button, defaults to 'Delete'
    * 'item_name' : _optional_ - The name of the item being deleted to display in the Sweet Alert modal, defaults to 'This item'
    * 'redirect_path' : _optional_ - The path that the user should be redirected to after successful deletion (if applicable)
2. Via Vue - include the _DeleteButton_ component with the following props:
    * 'model' : __required__ - the name of the model being deleted, as it is read by your routes file
    * 'modelId' : __required__ - the ID of the model being deleted, as it is read by your routes file
    * 'btnTxt' : _optional_ - The text for the delete button, defaults to 'Delete'
    * 'itemName' : _optional_ - The name of the item being deleted to display in the Sweet Alert modal, defaults to 'This item'
    * 'redirect' : _optional_  - The path that the user should be redirected to after successful deletion (if applicable)
    
In each case, `confirmDelete.swalConfirmDelete` is called behind the scenes and executed. To make changes to this function, simply open _resources/assets/js/custom/confirm-delete.js_ and adjust as necessary.
    
##### Examples

1. Blade include with defaults (button reads 'Delete', modal reads 'This item...', user is not redirected after delete):
    ```
        @include('global.partials.buttons.delete-button' ['delete_path' => action({{'ExampleController@destroy', $example->id}})])
    ```

2. Blade include with some optional arguments (modal reads 'Your example...', user is redirected to '/my-account' after delete):
    ```
        @include('global.partials.buttons.delete-button' ['delete_path' => '/example/1', 'item_name' => 'Your example', 'redirect_path' => '/my-account'])
    ```

3. Vue Component with defaults (button reads 'Delete', modal reads 'This item...', user is not redirected after delete):
    ```
        <delete-button model="example" :model-id="1"></delete-button>
    ```

4. Vue Component with some optional arguments (button reads 'Delete Example', modal reads 'Your example...'):
    ```
        <delete-button model="example" :model-id="1" btn-txt="Delete Example" item-name="Your example"></delete-button>
    ```

#### <a name="feedback-button"></a>Feedback Button

When a user clicks a button, change the button state so that the user receives feedback that something is happening, and the button can not be clicked again while the process is underway.

##### Files

1. Back End
    * _resources/assets/js/custom/button-feedback.js_ - contains the `toggleFeedback` function
    * _resources/views/global/scripts/global-scripts.blade.php_ - contains the call to `toggleFeedback` when the 'feedback-button-blade' class is clicked
2. Front End
    * _resources/assets/js/components/buttons/FeedbackButton.vue_ - 'feedback button' Vue component
    * _resources/views/global/partials/buttons/feedback-button.blade.php_ - 'feedback button' Blade partial
    
##### Implementation

The `buttonFeedback.toggleFeedback` function can be easily accessed in Blade via a dedicated _feedback-button_ partial, or in Vue via the _FeedbackButton_ component. Each takes its own unique arguments listed below.

1. Via Blade - include the _feedback-button_ partial with the following arguments:
    * 'btn_type' : __required__ - One of 'normal' for a regular button or 'form' for a form submit button
    * 'btn_id' : __required__ - A unique ID for the button if the type is 'normal', or the __FORM ID__ if it is a form submit button
    * 'btn_txt' : __required__ - The text for the button in it's original state
    * 'wait_txt' : _optional_ - The text to display during feedback, defaults to 'Working...'
    * 'btn_class' : _optional_ - The bootstrap class name of the button (i.e., 'primary', 'info', 'warning', etc.), defaults to 'default'
    * 'btn_icon' : _optional_ - Will display a font awesome icon before the text in the button. Must be a [Font Awesome](http://fontawesome.io/icons/) icon name only (i.e., "user", not "fa-user")
    * 'process' : _optional_ - (For 'form' types only) One of 'yes' to submit the form (does NOT use `$.ajax`), or 'no' (obviously to NOT submit the form)
2. Via Vue - include the _FeedbackButton_ component with the following props:
    * 'btnId' : __required__ - A unique ID for the button if the type is 'normal', or the __FORM ID__ if it is a form submit button
    * 'btTxt' : __required__ - The text for the button in it's original state
    * 'btnType' : _optional_ - One of 'normal' for a regular button or 'form' for a form submit button, _defaults to 'normal'_
    * 'waitTxt' : _optional_ - The text to display during feedback, defaults to 'Working...'
    * 'btnClass' : _optional_ - The bootstrap class name of the button (i.e., 'primary', 'info', 'warning', etc.), defaults to 'default'
    * 'btnIcon' : _optional_ - Will display a font awesome icon before the text in the button. Must be a [Font Awesome](http://fontawesome.io/icons/) icon name only (i.e., "user", not "fa-user")
    
In each case, `buttonFeedback.toggleFeedback` is called behind the scenes and executed. To make changes to this function, simply open _resources/assets/js/custom/button-feedback.js_ and adjust as necessary.

##### Examples

1. Blade 'normal' button include with defaults (button class is btn-default, wait text is 'Working...', no icon is displayed in original state):
    ```
        @include('global.partials.buttons.feedback-button' ['btn_type' => 'normal', 'btn_id' => 'example-button', 'btn_txt' => 'Click Me!'])
    ```

2. Blade form submit button include with some optional arguments (button class is btn-danger, and a font awesome 'ban' icon is displayed in the original state ):
    ```
        @include('global.partials.buttons.feedback-button' ['btn_type' => 'form', 'btn_id' => 'example-form', 'btn_txt' => 'Click Me!', 'btn_class' => 'danger', 'btn_icon' => 'ban'])
    ```
    * __NOTE:__ See the Ajax Forms section above for submitting ajaxForms with a Feedback button
    
3. Vue Component 'normal' button with defaults (button class is btn-default, wait text is 'Working...', no icon is displayed in original state):
    ```
        <feedback-button btn-id="example-button" btn-txt="Click Me!"></feedback-button>
    ```

4. Vue Component form submit button with some optional arguments (wait text is 'Hold, please...', button class is btn-warning, and a font awesome exclamation-triangle icon displays before the text in the original state):
    ```
        <feedback-button btn-id="example-form" btn-type="form" btn-txt="Click Me!" btn-class="warning" wait-txt="Hold, please..." btn-icon="exclamation-triangle"></feedback-button>
    ```


## <a name="modifications"></a>Modified from Fresh Laravel 5.3 Install as Follows:

1. Bower
    * .bowerrc
    * vendor/bower_components/ (Directory will be generated upon `bower install`)
    * Packages:
        * [Font Awesome](http://fontawesome.io/)
        * [Sweet Alert 2](https://limonte.github.io/sweetalert2/)
2. Composer
    * Require
        * [laravelcollective/html](https://laravelcollective.com/docs/5.3/html)
        * [aws/aws-sdk-php](https://aws.amazon.com/sdk-for-php/)
        * [league/flysystem-aws-s3-v3](https://packagist.org/packages/league/flysystem-aws-s3-v3)
    * Require Dev
        * [doctrine/dbal](http://www.doctrine-project.org/projects/dbal.html)
        * [laracasts/generators](https://github.com/laracasts/Laravel-5-Generators-Extended)
        * [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
            * Suggested by IDE Helper Package: [erusev/parsedown](https://github.com/erusev/parsedown)
            * Includes 'post-update-cmd' changes ("php artisan ide-helper:generate", "php artisan ide-helper:meta")
3. Directory Structure Additions
    * Added 'fonts' folder to 'resources/assets' (currently empty/commented out in gulpfile)
    * Added 'images' folder to 'resources/assets' (currently empty/commented out in gulpfile)
    * Added 'vendor' folder to 'resources/assets', which includes the following additional folders:
        * css/
        * js/
    * Added 'custom' folder to 'resources/assets/js'
4. New Files
    1. Vendor Publish ('resources/views/vendor/')
        * [notifications/](https://laravel.com/docs/5.3/notifications)
            * 'email', 'email-plain'
        * [pagination/](https://laravel.com/docs/5.3/pagination)
            * 'bootstrap-4', 'default', 'simple-bootstrap-4', 'simple-default'
    2. Custom CSS ('resources/assets/sass/')
        * _overrides.scss
        * global-styles.scss
        * elements/buttons.scss
        * elements/flex-boxes.scss
        * elements/form-errors.scss
        * utilities/base-styles.scss
        * utilities/inline-helpers.scss
        * utilities/mixins.scss
    3. Custom JS ('resources/assets/js/custom/')
        * ajax-forms.js
        * app-globals.js
        * button-feedback.js
        * confirm-delete.js
        * form-errors.js
        * global-functions.js
    4. Vendor CSS ('resources/vendor/css/')
        * [animate.css](https://daneden.github.io/animate.css/)
    5. Vendor JS ('resources/assets/vendor/js/')
        * [cookies.js](https://developer.mozilla.org/en-US/docs/Web/API/document.cookie)
        * es6-promise.auto.min.js (Placed by 'copy' method in gulpfile from bower_components, IE support for [Sweet Alert 2](https://limonte.github.io/sweetalert2/))
    6. Custom Vue Components ('resources/assets/js/components/')
        * buttons/DeleteButton.vue
        * buttons/FeedbackButton.vue
        * forms/AjaxErrors.vue
    7. Custom Views ('resources/assets/views/')
        * app.blade.php
        * global/partials/_app-meta-content.blade.php
        * global/partials/_boot-flash-messages.blade.php
        * global/partials/buttons/_delete-button.blade.php
        * global/partials/buttons/_feedback-button.blade.php
        * global/partials/buttons/_ajax-form-feedback-button.blade.php
        * global/partials/forms/_ajax-errors.blade.php
        * global/partials/forms/_error_list.blade.php
        * global/scripts/global-scripts.blade.php
    8. Configuration Files ('config/')
        * ide-helper.php
    9. App Functionality
        * app/Http/Flasher.php
        * app/Http/helpers.php (also included in the "files" array of composer autoload)
        * app/Http/ViewComposers/GlobalViewComposer.php
        * app/Providers/ViewComposerServiceProvider.php
5. Updated Files
    * gulpfile.js
    * resources/assets/sass/_variables.scss
    * resources/assets/sass/app.scss
    * resources/assets/js/app.js
    * resources/assets/views/welcome.blade.php
    * config/app.php
    * app/Providers/AppServiceProvider.php
    * readme.md (Original Laravel readme content still listed below)
6. Database Tables ('database/migrations/')
    * [notifications_table](https://laravel.com/docs/5.3/notifications)
    * [failed_jobs_table](https://laravel.com/docs/5.3/queues#dealing-with-failed-jobs)


# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
