<?php

/**
 * Description of GeneratorCommon Class
 * This class calls different function to generate HTML, JS, PHP, CSS
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */

include_once('generator_common_html.php');
include_once('generator_common_js.php');
include_once('generator_common_css.php');
include_once('generator_common_php.php');

class GeneratorCommon extends GeneratorCommonHtml {

    private $include_common_resources = true;

    private $form_html = '';
    private $form_js = '';
    private $form_css = '';
    private $form_php = '';

    function __construct($form_name, $action) {

        $this->final_action = $action;

        //Should be flase in demo server
        $this->allow_download = ALLOW_DOWNLOAD;
        if($this->final_action == 'download' && $this->allow_download == false) {
            header('Location: ' . DEMO_URL . '?d=1'); //redirect
            exit;
        }

    	parent::__construct($form_name);

        //Don't include common resource when downloading.
        if($this->final_action == 'download') {

            $this->include_common_resources = INCLUDE_COMMON_RESOURCES_IN_DOWNLOAD;

            $this->form_action = 'library/' . $this->form_name . '_submit.php';

        } else {

            $this->form_action = '?page=submit';
        }

    	$this->GeneratorCommonJs = new GeneratorCommonJs( $this->form_id, $this->include_common_resources, $this->final_action,  $this->form_name );

        $this->GeneratorCommonCss = new GeneratorCommonCss( $this->form_id, $this->include_common_resources, $this->final_action );

        $this->GeneratorCommonPhp = new GeneratorCommonPhp();

        $this->generate();
    }

    //create form to show
    public function generate(){

        $form_html = $this->formStart();
        $form_js = $this->GeneratorCommonJs->jsStart();
        $form_css = $this->GeneratorCommonCss->cssStart($this->form_data);
        $form_php = $this->GeneratorCommonPhp->phpStart();

        $formExtraJs = "";
        
        foreach($this->form_data['field'] as $key => $fd ){

            $form_html .= $this->elementToHtml( $fd );
            $form_js .= $this->GeneratorCommonJs->renderFormJs( $fd, $this->el_id );

            $this->GeneratorCommonCss->renderFormCss( $fd );
            $form_php .= $this->GeneratorCommonPhp->renderFormPhp();
        }

        //Js, Recaptach, End, all js files
        $form_js .= $this->GeneratorCommonJs->jsRecaptcha( $this->form_data );
        $form_js .= $this->GeneratorCommonJs->jsEnd( $this->form_data );
        $js_files = $this->GeneratorCommonJs->jsFiles();
        $this->form_js = $form_js;
        $this->form_js_files = $js_files;

        //Css start and end
        $this->form_css_files = $this->GeneratorCommonCss->cssFiles();
        $form_css .= $this->GeneratorCommonCss->cssEnd($this->form_data);
        $this->form_css = $form_css;

        //ReCaptcha, submit and end
        $form_html .= $this->reCaptcha();
        $form_html .= $this->submitBtn();
        $this->form_html = $form_html . $this->formEnd();

        //Show or download the form data
        if($this->final_action == 'download') {

            $form_php .= $this->GeneratorCommonPhp->reCaptcha( $this->form_data );
            $form_php .= $this->GeneratorCommonPhp->email( $this->form_data );
            $form_php .= $this->GeneratorCommonPhp->autoResponseEmail( $this->form_data );
			$form_php .= $this->GeneratorCommonPhp->databaseIntegration( $this->form_data );
            $form_php .= $this->GeneratorCommonPhp->phpEnd( $this->form_data );
            $this->form_php = $form_php;

            $this->download_form();

        } else {
            $this->show_form();
        }
    }

    private function show_form() {
        
        echo $this->form_html . PHP_EOL;
        echo $this->form_css_files . PHP_EOL;
        echo $this->form_css . PHP_EOL;
        echo $this->form_js_files . PHP_EOL;
        echo $this->form_js . PHP_EOL;
        echo $this->htmlBodyEnd() . PHP_EOL;
    }

    private function download_form() {

        if($this->final_action == 'download') {

            $this->directory = TEMP_STORAGE . $this->form_name . '_' . time() . '/';
            $this->directory_js = $this->directory . 'js/';
            $this->directory_css = $this->directory . 'css/';
            $this->directory_library_php = $this->directory . 'library/';
			$this->directory_php_mailer = $this->directory . 'library/PHPMailer';

            $download_html = $this->directory . $this->form_name . '.html';
            $download_js = $this->directory_js . $this->form_name . '.js';
            $download_css = $this->directory_css . $this->form_name . '.css';
            $download_library_php = $this->directory . $this->form_action;

            mkdir( $this->directory ) 
                or die('Failed creating the temporary directory inside saved-forms, Please check the permission');

            mkdir( $this->directory_js ) 
                or die('Failed creating the temporary directory inside saved-forms, Please check the permission');

            mkdir( $this->directory_css ) 
                or die('Failed creating the temporary directory inside saved-forms, Please check the permission');

            mkdir( $this->directory_library_php ) 
                or die('Failed creating the temporary directory inside saved-forms, Please check the permission');
			
			mkdir( $this->directory_php_mailer ) 
                or die('Failed creating the temporary directory inside saved-forms, Please check the permission');

            try {

                //Include assets(js/css) to form html
                $this->form_html_with_assets = $this->form_html . $this->formAddAsset() . $this->htmlBodyEnd();

                $h_html = fopen($download_html, 'w');
                fwrite($h_html, $this->form_html_with_assets);
                fclose($h_html);

                $h_css = fopen($download_css, 'w');
                fwrite($h_css, $this->form_css);
                fclose($h_css);

                $h_js = fopen($download_js, 'w');
                fwrite($h_js, $this->form_js);
                fclose($h_js);

                $h_libphp = fopen($download_library_php, 'w');
                fwrite($h_libphp, $this->form_php);
                fclose($h_libphp);
				
				//copy PHPMailer
				$src = __DIR__ . '/PHPMailer';
				$dst = $this->directory_php_mailer;
				$allFiles = scandir($src);
				$files = array_diff($allFiles, array('.', '..'));
				foreach($files as $file){
					  $source_file = $src . '/' . $file;
					  $dest_file = $dst . '/' . $file; 
					  copy($source_file, $dest_file);
				}
				//copy database library
				$form_data = $this->form_data;
				if( ( $form_data['enable_database'] ) &&  ($form_data['enable_database'] == '1') ){
					$source_file = __DIR__ . '/database/MysqliDb.php';
					$dest_file = $this->directory_library_php .'MysqliDb.php';
					copy($source_file, $dest_file);
					
					//create config file
					$content = $this->GeneratorCommonPhp->generateDatabaseConfig($form_data);
					$fp = fopen($this->directory_library_php . "config.php","wb");
					fwrite($fp,$content);
					fclose($fp);
				}
				//copy upload script
				$src = __DIR__ . '/upload.php';
				$dest = $this->directory_library_php .'upload.php';
				copy($src, $dest);
				
				//copy delete uploaded file script
				$src = __DIR__ . '/delete_file.php';
				$dest = $this->directory_library_php .'delete_file.php';
				copy($src, $dest);

                $this->zip_and_download();

            } catch( Exception $e ) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }

    function zip_and_download() {

        //Zip the folder and download it.
        $zip_file = $this->form_name . '.zip';
        $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($this->directory),
                    RecursiveIteratorIterator::LEAVES_ONLY
                );

        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($this->directory) );

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($zip_file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zip_file));
        ob_end_clean();
        readfile($zip_file);

        //Delete the file after download
        unlink($zip_file);
    }
}

$action = $_GET['action'];
$form_name = $_GET['form_name'];

if( empty($form_name) || !in_array($action, array('view', 'download')) ) {
    die('Invalid');
}

$cf = new GeneratorCommon( $form_name, $action );

?>