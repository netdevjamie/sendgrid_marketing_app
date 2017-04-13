<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-users"></i> Campaigns</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                    <li><i class="fa fa-envelope"></i>Campaigns</li>
                    <li><i class="fa fa-envelope-o"></i>New Campaign</li>
                </ol>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="btn btn-primary btn-xs custom">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="btn btn-primary btn-xs custom">Next</span>
        </a>

        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner" role="listbox">
                <!--Template Editor -->
                <div class="item active">
                    <?
                    include 'newCampaign/campaignWorkflow/campaignTemplateEditor.php';
                    ?>
                </div>

                <!--Filter and Send Email-->
                <div class="item">
                    <?
                    include 'newCampaign/campaignWorkflow/filterAndSendEmail.php';
                    ?>
                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->