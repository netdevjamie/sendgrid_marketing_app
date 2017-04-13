 <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                            <li><i class="fa fa-laptop"></i>Dashboard</li>
                        </ol>
                    </div>
                </div>
                <h4 class="clicks"></h4>
                <div class="col-lg-4">
            <div class="bs-component">
              <div class="well">
                Look, I'm in a well!
              </div>
            </div>
          </div>
            </section>
        </section>
        <!--main content end-->

<script>
   
    $.ajax({
        //populates data table with list chosen by user
        url: "https://api.sendgrid.com/v3/stats?start_date=2015-01-01&end_date=2015-01-02",
        beforeSend: function(xhr) { 
            xhr.setRequestHeader("Authorization", "Basic " + btoa("TRO2012:TheGrove$1017")); 
        },
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
           //alert(JSON.stringify(data[0].stats[0].metrics.clicks));
            $('#well').append(JSON.stringify(data[0].stats[0].metrics.clicks).toString());
            
        },
        error: function(){
            alert("Cannot get stats.");
        }
    });
   
</script>