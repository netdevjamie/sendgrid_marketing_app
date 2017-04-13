<script src="js/marketingScripts/campaignTemplateEditor.js"></script>
<br />
<div class="container">
    <div class="row">
        <div class="col-xs-4">
            <h4>Choose a Template</h4>
            <select id="templateSelect" class="form-control">
                <option value="" disabled selected>Select a Template</option>
            </select>

        </div>
        <!--<div id="preview" class="col-xs-8 pull-right"></div>-->
    </div>
</div>
<!-- campaign email editor start -->
<div class="row">
    <div class="col-lg-12">
        <label>
        </label>
        <br />
        <br />
        <form>
            <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration and expanding size of editor.
                CKEDITOR.replace('editor1', { height: 1500 });
            </script>
        </form>
    </div>
</div>
<!-- campaign email editor end -->


