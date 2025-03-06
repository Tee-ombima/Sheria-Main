
$(document).ready(function(){
    function toggleOtherField(selectId, otherDivId) {
        if ($('#' + selectId).val() === 'other') {
            $('#' + otherDivId).show();
        } else {
            $('#' + otherDivId).hide();
        }
    }

    $('#ethnicity').change(function(){
        toggleOtherField('ethnicity', 'ethnicity_other_div');
    });

    

    $('#salutation').change(function(){
        toggleOtherField('salutation', 'salutation_other_div');
    });

    // Initial load to handle pre-selected values
    toggleOtherField('ethnicity', 'ethnicity_other_div');
    toggleOtherField('salutation', 'salutation_other_div');
});
