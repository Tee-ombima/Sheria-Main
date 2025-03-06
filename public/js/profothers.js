$(document).ready(function(){
    function toggleOtherField(selectId, otherDivId) {
        if ($('#' + selectId).val() === 'other') {
            $('#' + otherDivId).show();
        } else {
            $('#' + otherDivId).hide();
        }
    }

    $('#prof_area_of_study_high_school_level').change(function(){
        toggleOtherField('prof_area_of_study_high_school_level', 'prof_area_of_study_other_div');
    });

    $('#prof_area_of_specialisation').change(function(){
        toggleOtherField('prof_area_of_specialisation', 'prof_area_of_specialisation_other_div');
    });

    $('#prof_award').change(function(){
        toggleOtherField('prof_award', 'prof_award_other_div');
    });

    $('#prof_grade').change(function(){
        toggleOtherField('prof_grade', 'prof_grade_other_div');
    });

    // Initial load to handle pre-selected values
    toggleOtherField('prof_area_of_study_high_school_level', 'prof_area_of_study_other_div');
    toggleOtherField('prof_area_of_specialisation', 'prof_area_of_specialisation_other_div');
    toggleOtherField('prof_award', 'prof_award_other_div');
    toggleOtherField('prof_grade', 'prof_grade_other_div');
});
