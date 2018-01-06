<?php
/**
 * Description of update.php file
 * Handles form update
 * Create date: 21.05.2017
 * @author www.thewebfosters.com
 */

if(!empty($_POST) && isset($_POST['field'])){
    $form_data = json_encode($_POST);
    
    $form_name = str_replace(' ', '_', $_POST['form_name']);
    
    $myfile = fopen( SAVED_FORMS_DIR . $form_name . '.json', "w") or die("Unable to open file!");

    fwrite($myfile, $form_data);

    fclose($myfile);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>