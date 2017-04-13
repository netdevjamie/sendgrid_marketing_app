//gets html content from sendgrid when template is chosen
//then displays content in preview and adds raw html to editor
var selectedTemplateId = '';
var htmlContent = '';

//Adds content to WYSIWYG Editor when template is selected
$("#templateSelect").change(function () {
    selectedTemplateId = $(this).val();
    $.ajax({
        url: "https://api.sendgrid.com/v3/templates/" + selectedTemplateId,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + btoa("TRO2012:TheGrove$1017"));
        },
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
            htmlContent = data.versions[0].html_content;
            CKEDITOR.instances.editor1.setData(htmlContent);
        },
        error: function () {
            alert("Cannot get specific template");
        }
    });
});


//populate dropdown when page loads...has to be at end of script
$.ajax({

    url: "https://api.sendgrid.com/v3/templates",
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Basic " + btoa("TRO2012:TheGrove$1017"));
    },
    type: 'GET',
    dataType: 'json',
    contentType: 'application/json',
    success: function (data) {
        var $select = $('#templateSelect');
        $.each(data.templates.reverse(), function (key, val) {
            $select.append('<option value="' + val.id + '" id="' + val.id + '">' + val.name + '</option>');
            $("#templateSelect").val("TestTemplate").change();
        })
    },
    error: function () {
        alert("Cannot populate dropdown.");
    }
});