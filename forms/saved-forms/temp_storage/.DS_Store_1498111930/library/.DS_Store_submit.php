<?php 
if(empty($_POST["form_name"])){
        die("Invalid");
    }

$subject = " __field_1__";
    if(!empty($subject)){

        foreach($_POST["fields"] as $key => $value){
            if(is_array($value)){
                $value = implode(" ,", $value);
            }
            $subject = str_replace( "__" . $key . "__", $value, $subject);
        }
    }

$body = " __field_1__";
    $data = array();
    foreach($_POST["fields"] as $key => $value){
        if(is_array($value)){
            $value = implode(" ,", $value);
        }
        $data[$key] = $value;
        $body = str_replace( "__" . $key . "__", htmlspecialchars( $value ), $body);
    }
    

$email_sent = mail("test@test.com", $subject, nl2br($body), "From: test@test.com
MIME-Version: 1.0
Content-type: text/html; charset=iso-8859-1");

if( $email_sent ){
$output = array("success" => 1, 
                    "redirect" => 0, 
                    "msg" => "Email sent successfully.",
                    "data" => $data
                );
echo json_encode($output);
            exit;
    } else {$output = array("success" => 0, 
                    "error" => "Email error",
                    "msg" => "Something went wrong, please try again.",
                    "data" => $data
                );
}
?>