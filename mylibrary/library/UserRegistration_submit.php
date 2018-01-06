<?php 
if(empty($_POST["form_name"])){
        die("Invalid");
    }
    ini_set("display_errors", "0");
    

require_once "PHPMailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;
    $mail->isHTML(true);

$mail->isSMTP();
            $mail->SMTPAuth = true;
$mail->Host = "smtp.mesatechcorp";
$mail->Username = "noreply@mesatechcorp.com";
$mail->Password = "meza2@19";
$mail->Port = 465;
$mail->SMTPSecure = "tls";
$subject = "Your MesaTech user account has been created.";
    if(!empty($subject)){
        foreach($_POST["fields"] as $key => $value){
            if(is_array($value)){
                $value = implode(" ,", $value);
            }
            $subject = str_replace( "__" . $key . "__", $value, $subject);
        }
    }

$body = "Your account for User Id: : __userid__ was created __DATE_TIME__ with the following paramaters:
First Name: : __firstname__
Last Name: : __lastname__
Phone: : __phone__
Ext: : __ext__
Email: : __email__

Thank you for registering with MesaTech!";
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
    

$mail->addAddress( "__email__" );
if(!empty($_POST["attachments"])){
        $attachments = explode( ",", $_POST["attachments"]);
        foreach( $attachments as $attachment ){
            $attachment_path = dirname(__DIR__) . "/uploads/" .  $attachment ;
            if( file_exists( $attachment_path ) ){
                $mail->addAttachment($attachment_path, $attachment);
            }
        }
    }

$mail->setFrom( "noreply@mesatechcorp.com" );
    $mail->Subject = $subject;
    $mail->Body = nl2br($body);
     
    $email_sent = $mail->send();

try{
                    require_once ("config.php");
$db_data = array();
$db_data["userid"] = "__userid__";
$db_data["firstname"] = "__firstname__";
$db_data["lastname"] = "__lastname__";
$db_data["phone"] = "__phone__";
$db_data["ext"] = "__ext__";
$db_data["email"] = "__email__";
$db_data["password"] = "__password1__";
$insert_data = array();
                foreach( $db_data as $col => $col_val){
                    foreach($_POST["fields"] as $key => $value){
                        if(is_array($value)){
                            $value = implode(" ,", $value);
                        }
                        $col_val = str_replace( "__" . $key . "__", htmlspecialchars( $value ) , $col_val);
                    }
                    $insert_data[$col] = $col_val;
                }
if(!empty($insert_data)){
                        $insert_id = $db->insert ("users" , $insert_data);
                        if ($insert_id){
                            $db_msg = "Data inserted successfully";
                            $db_success = 1;
                        } else {
                            $db_msg = "Insert failed: " . $db->getLastError();
                            $db_success = 0;
                        }
                    }
}catch(Exception $e){
                $db_msg = "Database insert failed" . $e->getMessage();
                $db_success = 0;
            }
if( $email_sent ){
$output = array("success" => 1, 
                        "redirect" => 1, 
                        "url" => "index.php?content=thankyou");
echo json_encode($output); exit;
    } else {
$output = array("success" => 0, 
                    "error" => "Email error",
                    "msg" => "Something went wrong, please try again.",
                    "data" => $data,
                    "phpMailer_error" => $mail->ErrorInfo
                );
            echo json_encode($output); exit;
}
?>