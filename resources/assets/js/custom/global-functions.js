var globalFunctions = {
    changeActiveBtn: function (btnClass, classToSet) {
        $('.' + btnClass).each(function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        });
        $('.' + classToSet).addClass('active');
    },

    getParsedData: function(data){
        try{
            return $.parseJSON(data.responseText);
        }
        catch(e){
            return data;
        }
    }
};
