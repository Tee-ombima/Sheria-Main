$(document).ready(function(){

    function toggleHomeCountyOther() {
        if ($('#homecounty').val() === 'other') {
            $('#homecounty_other_div').show();
            $('#constituency_div').hide();
            $('#constituency_other_div').hide();
            $('#subcounty_div').hide();
            $('#subcounty_other_div').hide();
        } else {
            $('#homecounty_other_div').hide();
            $('#constituency_div').show();
        }
    }

    function toggleConstituencyOther() {
        if ($('#constituency').val() === 'other') {
            $('#constituency_other_div').show();
            $('#subcounty_div').hide();
            $('#subcounty_other_div').hide();
        } else {
            $('#constituency_other_div').hide();
            $('#subcounty_div').show();
        }
    }

    function toggleSubcountyOther() {
        if ($('#subcounty').val() === 'other') {
            $('#subcounty_other_div').show();
        } else {
            $('#subcounty_other_div').hide();
        }
    }

    // Update the change event for Home County to reset dependent fields and load subcounties.
    $('#homecounty').change(function() {
        var homecountyID = $(this).val();
        if (homecountyID === 'other') {
            // Automatically set Subcounty & Constituency to 'other'
            $('#subcounty').val('other').trigger('change');
            $('#constituency').val('other').trigger('change');
        } else {
            // Reset Subcounty and Constituency selections
            $('#subcounty').val('').trigger('change');
            $('#constituency').val('').trigger('change');

            if (homecountyID) {
                $.ajax({
                    type: "GET",
                    url: "/getSubcounties/" + homecountyID,
                    success: function(res){               
                        if(res) {
                            $("#subcounty").empty();
                            $("#subcounty").append('<option value="" disabled selected>Select Subcounty</option>');
                            $.each(res, function(key, value) {
                                $("#subcounty").append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                            $("#subcounty").append('<option value="other">Other</option>');
                            $("#constituency").empty(); // Clear Constituency when Subcounty changes
                        } else {
                            $("#subcounty").empty();
                        }
                    }
                });
            } else {
                $("#subcounty").empty();
                $("#subcounty").append('<option value="" disabled selected>Select Subcounty</option>');
                $("#subcounty").append('<option value="other">Other</option>');
                $("#constituency").empty();
            }
        }
        toggleHomeCountyOther();
    });

    // Change event for Subcounty: load Constituencies and toggle "Other"
    $('#subcounty').change(function(){ 
        toggleSubcountyOther();
        var subcountyID = $(this).val();
        if (subcountyID && subcountyID !== 'other') {
            $.ajax({
                type: "GET",
                url: "/getConstituencies/" + subcountyID,
                success: function(res){               
                    if(res) {
                        $("#constituency").empty();
                        $("#constituency").append('<option value="" disabled selected>Select Constituency</option>');
                        $.each(res, function(key, value) {
                            $("#constituency").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#constituency").append('<option value="other">Other</option>');
                    } else {
                        $("#constituency").empty();
                    }
                }
            });
        } else {
            $("#constituency").empty();
            $("#constituency").append('<option value="" disabled selected>Select Constituency</option>');
            $("#constituency").append('<option value="other">Other</option>');
        }
    });

    // Initial load: call toggle functions
    toggleHomeCountyOther();
    toggleConstituencyOther();
    toggleSubcountyOther();
});
