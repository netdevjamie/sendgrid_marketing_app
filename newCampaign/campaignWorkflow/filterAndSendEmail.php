<!-- script/style declarations at bottom of page to solve js dependency issue with multiselect plugin -->
<br />
<div class="row">
    <div class="col-lg-12">
        <div class="well bs-component">
            <form class="form-horizontal" autocomplete="off">
                
                <fieldset>
                    <legend>Filter Recipients And Send Email</legend>
					<div class="col-lg-6">
                        
                    <div class="form-group">
                        <p style="padding-right:5px;">Choose a list, select interests and enter values for custom fields here. If any of these match a value for one of the recipients on your chosen list, an email will be sent to that recipient.</p>
                        <div class="form-group">
                        <div class="checkbox sendToAll" style="padding-left:7%;">
                            <label>
                                <input id="sendToAll" type="checkbox"> Send to all recipients on list.
                            </label>
                        </div>
                    </div>
                        <h1>Lists</h1>
                        <label for="select" class="col-lg-2 control-label">Choose List</label>
                        <div class="col-lg-4">
                            <select class="form-control" id="listSelect" style="width:300px;"></select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group" id="interests">
                        <h1>Interests</h1>
                        <label for="select" class="col-lg-2 control-label">Select Recipient Interests</label>
                        <div class="col-lg-10">
                            <select class="form-control multiselect interestsSelect" id="interestsSelect" multiple="multiple">
                                
                            </select>
                            <br>
                        </div>
                    </div>
                    
                    </div>
                    <div class="col-lg-4" id="customFields">
                        <br />
                        <br />
                        <br />
                        <h1>Custom Fields</h1>
                        <div class="form-group" id="custom_fields" >
                            <div class="form-group" id="genderGroup">
                                <label id="genderlabel" for="Gender" class="col-lg-2 control-label genderlabel">Gender</label>								   <div class="col-lg-10">
                                	<select class="form-control interestsSelect" id="genderSelect">
                                        <option>M</option>
                                        <option>F</option>
                                        <option>Other</option>
                                 	</select>        
                           	     </div>
                            </div>
                            <div class="form-group" id="stateGroup">
                                <label id="stateLabel" for="State" class="col-lg-2 control-label stateLabel">State</label>								   <div class="col-lg-10">
                                	<select class="form-control stateSelect" id="stateSelect">
                                        	<option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                 	</select>        
                           	     </div>
                            </div>
                        <!--dynamically generated custom fields inputs-->
                    </div>
                    </div>
                             <button id="sendEmailButton" class="btn btn-primary pull-right">Send Email</button>

                </fieldset>
            </form>
        </div>
    </div>

                           
</div>


<link rel="stylesheet" href="js/bootstrap-multiselect/bootstrap-multiselect.css" type="text/css" />

<script type="text/javascript" src="js/bootstrap-multiselect/bootstrap-multiselect.js"></script>

<style>
    .multiselect-container{
        position:relative;
    }
</style>
<script src="js/marketingScripts/filterAndSendEmail.js"></script>
