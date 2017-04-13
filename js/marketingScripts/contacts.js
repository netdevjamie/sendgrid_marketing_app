//using Test List '2128' until all contacts can be figured out....
var contactListSelected = '4804';
$.ajax({
    //hard coded for testing... 2128 is Test List
    url: "https://api.sendgrid.com/v3/contactdb/lists",
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Basic " + btoa("TRO2012:TheGrove$1017"));
        $("div#divLoading").addClass('show');
    },
    type: 'GET',
    dataType: 'json',
    contentType: 'application/json',
    success: function (data) {
        $("div#divLoading").removeClass('show');
        var $select = $('#contactListSelect');
        $.each(data.lists.reverse(), function (key, val) {
            $select.append('<option value="' + val.id + '" id="' + val.id + '">' + val.name + '</option>');
            $("#contactListSelect").val("contactListSelect").change();
            $('#contactListTable').show();
        })

    },
    error: function () {
        alert("Cannot get lists..");
        $("div#divLoading").removeClass('show');

    }
});



$("#contactListSelect").change(function () {
    contactListSelected = $("#contactListSelect").val();

    $.ajax({
        //populates data table with list chosen by user
        url: "https://api.sendgrid.com/v3/contactdb/lists/" + contactListSelected + "/recipients?page_size=100&page=1",
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + btoa("TRO2012:TheGrove$1017"));
            $("div#divLoading").addClass('show');
        },
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
            $('#contactListTable').DataTable().destroy();
            //datatable built on success callback
            $('#contactListTable').DataTable({
                
                data: data.recipients,
                columns: [
                    { data: 'first_name' },
                    { data: 'email' }
                ]
            });
            $("div#divLoading").removeClass('show');

                console.log(JSON.stringify(data.recipients[0].custom_fields));
			
        },
        error: function () {
            alert("Cannot get contacts.");
            $("div#divLoading").removeClass('show');

        }
    });
});

$(document).ready(function () {
    $("div.content").click(function () {

    });
});