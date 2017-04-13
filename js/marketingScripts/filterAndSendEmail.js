  $(document).ready(function () {
        $('#interestsSelect').multiselect({
        buttonWidth: '300px',
            dropRight: true,
            includeSelectAllOption: true,
            selectAllValue: 'select-all-value'
        });
      $("#interestsSelect").focus();
    });

    $("#sendEmailButton").click(function () {
        sendContactEmailsToPhp();
        return false;
    });


    //Returns all lists associated with subuser account and populates dropdown, associates with campaign being designed
    var listForCampaign = '';
    $.ajax({
        url: "https://api.sendgrid.com/v3/contactdb/lists",
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + btoa("TRO2012:TheGrove$1017"));
        },
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
            var $select = $('#listSelect');
            $.each(data.lists.reverse(), function (key, val) {
                $select.append('<option value="' + val.id + '" id="' + val.id + '">' + val.name + '</option>');
                $("#listSelect").val("listSelect").change();
                listForCampaign = $("#listSelect").val();
            })
    $.ajax({
        //populates data table with list chosen by user
        url: "https://api.sendgrid.com/v3/contactdb/lists/" + $select.val() + "/recipients?page_size=100&page=1",
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + btoa("TRO2012:TheGrove$1017"));
        },
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
		$('#genderGroup').hide();

        console.log(JSON.stringify(data.recipients[0].custom_fields) + 'test');
$('#interestsSelect').multiselect('deselectAll', true); 

            //only create dropdown values for integers
        $.each(data.recipients[0].custom_fields, function (key, val) {
            if(val.value == 0 || val.value == 1)
            {
                $('#interestsSelect').append('<option value="' + val.name + '" id="' + val.id + '">' + 			convert_case(val.name.toString().replace(/_/g, ' ')) + '</option>');
            }
            else
            {
                if(val.name.indexOf('date') >= 0)
                {
                    $('#custom_fields').append( '<div class="form-group"><label for="'+ val.name + '" class="col-lg-2 control-label">'+ convert_case(val.name.toString().replace(/_/g, ' ')) +'</label><div class="col-lg-10"><input class="form-control" id="' + val.name + '"  type="' + 'date' +'"></div></div>')
                }
				else if(val.name.indexOf('gender') >= 0)
                {
                    $('#genderGroup').show();
                }
                else if(val.name.indexOf('State') >= 0)
                {
                    //do nothing
                }
                else
                {
                    $('#custom_fields').append( '<div class="form-group"><label for="'+ val.name + '" class="col-lg-2 control-label">'+ convert_case(val.name.toString().replace(/_/g, ' ')) +'</label><div class="col-lg-10"><input class="form-control" id="' + val.name + '"  type="' +'input' +'"></div></div>')
                }
                
                
            }
        })
			$('#interestsSelect').multiselect('rebuild');

        },
        error: function () {
            alert("Cannot get custom fields.");

        }
    });
   
        },
        error: function () {
            alert("Cannot get lists..");
        }
    });

    /*Below code gets all contact email addresses/other data and sends to sendEmail.php for processing */
    function postToSendEmailFile(emailAddresses) {
        var templateContent = CKEDITOR.instances.editor1.getData();
        console.log(templateContent);
        //console.log('in postToSendEmailFile function');
        $.post("newCampaign/campaignWorkflow/sendEmail.php", { emailAddresses: emailAddresses, templateContent: templateContent });
    }

    function sendContactEmailsToPhp() {
        $.ajax({
            //hard coded for testing... 2128 is Test List
            url: "https://api.sendgrid.com/v3/contactdb/lists/" + $("#listSelect").val() + "/recipients?page_size=100&page=1",
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Basic " + btoa("TRO2012:TheGrove$1017"));
            },
            type: 'GET',
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
                var interestsSelected = $("#interestsSelect").val();
                //alert(interestsSelected);
                var emailAddresses = [];
                //console.log('interestsSelected: ' + interestsSelected);
                if (!$("#sendToAll").is(':checked') && (!interestsSelected)) {
                    toastr["error"]('\'Send to all recipients\' checkbox must be checked or interests must be selected to send emails.');
                    return;
                }
                if ($("#sendToAll").is(':checked') && (interestsSelected)) {
                    toastr["error"]('\'Send to all recipients\' checkbox cannot be checked if interests have been selected.');
                    return;
                }
                if (!$("#sendToAll").is(':checked')) {
                    for (i = 0; i < data.recipients.length; i++) {
                        var customFields = [];
                        customFields = data.recipients[i].custom_fields;
                        //console.log(customFields);

                        //look at custom fields for contact and match with user agent choices from UI
                        $.each(customFields, function (key, fieldValue) {
                            //console.log(value.name + ':' + value.value);

                            //iterate through UI choices here and check each filter
                            $.each(interestsSelected, function (index, interestValue) {
                                //need to filter on text values here and make sure inputs are created for them when dropdown values are created
                                if (fieldValue.name == interestValue && fieldValue.value == 1) {
                                    //console.log(fieldValue.name + ':' + interestValue);
                                    
                                    //add email to array for processing if not already in array
                                    if($.inArray(data.recipients[i].email, emailAddresses) == -1)
                                    {
                                        emailAddresses.push(data.recipients[i].email);
                                    }
                                    
                                }
                            });
                        });
                    }
                    //postToSendEmailFile(emailAddresses);
                    toastr["success"]('Emails sent to the following: ' + emailAddresses + '!');
                }
                else {
                    for (i = 0; i < data.recipients.length; i++) {
                        //add all emails to array for processing because 'send to all' is checked
                        if($.inArray(data.recipients[i].email, emailAddresses) == -1)
                        {
                            emailAddresses.push(data.recipients[i].email);
                        }
                        
                    }
                    toastr["success"]('Emails sent to all recipients on list! ' + emailAddresses);
                }
            },
            error: function () {
                alert("Cannot get contact emails.");
            }
        });
    }
    
    //build custom fields dropdown

function convert_case(str) {
  var lower = str.toLowerCase();
  return lower.replace(/(^| )(\w)/g, function(x) {
    return x.toUpperCase();
  });
}

    $('#sendToAll').change(function() {
        if($(this).is(":checked")) {
            //var returnVal = confirm("Are you sure you want to send to all recipients?");
            $(this).attr("checked");
            $('#interests').hide();
            $('#customFields').hide();
             $('#sendToAll').val($(this).is(':checked'));    
        }
        if(!$(this).is(":checked")) {
            //var returnVal = confirm("Are you sure you want to send to all recipients?");
            $(this).attr("checked");
            $('#interests').show();
            $('#customFields').show();
        }
           
    });
