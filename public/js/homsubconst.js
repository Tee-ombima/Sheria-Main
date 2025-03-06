 
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

    $('#homecounty').change(function(){
        toggleHomeCountyOther();
        var homecountyID = $(this).val();
        if (homecountyID && homecountyID !== 'other') {
            $.ajax({
                type:"GET",
                url:"/getConstituencies/"+homecountyID,
                success:function(res){               
                    if(res){
                        $("#constituency").empty();
                        $("#constituency").append('<option value="" disabled selected>Select Constituency</option>');
                        $.each(res,function(key,value){
                            $("#constituency").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#constituency").append('<option value="other">Other</option>');
                        $("#subcounty").empty();
                        $("#subcounty").append('<option value="" disabled selected>Select Subcounty</option>');
                    } else {
                        $("#constituency").empty();
                    }
                }
            });
        } else {
            $("#constituency").empty();
            $("#constituency").append('<option value="" disabled selected>Select Constituency</option>');
            $("#constituency").append('<option value="other">Other</option>');
            $("#subcounty").empty();
            $("#subcounty").append('<option value="" disabled selected>Select Subcounty</option>');
            $("#subcounty").append('<option value="other">Other</option>');
        }      
    });

    $('#constituency').change(function(){
        toggleConstituencyOther();
        var constituencyID = $(this).val();
        if (constituencyID && constituencyID !== 'other') {
            $.ajax({
                type:"GET",
                url:"/getSubcounties/"+constituencyID,
                success:function(res){               
                    if(res){
                        $("#subcounty").empty();
                        $("#subcounty").append('<option value="" disabled selected>Select Subcounty</option>');
                        $.each(res,function(key,value){
                            $("#subcounty").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#subcounty").append('<option value="other">Other</option>');
                    } else {
                        $("#subcounty").empty();
                    }
                }
            });
        } else {
            $("#subcounty").empty();
            $("#subcounty").append('<option value="" disabled selected>Select Subcounty</option>');
            $("#subcounty").append('<option value="other">Other</option>');
        }
    });

    $('#subcounty').change(function(){
        toggleSubcountyOther();
    });

    // Initial load
    toggleHomeCountyOther();
    toggleConstituencyOther();
    toggleSubcountyOther();

});
