<?php

/**
 * Description of delete.php file
 * Handles deletion of form
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */

if( isset($_GET['form_name']) ){
    if( unlink( SAVED_FORMS_DIR . $_GET['form_name'] . '.json' ) ){
        echo 'true'; exit;
    } else {
        echo 'false'; exit;
    }
}

?>