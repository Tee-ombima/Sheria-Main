$(document).ready(function(){
    function toggleOtherField(selectId, otherDivId) {
        if ($('#' + selectId).val() === 'other') {
            $('#' + otherDivId).show();
        } else {
            $('#' + otherDivId).hide();
        }
    }

    $('#highschool').change(function(){
        toggleOtherField('highschool', 'highschool_other_div');
    });

    $('#specialisation').change(function(){
        toggleOtherField('specialisation', 'specialisation_other_div');
    });

    $('#course').change(function(){
        toggleOtherField('course', 'course_other_div');
    });

    $('#award').change(function(){
        toggleOtherField('award', 'award_other_div');
    });

    $('#grade').change(function(){
        toggleOtherField('grade', 'grade_other_div');
    });

    // Initial load to handle pre-selected values
    toggleOtherField('highschool', 'highschool_other_div');
    toggleOtherField('specialisation', 'specialisation_other_div');
    toggleOtherField('course', 'course_other_div');
    toggleOtherField('award', 'award_other_div');
    toggleOtherField('grade', 'grade_other_div');
});
