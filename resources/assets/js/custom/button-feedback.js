var buttonFeedback = {
    /**
     * Display or hide feedback for a regular or form button.
     *
     * @param {Object} id - the full jQuery #id (i.e., "$('#my-button')") of the button or form we are targeting
     * @param {string} type - one of 'normal' (for a non-form button) or 'form'
     * @param {string} toggleState - one of 'show' or 'hide'
     * @param {boolean} submit - if this is a form, determine whether or not this method should submit it
     */
    toggleFeedback: function (id, type, toggleState, submit = false) {
        var btn = type == 'form' ? id.find(':submit') : id;
        var origContent = btn.find('.btn-content');
        var waitContent = btn.find('.wait-content');
        var waitText = origContent.data('wait') ? origContent.data('wait') : 'Working...';

        if (toggleState == 'show') {
            this.showWaitFeedback(btn, origContent, waitContent, waitText);
            // If we are dealing with a form and are requesting submission, then submit it
            if (type == 'form' && submit) {
                id.submit();
            }
        } else {
            this.hideWaitFeedback(btn, origContent, waitContent);
        }
    },

    showWaitFeedback: function (btn, origContent, waitContent, waitText) {
        btn.prop("disabled", true);
        origContent.hide();
        waitContent.addClass('show-me').find('.wait-text').text(waitText);
    },

    hideWaitFeedback: function (btn, origContent, waitContent) {
        waitContent.removeClass('show-me');
        origContent.show();
        btn.prop("disabled", false);
    }
};