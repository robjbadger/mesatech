<?php
/**
 * Description of index.php file
 * Handles routing to different files are per input parameter
 * Create date: 21.05.2017
 * @author www.thewebfosters.com
 */

//Define constants used.
define( 'BASE_DIR', __DIR__ );

define( 'SAVED_FORMS_DIR', __DIR__ . '/saved-forms/' );

define( 'ASSETS_DIR', BASE_DIR . '/assets/' );

define( 'TEMP_STORAGE', __DIR__ . '/saved-forms/temp_storage/' );

define( 'DEMO_URL', 'http://multi-purpose-form-generator.thewebfosters.com' );

define( 'INCLUDE_COMMON_RESOURCES_IN_DOWNLOAD', TRUE );
define( 'ALLOW_DOWNLOAD', TRUE );
define( 'RESOURCE_VERSION', 1 );

//Create the saved-forms directory
if (!file_exists( SAVED_FORMS_DIR )) {
    mkdir( SAVED_FORMS_DIR , 0777);
}

if (!file_exists( TEMP_STORAGE )) {
    mkdir( TEMP_STORAGE , 0777);
}

if(empty($_GET['page'])){
	$page = 'create';
} else {
	$page = $_GET['page'];
}

include_once('library/' . $page . '.php');

?>

