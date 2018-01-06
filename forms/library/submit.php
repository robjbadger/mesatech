<?php

/**
 * Description of submit.php file
 * Handles form submittion
 * Create date: 21.05.2017
 * @author www.thewebfosters.com
 */

if(isset($_POST)){
    //Global try catch
    try{

    ini_set("display_errors", "0");
    $form_name = str_replace(' ', '_', $_POST['form_name']);
    $myfile = fopen( SAVED_FORMS_DIR . $form_name . '.json', "r") or die("Unable to open file!");

    $file_data = fread($myfile, filesize( SAVED_FORMS_DIR . $form_name . '.json'));

    fclose($myfile);
    
    $formData = json_decode($file_data, true);
    
    //Verification for google reCaptcha
    if(isset($formData['enable_recaptcha']) && ($formData['enable_recaptcha'] == '1')){
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
            //your site secret key
            $secret = $formData['secret_key'];
            //get verify response data
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            
            if(!$responseData->success) {
                $output = array('success' => 0, 
                                'error' => 'reCaptcha error',
                                'msg' => $formData['email_failed_msg']);
                echo json_encode($output);
                exit;
            }
            
        } else {
            $output = array('success' => 0, 
                            'error' => 'reCaptcha error',
                            'msg' => $formData['email_failed_msg']
                        );
            echo json_encode($output);
            exit;
        }
    }
    
    //Send email
    require_once "PHPMailer/PHPMailerAutoload.php";
    
    $mail = new PHPMailer;
    $mail->isHTML(true);
    if(!empty($formData['enable_smtp']) && $formData['enable_smtp'] == 1){
        $mail->isSMTP();
        //$mail->SMTPDebug = 2;
        $mail->SMTPAuth = true;
        if(!empty($formData['smtp_host'])){
            $mail->Host = $formData['smtp_host'];
        }
        if(!empty($formData['smtp_username'])){
            $mail->Username = $formData['smtp_username'];
        }
        if(!empty($formData['smtp_password'])){
            $mail->Password = $formData['smtp_password'];
        }
        if(!empty($formData['smtp_port'])){
            $mail->Port = $formData['smtp_port'];
        }
        $mail->SMTPSecure = '';
        if(!empty($formData['smtp_secure'])){
            $mail->SMTPSecure = $formData['smtp_secure'];
        }             
    }
    
    $toArray = explode(',', $formData['msg_to']);
    $from = "Form";
    if(!empty($formData['msg_from'])){
        $from = $formData['msg_from'];
    }
            
    $subject = "Subject";
    if(!empty($formData['msg_sub'])){
        $subject = $formData['msg_sub'];
        
        foreach($_POST['fields'] as $key => $value){
            if(is_array($value)){
                $value = implode(' ,', $value);
            }
            $subject = str_replace( '__' . $key . '__', $value, $subject);
        }
    }
    $body = $formData['msg_body'];
    $data = array();
    foreach($_POST['fields'] as $key => $value){
        if(is_array($value)){
            $value = implode(' ,', $value);
        }
        $data[$key] = $value;
        $body = str_replace( '__' . $key . '__', htmlspecialchars( $value ), $body);
    }
    $body = str_replace( '__SENDER_IP__', $_SERVER['REMOTE_ADDR'], $body);
    $body = str_replace( '__DATE_TIME__', date("Y-m-d H:i:s"), $body);
    if(!empty($formData['msg_cc'])) {
        $ccArray = explode(',', $formData['msg_cc']);
        foreach($ccArray as $cc){
            $mail->addCC( trim($cc) );
        }
    }
    
    $mail->setFrom($from);
    foreach( $toArray as $to){
        $mail->addAddress( trim($to) ); 
    } 
    $mail->Subject = $subject;
    $mail->Body = nl2br($body);
    
    if(!empty($_POST['attachments'])){
        $attachments = explode( ',', $_POST['attachments']);
        foreach( $attachments as $attachment ){
            $attachment_path = dirname(__DIR__) . '/uploads/' . $attachment ;
            if( file_exists( $attachment_path ) ){
                $mail->addAttachment($attachment_path, $attachment);
            }
        }
    }
    $email_sent = $mail->send();
    
    //Send response
    if( $email_sent && ( isset( $formData['enable_auto_response'] ) &&  ($formData['enable_auto_response'] == '1') ) ){
        
        $response = new PHPMailer;
        $response->isHTML(true);
        if(!empty($formData['enable_smtp']) && $formData['enable_smtp'] == 1){
            $response->isSMTP();
            //$mail->SMTPDebug = 2;
            $response->SMTPAuth = true;
            if(!empty($formData['smtp_host'])){
                $response->Host = $formData['smtp_host'];
            }
            if(!empty($formData['smtp_username'])){
                $response->Username = $formData['smtp_username'];
            }
            if(!empty($formData['smtp_password'])){
                $response->Password = $formData['smtp_password'];
            }
            if(!empty($formData['smtp_port'])){
                $response->Port = $formData['smtp_port'];
            }
            $response->SMTPSecure = '';
            if(!empty($formData['smtp_secure'])){
                $response->SMTPSecure = $formData['smtp_secure'];
            }             
        }
        $response_to_key = $formData['auto_response_to'];
        
        $response_to = $_POST['fields']["$response_to_key"];
        
        $response_from = "From";
        if(!empty($formData['auto_response_from'])){
            $response_from = $formData['auto_response_from'];
        }
        
        $response_subject = "Subject";
        if(!empty($formData['auto_response_sub'])){
            $response_subject = $formData['auto_response_sub'];
            foreach($_POST['fields'] as $key => $value){
                if(is_array($value)){
                    $value = implode(' ,', $value);
                }
                $response_subject = str_replace( '__' . $key . '__', $value, $response_subject);
            }
        }
        
        $response_body = $formData['auto_response_body'];
        foreach($_POST['fields'] as $key => $value){
            if(is_array($value)){
                $value = implode(' ,', $value);
            }
            $response_body = str_replace( '__' . $key . '__', htmlspecialchars( $value ), $response_body);
        }
        
        $response->setFrom($response_from);
        $response->addAddress($response_to);  
        $response->Subject = $response_subject;
        $response->Body = nl2br($response_body);
        
        $response_sent = $response->send();
    }
    
    //database integration
    if( isset( $formData['enable_database'] ) &&  ($formData['enable_database'] == '1') ){
        try{
            require_once ('database/MysqliDb.php');

            $db = new MysqliDb ($formData['db_host'], $formData['db_username'], $formData['db_password'], $formData['db_name']);

            $insert_data = array();
            if( !empty($formData['db_data']) ){

                foreach($formData['db_data'] as $db_data){
                    $column = $db_data['column'];
                    $col_val = $db_data['value'];
                    foreach($_POST['fields'] as $key => $value){
                        if(is_array($value)){
                            $value = implode(' ,', $value);
                        }
                        $col_val = str_replace( '__' . $key . '__', htmlspecialchars( $value ), $col_val);
                    }
                    $insert_data[$column] = $col_val;
                }

                if(!empty($insert_data)){
                    $insert_id = $db->insert ($formData['db_table'], $insert_data);
                    
                    if ($insert_id){
                        $db_msg = 'Data inserted successfully';
                        $db_success = 1;
                    } else {
                        $db_msg = 'Insert failed: ' . $db->getLastError();
                        $db_success = 0;
                    }
                }
            }
        } catch(Exception $e){
            $db_msg = "Database insert failed" . $e->getMessage();
            $db_success = 0;
        }
    }
    
    if( $email_sent ){
        if( empty($formData['post_submit_action']) || $formData['post_submit_action'] == 'show_msg' ){
            $output = array('success' => 1, 'redirect' => 0, 
                            'msg' => $formData['email_success_msg'],
                            'data' => $data);
        }
        if(!empty($db_msg)){
            $output['db_msg'] = $db_msg;
            $output['db_success'] = $db_success;
        }
        if( $formData['post_submit_action'] == 'redirect' ){
            $output = array('success' => 1, 'redirect' => 1, 
                            'url' => $formData['redirect_url']);
        }
        echo json_encode($output);
        exit;
        
    } else {

        if( empty($formData['post_submit_action']) || $formData['post_submit_action'] == 'show_msg' ){
            $output = array('success' => 0, 
                            'error' => 'Error sending the email',
                            'msg' => $formData['email_failed_msg'],
                            'data' => $data,
                            'phpMailer_error' => $mail->ErrorInfo
                        );
        } else {

            $output = array('success' => 0, 
                            'error' => 'Error sending the email',
                            'msg' => 'Something went wrong.',
                            'data' => $data,
                            'phpMailer_error' => $mail->ErrorInfo
                        );
        }
        if(!empty($db_msg)){
            $output['db_msg'] = $db_msg;
        }
        echo json_encode($output);
        exit;
    }
}catch(Exception $e){
    $output = array('success' => 0, 
                            'error' => 'Catch block',
                            'msg' => 'Something went wrong.' . $e->getMessage()
                        );
    echo json_encode($output);
    exit;
}
}
?>