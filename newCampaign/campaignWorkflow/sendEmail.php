<?
/* This code accepts email array from JS Ajax post (campaignTemplateEditor.php) and sends emails to all recipients.*/

$templateContent = '';

if (isset($_POST["emailAddresses"])) {

      $emailList = $_POST["emailAddresses"];
      
    echo $_POST['templateContent'];
      $templateContent = $_POST['templateContent'];

    foreach ($emailList as $value) {
        sendEmail($value,$templateContent);
    }
}


function sendEmail($address, $templateContent)
{
    if(empty($templateContent))
    {
        echo 'templateContent empty';
    }
    if(empty($address))
    {
        echo 'email addresses empty';
    }
    
    $url = 'https://api.sendgrid.com/';
    $user = 'TRO2012';
    $pass = 'TheGrove$1017';
    $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'to'        => $address,
        'subject'   => 'html test',
        'html'      => $templateContent,
        'text'      => $templateContent,
        'from'      => 'chrisb@travmarket.com',
    );
    $request =  $url.'api/mail.send.json';

    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    // Tell PHP not to use SSLv3 (instead opting for TLS)
    curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // obtain response
    $response = curl_exec($session);
    curl_close($session);

    // print everything out
    print_r($response);
}
    
?>