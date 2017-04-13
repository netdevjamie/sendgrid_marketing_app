<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-users"></i> Support</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                    <li><i class="fa fa-users"></i>Contacts</li>
                </ol>
            </div>
        </div>

        <!-- support  start-->
<div class="row contain" >
          <div class="col-xs-12">
            <div class="well bs-component">
              <form class="form-horizontal contact" data-validate action="mailer.php" method="post">
                <fieldset>
                  <legend>Send us a message and someone will contact you shortly!</legend>
                    
                  <div class="form-group">
                    <label for="inputName" class="col-xs-2 control-label">Name</label>
                    <div class="col-lg-8">
                      <input type="text" data-validate="required" name="name" class="form-control" id="inputName" placeholder="Name">
                    </div>
                   </div>
                      
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-2 control-label">Email</label>
                    <div class="col-lg-8">
                      <input type="email" data-validate="required,email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputSubject" class="col-xs-2 control-label">Subject</label>
                    <div class="col-lg-8">
                      <input type="text"  data-validate="required" name="subject" class="form-control" id="inputSubject" placeholder="Subject">
                    </div>
                  </div>
                      
                  <div class="form-group">
                    <label for="textArea" class="col-xs-2 control-label">Message</label>
                    <div class="col-lg-8">
                      <textarea class="form-control" data-validate="required" rows="3" id="textArea" placeholder="Please provide a description of the problem you are having." name="message"></textarea>
                    </div>
                  </div>
                      
                  <div class="form-group">
                    <div class="col-xs-8 col-xs-offset-2">
                      <button type="reset" class="btn btn-default">Reset</button>
                      <button type="submit" class="btn btn-primary submit">Submit</button>
                    </div>
                  </div>
                </fieldset>
              </form>
          </div>
</div>
        <!-- support  end-->
    </section>
</section>
<!--main content end-->
<script src="js/verify.notify.min.js"></script>























