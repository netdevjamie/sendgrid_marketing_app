<script src="js/marketingScripts/contacts.js"></script>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-users"></i> Contacts</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                    <li><i class="fa fa-users"></i>Contacts</li>
                </ol>
            </div>
        </div>
        <!-- campaign contacts start-->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">List To Display</label>
                    <div class="col-lg-4">
                        <select class="form-control" id="contactListSelect"></select>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Complete List
                    </header>
                    <table id="contactListTable" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>

                            </tr>

                        </thead>
                        <tbody></tbody>

                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </tfoot>
                    </table>
                </section>
            </div>
        </div>
        <div id="divLoading">
            <!-- campaign contacts end-->
    </section>
</section>
<!--main content end-->
<style>
    #divLoading {
        display: none;
    }

        #divLoading.show {
            display: block;
            position: fixed;
            z-index: 100;
            background-image: url('http://loadinggif.com/images/image-selection/3.gif');
            background-color: #666;
            opacity: 0.4;
            background-repeat: no-repeat;
            background-position: center;
            left: 0;
            bottom: 0;
            right: 0;
            top: 0;
        }

    #loadinggif.show {
        left: 50%;
        top: 50%;
        position: absolute;
        z-index: 101;
        width: 32px;
        height: 32px;
        margin-left: -16px;
        margin-top: -16px;
    }

    div.content {
        width: 1000px;
        height: 1000px;
    }
</style>