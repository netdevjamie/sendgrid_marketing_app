<?
/**********************************************************************
* sengridFunctions.php
* 2015-10-01 03:40PM ET
* Christopher P. Burton
***********************************************************************
* SendGrid Sub-User Creation Library
* Collection of functions to facilitate the management of sub-user 
* accounts using the SendGrid APIs
*
* https://sendgrid.com/docs/index.html
* https://support.sendgrid.com/hc/en-us/sections/200050058-APIs
* https://support.sendgrid.com/hc/en-us/articles/201750787-How-to-Create-a-Subuser-with-the-API
*
**********************************************************************/

/**********************************************************************
* These will probably be placed in the init.php file or as part of the
* definitions.php file in the future
**********************************************************************/
define('SENDGRID_USERNAME', 'TRO2012');
define('SENDGRID_PASSWORD', 'TheGrove$1017');
define('VOYAGER_DB_NAME', 'voyagerwebsitesContent');
define('VOYAGER_DB_HOST', 'localhost');
define('VOYAGER_DB_USER', 'voyagerDBadmin');
define('VOYAGER_DB_PASS', '%^7JsB+p-U8V:_S');

/**********************************************************************
* Assuming that we do not already have a PDO instance...
**********************************************************************/
try{
	$pdo = new PDO('mysql:host='.VOYAGER_DB_HOST.';dbname='.VOYAGER_DB_NAME.';port=3306',''.VOYAGER_DB_USER.'',''.VOYAGER_DB_PASS.'');
}catch(PDOException $e){
	echo 'Connection failed'.$e->getMessage();
}

/**********************************************************************
* General cURL request.
* Pass the $postData and $url variables to the function
*
* Returns the cURL response
*
* Example:
* $results = callCURL($postData, $url);
**********************************************************************/
function callCURL($postData, $url){
	$postData['api_user'] = SENDGRID_USERNAME;
	$postData['api_key'] = SENDGRID_PASSWORD;
	$cInit = curl_init($url);
	curl_setopt($cInit, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($cInit, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($cInit, CURLOPT_HEADER, false);
	curl_setopt($cInit, CURLOPT_ENCODING, 'gzip,deflate');
	curl_setopt($cInit, CURLOPT_RETURNTRANSFER, true);
	$jsonResponse = curl_exec($cInit);
	curl_close($cInit);
	$results  = json_decode($jsonResponse, TRUE);
	return $results;
}

/**********************************************************************
* Database query to retrieve the subscriber information
* Returns an array of data
*
* Example: $userInfo = fetchSubscriber($pdo, 1);
**********************************************************************/
function fetchSubscriber(PDO $pdo, $agentID){
	$sql = $pdo->prepare("SELECT * FROM subscribers WHERE ID = :agentID");
	$sql->execute(array(':agentID', $agentID));
	$userInfo = $sql->fetch(PDO::FETCH_ASSOC);
	return $user;
}

/**********************************************************************
* Check to see if a sub-user exists under the account
* Use the subscriber's email address as the search term
*
* Returns an array if successful, false if unsuccessful
* Array will be empty if the sub-user does not exist
* Array will contain the sub-user information if they exist
*
* Examples:
* $subUser = checkSubUser('name@domain.com');
* OR
* $emailAddress = 'name@domain.com';
* $subUser = checkSubUser($emailAddress);
**********************************************************************/
function checkSubUser($emailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.profile.json';
	$postData['task'] = 'get';
	$postData['email'] = $emailAddress;
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* SendGrid API call to create a sub-user
* The passed $userInfo needs to be an array or it will return false
* On success, the response should be an array containing 'success'
* New subusers are set to active by default
*
* Pass an array of the data fields from MySQL
*
* Example:
* $newUser = createSubUser($userInfo);
* On success, $newUser['message'] = 'success'
**********************************************************************/
function createSubUser($userInfo){
	if(is_array($userInfo) && !empty($userInfo)){
		$url = 'https://api.sendgrid.com/apiv2/customer.add.json';
		$postData['username'] = sub_str($userInfo['emailAddress'], 0, 64);
		$postData['website'] = sub_str($userInfo['agentWebsite'], 0, 255);
		$postData['password'] = $userInfo['agentPasswordConfirm'];
		$postData['confirm_password'] = $userInfo['agentPasswordConfirm'];
		$postData['first_name'] = sub_str($userInfo['nameFirst'], 0, 50);
		$postData['last_name'] = sub_str($userInfo['nameLast'], 0, 50);
		$postData['address'] = sub_str(trim($userInfo['address_1']." ".$userInfo['address_2']), 0, 100);
		$postData['city'] = sub_str($userInfo['city'], 0, 100);
		$postData['state'] = $userInfo['stateProvince'];
		$postData['zip'] = sub_str($userInfo['zipPostalCode'], 0, 50);
		$postData['email'] = sub_str($userInfo['emailAddress'], 0, 64);
		$postData['country'] = $userInfo['country'];
		$postData['phone'] = sub_str($userInfo['agentPhone'], 0, 50);
		$postData['company'] = sub_str($userInfo['agencyName'], 0, 255);
		$results = callCURL($postData, $url);
		return $results;
	}else{
		return false;
	}
}

/**********************************************************************
* Gets the Whitelabel IP addresses available for the sub-user
* Returns an array of available IP Addresses
*
* Example: $listIP = getIPList();
**********************************************************************/
function getIPList(){
	$url = 'https://api.sendgrid.com/apiv2/customer.ip.json';
	$postData['list'] = 'all';
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Sets the Whitelabel IP addresses for the sub-user
* Use the getIPList() function to get IP Addresses
* Returns success or failure
*
* Example: $setIP = setSubUserIP('127.0.0.1','name@domain.com');
**********************************************************************/
function setSubUserIP($ip,$userEmailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.sendip.json';
	$postData['task'] = 'specify';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['ip'][] = $ip;
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Gets the Whitelabel domains available for the sub-user
* Returns an array of available domains & urls
*
* Example: $listDomains = getWhitelabel();
**********************************************************************/
function getWhitelabel(){
	$url = 'https://api.sendgrid.com/apiv2/customer.whitelabel.json';
	$postData['task'] = 'list'
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Sets the Whitelabel domain for the sub-user
* Use the getWhitelabel() function to get domains
* Returns success or failure
*
* Example: $setDomain = setWhitelabel('email.domain.com','name@domain.com');
**********************************************************************/
function setWhitelabel($mailDomain,$userEmailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.whitelabel.json';
	$postData['task'] = 'append';
	$postData['mail_domain'] = $mailDomain;
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$results = callCURL($postData, $url);
	return $results;
}
/**********************************************************************
* Final step in the creation of a sub-user.
* Simply activates the sub-user
*
* Returns success or failure
*
**********************************************************************/
function activateSubUser($userEmailAddress,$userPWD){
	$url = 'https://api.sendgrid.com/apiv2/customer.auth.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['password'] = $userPWD;
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Removes a sub-user from the SendGrid system
* Use the fetchSubscriber($pdo, $agentID) function to get array of 
* the subscriber information.
*
* Returns success or failure
*
* Example:
* $user = fetchSubscriber($pdo, 1);
* $removeUser = removeSubUser($user);
**********************************************************************/
function removeSubUser($userEmailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.delete.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Update a sub-user's username
* Takes two arguments:
* 1. The existing username ($userInfo['emailAddress'])
* 2. The new username ($newUserName, most likely a $_POST variable)
*
* Returns success or failure
*
* This will need to be used when a subscriber updates their information
* in our system. Make this call before updating their local records or
* use the checkSubUser($emailAddress) function to get the information 
* that SendGrid already has to use as the $useInfo if the email address
* has not changed in the subscriber profile.
**********************************************************************/
function updateSubUserName($userEmailAddress, $newUserName){
	$url = 'https://api.sendgrid.com/apiv2/customer.profile.json';
	$postData['task'] = 'setUsername';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['username'] = sub_str($newUserName, 0, 64);
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Update a sub-user's password
* Takes two arguments:
* 1. The existing username ($userInfo['emailAddress'])
* 2. The new password ($newUserPassword, most likely a $_POST variable)
*
* Returns success or failure
*
* This will need to be used when a subscriber updates their information
* in our system. Make this call before updating their local records
**********************************************************************/
function updateSubUserPassword($userEmailAddress, $newUserPassword){
	$url = 'https://api.sendgrid.com/apiv2/customer.password.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['password'] = $newUserPassword;
	$postData['confirm_password'] = $newUserPassword;
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Updates the administrative email address SendGrid uses to contact the
* sub-user.
*
* Returns success or failure
*
* This will need to be used when a subscriber updates their information
* in our system. Make this call before updating their local records or
* use the checkSubUser($emailAddress) function to get the information 
* that SendGrid already has to use as the $useInfo if the email address
* has not changed in the subscriber profile.
**********************************************************************/
function updateSubUserEmailAddress($userEmailAddress, $newUserEmail){
	$url = 'https://api.sendgrid.com/apiv2/customer.profile.json';
	$postData['task'] = 'setEmail';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['email'] = $newUserEmail;
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Updates the sub-users profile.
*
* Returns success or failure
*
* This will need to be used when a subscriber updates their information
* in our system. Make this call before updating their local records or
* use the checkSubUser($emailAddress) function to get the information 
* that SendGrid already has to use as the $useInfo if the email address
* has not changed in the subscriber profile.
**********************************************************************/
function updateSubUserProfile($userEmailAddress, $newUserInfo){
	$url = 'https://api.sendgrid.com/apiv2/customer.profile.json';
	$postData['task'] = 'set';
	$postData['username'] = sub_str($userEmailAddress, 0, 64);
	$postData['website'] = sub_str($newUserInfo['agentWebsite'], 0, 255);
	$postData['first_name'] = sub_str($newUserInfo['nameFirst'], 0, 50);
	$postData['last_name'] = sub_str($newUserInfo['nameLast'], 0, 50);
	$postData['address'] = sub_str(trim($newUserInfo['address_1']." ".$userInfo['address_2']), 0, 100);
	$postData['city'] = sub_str($newUserInfo['city'], 0, 100);
	$postData['state'] = $newUserInfo['stateProvince'];
	$postData['zip'] = sub_str($newUserInfo['zipPostalCode'], 0, 50);
	$postData['country'] = $newUserInfo['country'];
	$postData['phone'] = sub_str($newUserInfo['agentPhone'], 0, 50);
	$postData['company'] = sub_str($newUserInfo['agencyName'], 0, 255);
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Disables the sub-users ability to send emails from SendGrid.
* Does not affect their ability to login to the Web UI
*
* Returns success or failure
*
**********************************************************************/
function disableSubUser($userEmailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.disable.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Enables the sub-users ability to send emails from SendGrid.
* New subusers are set to active by default.
*
* Returns success or failure
*
**********************************************************************/
function disableSubUser($userEmailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.enable.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$results = callCURL($postData, $url);
	return $results;
}
/**********************************************************************
* Disallow a subuser to login to the SendGrid website. 
* Does not affect email sending permissions.
*
* Returns success or failure
*
**********************************************************************/
function disableSubUserWeb($userEmailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.website_disable.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Allow a subuser to login to the SendGrid website. 
* Does not affect email sending permissions.
* New subusers are set to active by default.
*
* Returns success or failure
*
**********************************************************************/
function enableSubUserWeb($userEmailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.website_enable.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Authenticate a subuser before displaying their account information.
*
* Returns success or failure
*
**********************************************************************/
function authenticateSubUser($userEmailAddress,$userPWD){
	$url = 'https://api.sendgrid.com/apiv2/customer.auth.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['password'] = $userPWD;
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Retrieve account limits for a specific subuser.
* If the API call response is empty that means the subuser has the 
* limits removed.
*
* Returns array of credit, credit_remain, last_reset
*
**********************************************************************/
function getSubUserLimits($userEmailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.limit.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['task'] = 'retrieve';
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Remove the limit for a sub-user.
*
* Returns success or failure
*
**********************************************************************/
function removeSubUserLimits($userEmailAddress){
	$url = 'https://api.sendgrid.com/apiv2/customer.limit.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['task'] = 'none';
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* A recurring reset will allow you to periodically reset a sub-users
* credits to a number you specify ($credits)
*
* Each month, a sub-user gets 6000 credits
*
* Returns success or failure
*
* Note: This may be a useful function to call as a cronjob monthly
*
**********************************************************************/
function resetRecurringSubUserLimits($userEmailAddress, $credits = '6000'){
	$url = 'https://api.sendgrid.com/apiv2/customer.limit.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['task'] = 'recurring';
	$postData['credits'] = intval($credits);
	$postData['period'] = 'monthly';
	$postData['startdate'] = date("Y-m")."-01";
	$postData['enddate'] = date("Y-m-t");
	$postData['initial_credits'] = intval($credits);
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Set a sub-users credits to a specified amount.
*
* Returns success or failure
*
**********************************************************************/
function setSubUserLimits($userEmailAddress, $credits = '6000'){
	$url = 'https://api.sendgrid.com/apiv2/customer.limit.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['task'] = 'total';
	$postData['credits'] = intval($credits);
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Increment a sub-users credits to a specified amount.
*
* Returns success or failure
*
**********************************************************************/
function incrementSubUserLimits($userEmailAddress, $credits){
	$url = 'https://api.sendgrid.com/apiv2/customer.limit.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['task'] = 'increment';
	$postData['credits'] = intval($credits);
	$results = callCURL($postData, $url);
	return $results;
}

/**********************************************************************
* Decrement a sub-users credits to a specified amount.
*
* Returns success or failure
*
**********************************************************************/
function decrementSubUserLimits($userEmailAddress, $credits){
	$url = 'https://api.sendgrid.com/apiv2/customer.limit.json';
	$postData['user'] = sub_str($userEmailAddress, 0, 64);
	$postData['task'] = 'increment';
	$postData['credits'] = intval($credits);
	$results = callCURL($postData, $url);
	return $results;
}
/**********************************************************************
END OF FILE
**********************************************************************/