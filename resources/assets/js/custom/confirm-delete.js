var confirmDelete = {
    /**
     * Process the confirmation and deletion of an item through a Sweet Alert 2 delete modal
     * Reference: limonte.github.io/sweetalert2/
     *
     * @param {string} path - the URL of the item's delete route
     * @param {string|null} item - the name of the item being deleted (i.e., 'Your profile'), defaults to 'This item'
     * @param {string|null} redirect - the URL to redirect to upon successful deletion (optional, defaults to false)
     */
    swalConfirmDelete: function (path, item, redirect) {
        // Display Sweet Alert Warning with Confirm/Cancel buttons
        var name = item == null ? 'This item' : item;

        swal({
            title: 'Are you sure?',
            text: 'This action can not be undone',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'No, Cancel',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    // Delete the Item via AJAX
                    var ajaxDelete = $.ajax({
                        url: path,
                        type: 'DELETE'
                    });
                    ajaxDelete.done(function (data, textStatus, jqXHR) {
                        var confirmText = 'OK';
                        // Generate the success message based on whether or not a redirect path was provided
                        var deleteInfo = data.message.length > 0 ? name + ' has been deleted.<br>' +
                        data.message : name + ' has been deleted.';
                        var msg = !redirect ? deleteInfo : deleteInfo + '<br>You will be redirected when you click' +
                        confirmText + '.';

                        swal({
                            title: 'Success!',
                            html: msg,
                            type: 'success',
                            confirmButtonText: confirmText,
                            showCloseButton: true,
                            onClose: function () {
                                if (redirect != null) {
                                    window.location.href = redirect;
                                }

                                resolve();
                            }
                        });
                    });

                    ajaxDelete.fail(function (data, textStatus, jqXHR) {
                        var parsed = globalFunctions.getParsedData(data);
                        var message = parsed.message ? parsed.message : parsed.statusText;
                        // Return the Failure Message
                        swal({
                            title: 'Error (' + data.status + ')!',
                            html: name + ' could NOT be deleted.<br>' + message,
                            type: 'error'
                        });
                    });
                });
            }
        }).then(function () {
        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal({
                    title: 'Cancelled',
                    text: name + ' is safe. It has NOT been deleted.',
                    type: 'info',
                    timer: 5000,
                    confirmButtonText: "Whew! Thanks."
                });
            }
        });
    }
};