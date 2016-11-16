var ajaxForm = {

    /**
     * @param {Object} form - The form to be processed
     * @param {string} prefix - The error message prefix (set as 'data-prefix' data attribute on submit button)
     * @param requestData - URL encoded text string | serialized form data (i.e., 'form.serialize()')
     * @param {Array|null} successCallbacks - function(s) to be executed on success (EXAMPLE:[successCb.setAuthorized])
     * @param {Array|null} errorCallbacks - function(s) to be executed on error (See example above)
     */
    validate: function (form, prefix, requestData, successCallbacks, errorCallbacks) {

        // Clear any existing form errors on the page
        formErrors.clear();

        // Disable the Submit button and display feedback
        buttonFeedback.toggleFeedback(form, 'form', 'show');

        // Ensure we retrieve the correct method even if form-method spoofing is applied
        var formId = form.attr('id');
        var method = $("#" + formId + ' ' + "input[name=_method]").length ? $("#" + formId + ' ' + "input[name=_method]").val() : form.attr('method');

        var ajaxRequest = $.ajax({
            url: form.attr('action'),
            type: method,
            data: requestData
        });

        var self = this;

        ajaxRequest.done(function (data, textStatus, jqXHR) {
            // If success callbacks were provided, execute each one of them
            if (successCallbacks != null) {
                self.executeCallbacks(successCallbacks, data, textStatus, jqXHR);
            }
        });

        ajaxRequest.fail(function (data, textStatus, jqXHR) {
            try{
                var errors = $.parseJSON(data.responseText);
                // Set the Ajax Form Errors
                formErrors.set(errors, prefix);
            }
            catch (e){
                // Not a Form Request fail
            }

            // If error callbacks were provided, execute each one of them
            if (errorCallbacks != null) {
                self.executeCallbacks(errorCallbacks, data, textStatus, jqXHR);
            }
        });

        ajaxRequest.always(function (data, textStatus, jqXHR) {
            // Make sure we can work with the returned data
            pData = globalFunctions.getParsedData(data);

            // If a redirect path has been provided, redirect there now
            if (pData.redirector) {
                location.replace(pData.redirector);
            }
            // If the reloader has been called, refresh the page
            else if (pData.reloader) {
                location.reload();
            }
            else{ // The page maintains its original state, so return the submit button to its original state
                buttonFeedback.toggleFeedback(form, 'form', 'hide');
            }
        });
    },

    executeCallbacks: function(callbacks, data, textStatus, jqXHR){
        $.each(callbacks, function (index, value) {
            value(data, textStatus, jqXHR);
        });
    }
};