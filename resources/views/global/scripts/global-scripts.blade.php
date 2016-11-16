<script>
    // AJAX Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': appGlobals.csrf
        }
    });

    // Set Sweet Alert 2 Defaults
    swal.setDefaults({
        confirmButtonText: 'Got It'
        //confirmButtonColor: '#3c9dd0'
    });

    // Execute basic AJAX form validation with no callbacks (outside of Vue)
    $('.ajax-validate-blade').on('click', function (e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var prefix = $(this).data('prefix');
        var data = form.serialize();

        ajaxForm.validate(form, prefix, data, null, null);
    });

    // Toggle Feedback for a button (outside of Vue)
    $('.feedback-button-blade').on('click', function (e) {
        e.preventDefault();
        var btnId = $(this).data('button-id');
        var btnType = $(this).data('button-type');
        var process = $(this).data('process-form') == 'yes';
        buttonFeedback.toggleFeedback($('#' + btnId), btnType, 'show', process);
    });

    // Confirm and process item deletion using Sweet Alert 2 (outside of Vue)
    $('.sweet-delete-blade').on('click', function () {
        var path = $(this).data('delete-path');
        var item = $(this).attr('data-item-name') ? $(this).data('item-name') : null;
        var redirect = $(this).attr('data-redirect-path') ? $(this).data('redirect-path') : null;
        confirmDelete.swalConfirmDelete(path, item, redirect);
    });
</script>

<!-- Sweet Alert Flash Messages -->
@if(session()->has('sweet_flash'))
    <script>
        swal({
            title: "{{session('sweet_flash.title')}}",
            text: "{{session('sweet_flash.message')}}",
            type: "{{session('sweet_flash.level')}}",
            timer: 5000,
            confirmButtonText: "Dismiss"
        });
    </script>
@endif

@if(session()->has('sweet_dismiss'))
    <script type="text/javascript">
        swal({
            title: "{{session('sweet_dismiss.title')}}",
            text: "{{session('sweet_dismiss.message')}}",
            type: "{{session('sweet_dismiss.level')}}"
        });
    </script>
@endif