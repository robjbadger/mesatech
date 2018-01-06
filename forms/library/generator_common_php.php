<?php

/**
 * Description of GeneratorCommonPhp Class
 * Generates php for the form
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */

class GeneratorCommonPhp {
    
    function __construct( ) {

    }

    public function phpStart() {

        $php = '<?php ' . PHP_EOL;

//Check if the form is submitted or not.
$php .= 
    'if(empty($_POST["form_name"])){
        die("Invalid");
    }
    ini_set("display_errors", "0");
    ' . PHP_EOL . PHP_EOL;

        return $php;
    }

    //TODO:Add validation as per form data.
    public function renderFormPhp() {

    }

    public function reCaptcha( $form_data ) {

        //Return blank string if recaptcha is not enabled.
        if(!isset( $form_data['enable_recaptcha'] ) 
                || ( $form_data['enable_recaptcha'] == 0 )){

            return '';
        }

        //your site secret key
        $secret = $form_data["secret_key"];
        $email_failed_msg = $form_data["email_failed_msg"];

$php = 
    '//Verification for google reCaptcha
    if(isset($_POST["g-recaptcha-response"]) && !empty($_POST["g-recaptcha-response"])){

        //get verify response data
        $verifyResponse = file_get_contents(\'https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response=\'.$_POST["g-recaptcha-response"]);
        $responseData = json_decode($verifyResponse);
        
        if(!$responseData->success) {
            $output = array("success" => 0, "error" => "reCaptcha error", 
                                "msg" => "reCaptcha error"
                            );
            echo json_encode($output);
            exit;
        }
        
    } else {
        $output = array("success" => 0, "error" => "reCaptcha error", 
                            "msg" => "reCaptcha error"
                        );
        echo json_encode($output);
        exit;
    }' . PHP_EOL . PHP_EOL;

        return $php;
    }

    public function email( $form_data ) {

        $php = '';

        //Send email
        $toArray = explode(',', $form_data['msg_to']);
    
        $from = "Form";
        if(!empty($form_data['msg_from'])){
            $from = $form_data['msg_from'];
        }

        //Subject
        $subject = "Subject";
        if(!empty($form_data["msg_sub"])){
            $subject = $form_data["msg_sub"];
        }
$php .=
    'require_once "PHPMailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;
    $mail->isHTML(true);' . PHP_EOL . PHP_EOL ;
    if(!empty($form_data['enable_smtp']) && $form_data['enable_smtp'] == 1){
        $php .=
            '$mail->isSMTP();
            $mail->SMTPAuth = true;'. PHP_EOL;
        if(!empty($form_data['smtp_host'])){
            $php .=
                '$mail->Host = "' . $form_data['smtp_host'] .'";' . PHP_EOL;
        }
        if(!empty($form_data['smtp_username'])){
            $php .=
                '$mail->Username = "' . $form_data['smtp_username'] .'";' . PHP_EOL;
        }
        if(!empty($form_data['smtp_password'])){
            $php .=
                '$mail->Password = "' . $form_data['smtp_password'] .'";' . PHP_EOL;
        }
        if(!empty($form_data['smtp_port'])){
            $php .=
                '$mail->Port = ' . $form_data['smtp_port'] .';' . PHP_EOL;
        }
        
        if(!empty($form_data['smtp_secure'])){
            $php .=
                '$mail->SMTPSecure = "' . $form_data['smtp_secure'] . '";' . PHP_EOL;
        } else {
            $php .=
                '$mail->SMTPSecure = ' . '"";' . PHP_EOL;
        }            
    }
$php .= 
    '$subject = "' . $subject .'";
    if(!empty($subject)){
        foreach($_POST["fields"] as $key => $value){
            if(is_array($value)){
                $value = implode(" ,", $value);
            }
            $subject = str_replace( "__" . $key . "__", $value, $subject);
        }
    }' . PHP_EOL . PHP_EOL;

        //Body
        $body = $form_data['msg_body'];
        
$php .= 
    '$body = "' . $body .'";
    $data = array();
    foreach($_POST["fields"] as $key => $value){
        if(is_array($value)){
            $value = implode(" ,", $value);
        }
        $data[$key] = $value;
        $body = str_replace( "__" . $key . "__", htmlspecialchars( $value ), $body);
    }
    $body = str_replace( "__SENDER_IP__", $_SERVER["REMOTE_ADDR"], $body);
    $body = str_replace( "__DATE_TIME__", date("Y-m-d H:i:s"), $body);
    ' . PHP_EOL . PHP_EOL;

    if(!empty($form_data['msg_cc'])) {
        $ccArray = explode(',', $form_data['msg_cc']);
        foreach($ccArray as $cc){
            $php .=
                '$mail->addCC( "' . trim($cc) . '" );' . PHP_EOL;
        }
    }
        
    foreach( $toArray as $to){
        $php .=
            '$mail->addAddress( "' . trim($to) . '" );' . PHP_EOL; 
    }
    $php .=
    'if(!empty($_POST["attachments"])){
        $attachments = explode( ",", $_POST["attachments"]);
        foreach( $attachments as $attachment ){
            $attachment_path = dirname(__DIR__) . "/uploads/" .  $attachment ;
            if( file_exists( $attachment_path ) ){
                $mail->addAttachment($attachment_path, $attachment);
            }
        }
    }' . PHP_EOL . PHP_EOL;
    $php .=
    '$mail->setFrom( "' . $from . '" );
    $mail->Subject = $subject;
    $mail->Body = nl2br($body);
     
    $email_sent = $mail->send();' . PHP_EOL . PHP_EOL;
        return $php;
    }

    //TODO: Add code
    public function autoResponseEmail( $form_data ) {

        $php = '';

        if( isset( $form_data['enable_auto_response'] ) &&  
                ( $form_data['enable_auto_response'] == '1') ) {

            $response_to_key = $form_data['auto_response_to'];
            
            $response_from = "From";
            if(!empty($form_data['auto_response_from'])){
                $response_from = $form_data['auto_response_from'];
            }

            $response_subject = "Subject";
            if(!empty($form_data['auto_response_sub'])){
                $response_subject = $form_data['auto_response_sub'];
            }

            $response_body = $form_data['auto_response_body'];
            $php .= 
                'if( $email_sent ) {' . PHP_EOL . PHP_EOL ;
            $php .=
            'require_once "PHPMailer/PHPMailerAutoload.php";
            $response = new PHPMailer;
            $response->isHTML(true);' . PHP_EOL . PHP_EOL ;
            if(!empty($form_data['enable_smtp']) && $form_data['enable_smtp'] == 1){
                $php .=
                    '$response->isSMTP();
                    $response->SMTPAuth = true;'. PHP_EOL;
                if(!empty($form_data['smtp_host'])){
                    $php .=
                        '$response->Host = "' . $form_data['smtp_host'] .'";' . PHP_EOL;
                }
                if(!empty($form_data['smtp_username'])){
                    $php .=
                        '$response->Username = "' . $form_data['smtp_username'] .'";' . PHP_EOL;
                }
                if(!empty($form_data['smtp_password'])){
                    $php .=
                        '$response->Password = "' . $form_data['smtp_password'] .'";' . PHP_EOL;
                }
                if(!empty($form_data['smtp_port'])){
                    $php .=
                        '$response->Port = ' . $form_data['smtp_port'] .';' . PHP_EOL;
                }
                
                if(!empty($form_data['smtp_secure'])){
                    $php .=
                        '$response->SMTPSecure = "' . $form_data['smtp_secure'] . '";' . PHP_EOL;
                } else {
                    $php .=
                        '$response->SMTPSecure = ' . '"";' . PHP_EOL;
                }            
            }
            $php .=
                '$response_to = $_POST["fields"]["' . $response_to_key . '"];
                    
                    $response_subject = "' . $response_subject . '";
                    
                    foreach($_POST["fields"] as $key => $value){
                        if(is_array($value)){
                            $value = implode(" ,", $value);
                        }
                        $response_subject = str_replace( \'__\' . $key . \'__\', $value, "$response_subject");
                    }
                    
                    
                    $response_body = "' . $response_body . '";
                    foreach($_POST["fields"] as $key => $value){
                        if(is_array($value)){
                            $value = implode(" ,", $value);
                        }
                        $response_body = str_replace( \'__\' . $key . \'__\', 
                                htmlspecialchars( $value ), $response_body );
                    }
                    
                    $response->addAddress( $response_to );
                    $response->setFrom( "' . $response_from . '" );
                    $response->Subject = $response_subject;
                    $response->Body = nl2br($response_body);
                
                    $response_sent = $response->send();
                };' . PHP_EOL . PHP_EOL;

        }

        return $php;

    }

    public function phpEnd( $form_data ) {

$php = 
    'if( $email_sent ){' . PHP_EOL;

        //For display message
        if( empty($form_data['post_submit_action']) || $form_data['post_submit_action'] == 'show_msg' ){

$php .= 
        '$output = array("success" => 1, 
                    "redirect" => 0, 
                    "msg" => "' . $form_data['email_success_msg'] . '",
                    "data" => $data
                );' . PHP_EOL;

        }

        //For redirect
        if( $form_data['post_submit_action'] == 'redirect' ){

$php .= 
        '$output = array("success" => 1, 
                        "redirect" => 1, 
                        "url" => "' . $form_data['redirect_url'] . 
                    '");' . PHP_EOL;

        }

$php .= 
        'echo json_encode($output); exit;
    } else {' . PHP_EOL;

$php .=     
        '$output = array("success" => 0, 
                    "error" => "Email error",
                    "msg" => "' . $form_data['email_failed_msg'] . '",
                    "data" => $data,
                    "phpMailer_error" => $mail->ErrorInfo
                );
            echo json_encode($output); exit;' . PHP_EOL;
$php .= '}
?>';

        return $php;
    }

    public function databaseIntegration( $form_data ){
        
        if( isset( $form_data['enable_database'] ) &&  ($form_data['enable_database'] == '1')  ){
            // $php =
            // 'if( $email_sent ){' . PHP_EOL;
            $php = 'try{
                    require_once ("config.php");'. PHP_EOL;
            $php .= '$db_data = array();' . PHP_EOL;
            if( !empty($form_data['db_data']) ){
                foreach($form_data['db_data'] as $db_data){
                    $column = $db_data['column'];
                    $col_val = $db_data['value'];
                    $php .= '$db_data["' . $column . '"] = "' . $col_val . '";' . PHP_EOL;
                }
            }
            $php .=
                '$insert_data = array();
                foreach( $db_data as $col => $col_val){
                    foreach($_POST["fields"] as $key => $value){
                        if(is_array($value)){
                            $value = implode(" ,", $value);
                        }
                        $col_val = str_replace( "__" . $key . "__", htmlspecialchars( $value ) , $col_val);
                    }
                    $insert_data[$col] = $col_val;
                }' . PHP_EOL;
            $php .= 'if(!empty($insert_data)){
                        $insert_id = $db->insert ("' . $form_data['db_table'] . '" , $insert_data);
                        if ($insert_id){
                            $db_msg = "Data inserted successfully";
                            $db_success = 1;
                        } else {
                            $db_msg = "Insert failed: " . $db->getLastError();
                            $db_success = 0;
                        }
                    }' . PHP_EOL;
            $php .= '}catch(Exception $e){
                $db_msg = "Database insert failed" . $e->getMessage();
                $db_success = 0;
            }' . PHP_EOL;
                    
            return $php;
            
        } else {
            return '';
        }
    }

    public function generateDatabaseConfig( $form_data ){
        if( isset( $form_data['enable_database'] ) &&  ($form_data['enable_database'] == '1')  ){
            $php =
            '<?php' . PHP_EOL;;
            $php .= 'require_once ("MysqliDb.php");' . PHP_EOL;
            $php .= '$db = new MysqliDb ( "' . $form_data["db_host"] . '", "' . $form_data["db_username"] . '", "' . $form_data["db_password"] . '", "' . $form_data["db_name"] .'" );' . PHP_EOL;
            $php .= '?>';
            
            return $php;
        } else {
            return '';
        }
        
    }
}

?>