<?php

/**
 * Description of GeneratorCommonHtml Class
 * Generates HTML for the form
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */

include_once('fields_generator.php');

class GeneratorCommonHtml extends FieldsGenerator {
    
    //private $include_datepicker = false;

    protected $form_name = '';
    protected $form_data = '';
    protected $form_id_key = '';
    protected $form_id = '';

    function __construct($form_name) {

    	$this->form_name = str_replace(' ', '_', $form_name);

        $form_json_file = fopen( SAVED_FORMS_DIR . $this->form_name . '.json', "r") or die("Unable to open file!");

        $this->form_data = fread($form_json_file, filesize( SAVED_FORMS_DIR . $this->form_name . '.json'));
        $this->form_data = json_decode($this->form_data, true);

        $this->form_id_key = time();
        $this->form_id = preg_replace('/\s+/', '_', $this->form_name) 
        											. '_' . $this->form_id_key;

        fclose($form_json_file);
    }

    public function formStart() {

        $form = 
'<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Form(Replace it with your page title)</title>
    </head>
    <body>
        <!-- Put your body content here -->

        <div class="container">

            <form class="form-horizontal" method="POST" 
                action="' . $this->form_action . '"
            	id="'. $this->form_id . '"
            	style="background-color: '. $this->formBackgroundColor() .'; ' . $this->formFontSize() . '">
                <input type="hidden" name="form_name" value="' . $this->form_name . '">
            </br>

            <span id="msg"></span>' . PHP_EOL;
        
        return $form;
    }

    public function reCaptcha() {

        $recaptcha_string = "";

        if(isset( $this->form_data['enable_recaptcha'] ) 
        		&& ( $this->form_data['enable_recaptcha'] == '1' )){

            $recaptcha_string = 
'               <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="g-recaptcha" data-sitekey="' . $this->form_data['site_key'] . '"></div>
                    </div>
                </div>' . PHP_EOL;

            return $recaptcha_string;
        }
    }

    public function submitBtn() {

    	$submit_btn_class = '';

        if(!empty($this->form_data['btn_size'])){
            $submit_btn_class .= $this->form_data['btn_size'];
        }

        if(!empty($this->form_data['btn_color'])){
            $submit_btn_class .= ' ' . $this->form_data['btn_color'];
        } else {
            $submit_btn_class .= ' btn-primary';
        }

        if(!empty($this->form_data['btn_allign'])){
            $submit_btn_class .= ' ' . $this->form_data['btn_allign'];
        }

    	$html = 
'           <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                	<button class="send_email btn ' . $submit_btn_class . '"
                    	type="submit" 
                    	data-loading-text="' . $this->form_data['loading_text'] . '">' . $this->form_data['btn_text'] . 
                    '</button>
                </div>
            </div>' . PHP_EOL;

        return $html;
    }
    
    public function formEnd() {
    	$html = 
'       </form>
    </div>

        <!-- Put your body content here -->'  . PHP_EOL;

    	return $html;
    }

    public function htmlBodyEnd() {
        $html = '</body>' . PHP_EOL;

        return $html;
    }

    public function formAddAsset() {

        //Add css file
        $html = '
    <link rel="stylesheet" type="text/css" href="./css/' . $this->form_name . '.css">';

        //Add css library
        $html .= $this->form_css_files;

        //Add js library
        $html .= $this->form_js_files;

        //Add js file
        $html .= '<script type="text/javascript" 
                    src="./js/' . $this->form_name . '.js"></script>' . PHP_EOL;

        return $html;
    }

    private function formFontSize() {

    	$form_font_size = '';

        if(!empty( $this->form_data['form_font_size'] ) ){
            $form_font_size = 'font-size: ' . $this->form_data['form_font_size'] . 'px ;';
        }

        return $form_font_size;
    }

    private function formBackgroundColor() {

    	$form_bk_color = '';

        if(!empty( $this->form_data['background_color'] ) ){
            $form_bk_color = $this->form_data['background_color'];
        }

        return $form_bk_color;
    }

    public function elementToHtml( $element ) {

    	$this->elementType( $element );
    	$this->elementName( $element );
    	$this->elementLabel( $element );
        $this->elementIcon( $element );
    	$this->elementId( $element );
    	$this->elementPlaceholder( $element );
    	$this->elementCustomClass( $element );
    	$this->elementDefaultValue( $element );
    	$this->elementOptions( $element );
		$this->elementHeight( $element );
    	
    	$this->elementValidationRequired( $element );
    	$this->elementValidationOthers( $element );

    	return $this->typeToHtml( $element );

        //$selected = "";

    }

    private function typeToHtml( $element ) {
		
		switch ($this->el_type){
            case 'text':
                return $this->text();
                break;

            case 'password':
                return $this->password();
                break;

            case 'textarea':
                return $this->textarea();
                break;
                
            case 'radio':
                return $this->radio();
                break;

            case 'checkbox':
            	return $this->checkbox();
                break;

            case 'select':
            	return $this->select();
            	break;

            case 'multiple_select':
                return $this->multiple_select();
                break;

            case 'datepicker':
                return $this->datepicker();
                break;

            case 'tnc':
            	$this->elementTnC( $element );
                return $this->tnc();
                break;
            
            case 'heading':
            	$this->elementHeadingDetails( $element );
                return $this->heading();
                break;

            case 'rating':
            	$this->elementRatingDetails( $element );
                return $this->rating();
			break;
		
			case 'file_upload':
            	$this->elementFileUploadDetails( $element );
                return $this->file_upload();
			break;

            default:
                $form_html = '';
        }
    }

    private function elementType( $element ) {

    	$this->el_type = '';

    	if(!empty($element['type'])){
    		$this->el_type = $element['type'];
    	}
    }

	private function elementName( $element ) {

		$this->el_name = '';

		if(!empty( $element['name'] )) {
            $name = $element['name'];
            $this->el_name = $name;
        }
    }

    private function elementLabel( $element ) {

		$this->el_label = '';

        if(!empty( $element['label'] )){
            $this->el_label = $element['label'];

            if(isset( $element['required'] ) && ( $element['required'] == 'on' )){
            	$this->el_label .= ' <span class="required-field_' . $this->form_id . '">*</span>';
            }

        }
    }

    private function elementIcon( $element ) {

        $this->el_icon = '';
        $this->el_icon_position = '';

        if( in_array($this->el_type, array('text', 'password', 'datepicker')) ) {

            if(!empty( $element['input_icon'] )){

                $this->el_icon = $element['input_icon'];
                $this->el_icon_position = 'left';
                
                if(!empty( $element['input_icon_position'] )){
                    $this->el_icon_position = $element['input_icon_position'];
                }
            }
        }
    }

    private function elementId( $element ) {

		$this->el_id = $this->el_name . $this->form_id_key;
    }

    private function elementPlaceholder( $element ) {

    	$this->el_placeholder = '';

        if(!empty( $element['placeholder'] )){
            $this->el_placeholder = $element['placeholder'];
        }
    }

    private function elementDefaultValue( $element ) {

    	$this->el_default_value = array();

        if(isset($element['default_select'])){
            $this->el_default_value = explode(", ", $element['default_select']);
        }

    }

    private function elementOptions( $element ) {

    	$this->el_options = '';

    	if(!empty( $element['options'] )){
    		$this->el_options = $element['options'];
    	}
    }

    private function elementHeight( $element ) {

    	$this->el_input_height = '';

        if(!empty( $element['input_size'] )){
            $this->el_input_height = 'height: ' . $element['input_size'] . 'px;';
        }

    }

    private function elementTnC( $element ) {

    	$this->el_tnc_link = '';

    	if(isset( $element['tnc_link'] ) && !empty( $element['tnc_link'] )){
            $this->el_tnc_link = $element['tnc_link'];
        }

    }

    private function elementHeadingDetails( $element ) {

    	//Heading text
    	$this->el_heading_text = '';
    	if(isset( $element['heading_text'] ) && !empty( $element['heading_text'] )){
            $this->el_heading_text = $element['heading_text'];
        }

        //Heading type
        $this->el_heading_type = '';
    	if(isset( $element['heading_type'] ) && !empty( $element['heading_type'] )){
            $this->el_heading_type = $element['heading_type'];
        }

        //Heading color
        $this->el_heading_color = '';
    	if(isset( $element['font_color'] ) && !empty( $element['font_color'] )){
            $this->el_heading_color = $element['font_color'];
        }    	
    }

    private function elementRatingDetails( $element ) {

    	//Rating caption
    	$this->el_rating_captions = '';
    	if(isset( $element['caption'] ) && !empty( $element['caption'] )){
    		$this->el_rating_captions = explode(",", $element['caption']);
        }

        //Default value
        $this->el_rating_default_val = '';
    	if(isset( $element['default_val'] ) && !empty( $element['default_val'] )){
    		$this->el_rating_default_val = $element['default_val'];
        }

        $this->el_rating_min_value = '';
    	if(isset( $element['min_value'] ) && !empty( $element['min_value'] )){
    		$this->el_rating_min_value = $element['min_value'];
        }

        $this->el_rating_max_value = '';
    	if(isset( $element['max_value'] ) && !empty( $element['max_value'] )){
    		$this->el_rating_max_value = $element['max_value'];
        }

        $this->el_rating_step = '';
    	if(isset( $element['step'] ) && !empty( $element['step'] )){
    		$this->el_rating_step = $element['step'];
        }

        $this->el_rating_size = '';
    	if(isset( $element['size'] ) && !empty( $element['size'] )){
    		$this->el_rating_size = $element['size'];
        }

        $this->el_rating_stars = '';
    	if(isset( $element['stars'] ) && !empty( $element['stars'] )){
    		$this->el_rating_stars = $element['stars'];
        }

    }

    private function elementCustomClass( $element ) {

		$this->el_custom_classes = '';

        if(!empty($element['custom_class'])){
            $class_array = explode(",", $element['custom_class']);
            
            foreach($class_array as $cs){
                $this->el_custom_classes .= $cs . ' ';
            }
        }
    }

    private function elementValidationRequired( $element ) {

    	$this->el_v_required = 'false';
        $this->el_v_required_msg = '';

        if(isset( $element['required'] ) && ( $element['required'] == 'on' )){
            $this->el_v_required = 'true';
            $this->el_v_required_msg = 'data-msg-required="' . $element['required_error_msg'] .'"';
        }

    }

    private function elementValidationOthers( $element ) {

    	$this->el_v_others = '';
        $this->el_v_others_msg = '';

        if(isset($element['validation']) && ($element['validation'] != 'none')){

            if($element['validation'] == 'minlength' || $element['validation'] == 'maxlength'){

                $this->el_v_others = 'data-rule-' . $element['validation'] . '="' . $element['validation_value'] . '"';
                $this->el_v_others_msg = 'data-msg-' . $element['validation'] . '="' . $element['custom_error_msg'] .'"';
                
            } elseif ($element['validation'] == 'range') {

                $range = explode("-",$element['validation_value']);
                $this->el_v_others = 'data-rule-' . $element['validation'] . '="[' . $range[0] .', ' . $range[1] . ']"';
                $this->el_v_others_msg = 'data-msg-' . $element['validation'] . '="' . $element['custom_error_msg'] .'"';
                
            } elseif ($element['validation'] == 'phone'){

                $this->el_v_others = 'data-rule-minlength="10" data-rule-maxlength="10" data-rule-digits="true"';

                $this->el_v_others_msg = 'data-msg-minlength="' . $element['custom_error_msg'] .'" ';
                $this->el_v_others_msg .= 'data-msg-maxlength="' . $element['custom_error_msg'] .'" ';
                $this->el_v_others_msg .= 'data-msg-digits="' . $element['custom_error_msg'] .'" ';

            } else {

                $this->el_v_others = 'data-rule-' . $element['validation'] . '="true"';
                $this->el_v_others_msg = 'data-msg-' . $element['validation'] . '="' . $element['custom_error_msg'] .'"';
            }

        }
    }
	
	private function elementFileUploadDetails( $element ) {

    	//File upload text
    	$this->el_file_upload_text = 'Drop a file here or click to upload';
    	if(isset( $element['upload_text'] ) && !empty( $element['upload_text'] )){
    		$this->el_file_upload_text = $element['upload_text'];
        }

        //No. of files
        $this->el_file_upload_number = 1;
    	if(isset( $element['no_of_files'] ) && !empty( $element['no_of_files'] )){
    		$this->el_file_upload_number = $element['no_of_files'];
        }

        $this->el_file_upload_size_limit = 20;
    	if(isset( $element['file_limit'] ) && !empty( $element['file_limit'] )){
    		$this->el_file_upload_size_limit = $element['file_limit'];
        }

        $this->el_file_upload_allowed_file = 0;
    	if(isset( $element['allowed_file'] ) && !empty( $element['allowed_file'] )){
    		$this->el_file_upload_allowed_file = $element['allowed_file'];
        }

        $this->el_file_upload_allowed_file_types = '';
    	if(isset( $element['allowed_file_types'] ) && !empty( $element['allowed_file_types'] )){
    		$this->el_file_upload_allowed_file_types = $element['allowed_file_types'];
        }
    }

}

?>