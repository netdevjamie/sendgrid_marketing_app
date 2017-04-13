  $.ajax({
        //populates data table with list chosen by user
        url: "https://api.sendgrid.com/v3/stats?start_date=2015-01-01&end_date=2015-01-02",
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + btoa("TRO2012:TheGrove$1017"));
        },
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
            console.log(JSON.stringify(data[0].stats[0].metrics));
            $('#clicks').append(JSON.stringify(data[0].stats[0].metrics.clicks));
            $('#opens').append(JSON.stringify(data[0].stats[0].metrics.opens));
            $('#uniqueOpens').append(JSON.stringify(data[0].stats[0].metrics.unique_opens));
        },
        error: function () {
            alert("Cannot get stats.");
        }
    });