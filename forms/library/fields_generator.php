<?php
/**
 * Description of FieldsGenerator Class
 * Contains function to generate HTML for different types of fields
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */

class FieldsGenerator {

	protected function text() {

    	$html = 
'            <div class="form-group ' . $this->el_custom_classes . '">
                <label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">'
      				. $this->el_label . '</label>
                <div class="col-sm-10">';

        if(!empty($this->el_icon)) {
            $html .= 
'               <div class="input-group">';
        }
        if( !empty($this->el_icon) && $this->el_icon_position == 'left') {
            $html .= 
"                   <span class='input-group-addon'><i class='fa $this->el_icon' aria-hidden='true'></i></span>";
        }

        $html .='
                    <input type="text" class="form-control" 
    					id="' . $this->el_id . '" 
    					name="fields[' . $this->el_name . ']" 
    					placeholder="' . $this->el_placeholder . '" 
    					data-rule-required="' . $this->el_v_required . '"
    					'.$this->el_v_required_msg .' '. 
    						$this->el_v_others . ' ' .
    						$this->el_v_others_msg. 
                            'style="' . $this->el_input_height . '">';
        
        if( !empty($this->el_icon) && $this->el_icon_position == 'right') {
            $html .= 
"                       <span class='input-group-addon'><i class='fa $this->el_icon' aria-hidden='true'></i></span>";
        }

        if(!empty($this->el_icon)) {
            $html .= '
            </div>';
        }

        $html .= 
        '</div>
    </div>';

        return $html . PHP_EOL;
	}

    protected function password() {
        $html = 
    '<div class="form-group ' . $this->el_custom_classes. '">

        <label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">' . 
                $this->el_label . 
        '</label>

        <div class="col-sm-10">';

        if(!empty($this->el_icon)) {
            $html .= 
            '<div class="input-group">';
        }
        if( !empty($this->el_icon) && $this->el_icon_position == 'left') {
            $html .= 
                "<span class='input-group-addon'><i class='fa $this->el_icon' aria-hidden='true'></i></span>";
        }

        $html .= 
                '<input type="password" class="form-control" ' . 
                        'style="' . $this->el_input_height . '" 
                            id="' . $this->el_id . '" 
                            name="fields[' . $this->el_name .']" 
                            placeholder="' . $this->el_placeholder . '" 
                            data-rule-required="' . $this->el_v_required . '"
                        '.$this->el_v_required_msg .' '. $this->el_v_others . ' ' .$this->el_v_others_msg. '>';

        if( !empty($this->el_icon) && $this->el_icon_position == 'right') {
            $html .= 
                "<span class='input-group-addon'><i class='fa $this->el_icon' aria-hidden='true'></i></span>";
        }
        if(!empty($this->el_icon)) {
            $html .= 
            '</div>';
        }

        $html .= 
        '</div>
    </div>';
        
        return $html . PHP_EOL;
    }

	protected function textarea() {

		$html = 
    '<div class="form-group ' . $this->el_custom_classes . '">

        <label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">' 
        		. $this->el_label . 
        '</label>

        <div class="col-sm-10">
            <textarea class="form-control" id="' . $this->el_id . '" name="fields[' . $this->el_name .']"
            	placeholder="' . $this->el_placeholder . '" 
            	data-rule-required="' . $this->el_v_required . '" ' . 
            	$this->el_v_required_msg . '></textarea>
        </div>

    </div>';

        return $html . PHP_EOL;
	}

	protected function radio() {
		
		$html = 
    '<div class="form-group ' . $this->el_custom_classes. '">

    	<label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">' . $this->el_label . 
    	'</label>

        <div class="col-sm-10">
            <div class="radio">';
                                    
        if(!empty( $this->el_options )){
	        foreach( $this->el_options as $key => $value ){

	            $selected = "";
	            if (in_array($value, $this->el_default_value)) {
	                $selected = "checked";
	            }

                $html .= 
                '<label class="radio-inline">
                    <input class="" type="radio" 
                        	name="fields[' . $this->el_name .']" 
                          	value="' . $value .'" ' . $selected . ' 
                          	data-rule-required="' . $this->el_v_required . '" 
                          	' . $this->el_v_required_msg . '> '. $value . '
                </label>';
            }
        }

        $html .= 
            '</div>
        </div>
    </div>';

        return $html . PHP_EOL;
	}

	protected function checkbox() {

		$html = 
        '<div class="form-group ' . $this->el_custom_classes. '">
        	<label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">' . $this->el_label . '</label>
                <div class="col-sm-10">
                	<div class="checkbox">';
                                    
        if(!empty( $this->el_options )){

            foreach( $this->el_options as $key => $value ){
                
                $selected = "";
                if (in_array($value, $this->el_default_value)){
                    $selected = "checked";
                }
                
                $html .= 
                        '<label class="checkbox-inline">
                        	<input class="" type="checkbox" 
                        		id="' . $this->el_id . '" 
                        		name="fields[' . $this->el_name .'][]"
                                value="' . $value .'" ' . $selected . ' 
                                data-rule-required="' . $this->el_v_required . '"
                                ' . $this->el_v_required_msg . ' ' . $this->el_v_others .
                                  ' ' . $this->el_v_others_msg . '> '. $value . '
                        </label>';
                
            }
        }

        $html .=
                    '</div>
        	   </div>
        </div>';

        return $html . PHP_EOL;
	}

	protected function select() {

        $html = 
    '<div class="form-group ' . $this->el_custom_classes. '">
        <label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">' . $this->el_label . '</label>
            <div class="col-sm-10">
            	<select class="form-control" id="' . $this->el_id . '" 
            		name="fields[' . $this->el_name . ']"
                    data-rule-required="' . $this->el_v_required . '" ' . $this->el_v_required_msg . ' 
                    style="' . $this->el_input_height . '">';

        if(!empty( $this->el_options )){
            foreach( $this->el_options as $key => $value ){
                
                $selected = "";

                if (in_array($value, $this->el_default_value)){
                    $selected = "selected";
                }
                
                $html .= 
                    '<option value="' . $value .'"  ' . $selected . '> '. $value . '</option>';
            }
        }
                                        
        $html .=      
                '</select>
            </div>
        </div>';

        return $html . PHP_EOL;
	}

	protected function multiple_select() {

		$html = 
    '<div class="form-group ' . $this->el_custom_classes. '">
        <label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">' . $this->el_label . '</label>
        	<div class="col-sm-10">
            	<select class="form-control" id="' . $this->el_id . '" name="fields[' . $this->el_name . '][]"
            		data-rule-required="' . $this->el_v_required . '" ' . 
            		$this->el_v_required_msg . ' multiple>';
                                    
        if(!empty( $this->el_options )){
            foreach( $this->el_options as $key => $value ){
                
                $selected = "";
                if (in_array($value, $this->el_default_value)){
                    $selected = "selected";
                }
                
                $html .= 
                    '<option value="' . $value .'"  ' . $selected . '> '. $value . ' </option>';
            }
        }

       	$html .=      
                '</select>
            </div>
        </div>';

        return $html . PHP_EOL;
	}

	protected function datepicker() {
        
		$html = 
		'<div class="form-group ' . $this->el_custom_classes. '">
			<label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">' . $this->el_label . '</label>
			<div class="col-sm-10">';
		if(!empty($this->el_icon)) {
            $html .= 
            '<div class="input-group">';
        }
        if( !empty($this->el_icon) && $this->el_icon_position == 'left') {
            $html .= 
                "<span class='input-group-addon'><i class='fa $this->el_icon' aria-hidden='true'></i></span>";
        }
		
		$html .= '
		<input type="text" class="form-control" readonly=true 
						id="' . $this->el_id . '" 
						name="fields[' . $this->el_name . ']" 
						placeholder="' . $this->el_placeholder . '" 
						data-rule-required="' . $this->el_v_required . '"
					'.$this->el_v_required_msg .' '. $this->el_v_others . ' ' .$this->el_v_others_msg. '>';
					
		if( !empty($this->el_icon) && $this->el_icon_position == 'right') {
            $html .= 
                "<span class='input-group-addon'><i class='fa $this->el_icon' aria-hidden='true'></i></span>";
        }
        if(!empty($this->el_icon)) {
            $html .=
			'</div>';
        }
		$html .=
			'</div>
		</div>';

        return $html . PHP_EOL;
	}

	protected function tnc() {

		if(!empty( $this->el_tnc_link )){
                    
            $this->el_label = '<a href="' . $this->el_tnc_link .'" 
            					target="_blank">' . $this->el_label . '</a>' ;
        }
                
	    $html = 
    '<div class="form-group ' . $this->el_custom_classes. '">

        <div class="col-sm-10 col-sm-offset-2">
            <div class="checkbox">
            <label>
            	<input type="checkbox" 
            		name="fields[' . $this->el_name . ']" 
            		data-rule-required="' . $this->el_v_required . '"
                  ' . $this->el_v_required_msg . ' >' . $this->el_label . 
            '</label>
            </div>
        </div>
	</div>';

        return $html . PHP_EOL;
	}

	protected function heading() {
		$html = '';

        if(!empty( $this->el_heading_text )){
                    
        	$html = 
    '<div class="form-group ' . $this->el_custom_classes. '">
        <div class="col-sm-11 col-sm-offset-1">';
                                    
            $html .= '<' . $this->el_heading_type . ' style="color: ' . $this->el_heading_color .' !important;">' . $this->el_heading_text . 
            		'</' . $this->el_heading_type . '>';

            $html .=  
        '</div>
    </div>';
        }

        return $html . PHP_EOL;
	}

	protected function rating() {

        $html = 
    '<div class="form-group ' . $this->el_custom_classes. '">

    	<label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">' . $this->el_label . 
    	'</label>

        <div class="col-sm-10">
            <span class="error_place">
            	<input input_type="rating" class="rating-loading" 
            		id="' . $this->el_id . '" 
            		name="fields[' . $this->el_name .']" 
            		data-rule-required="' . $this->el_v_required . '"
                    '.$this->el_v_required_msg .' 
                    value="' . $this->el_rating_default_val . '" 
                    data-min="' . $this->el_rating_min_value . '" 
                    data-max="' . $this->el_rating_max_value . '"
                    data-step="' . $this->el_rating_step . '" 
                    data-size="' . $this->el_rating_size . '"
                    data-stars="' . $this->el_rating_stars . '">
            </span>
        </div>
    </div>';

        return $html . PHP_EOL;
        
	}
	
	protected function file_upload() {
		$col_class = "col-sm-5";
		if($this->el_file_upload_number == 1){
			$col_class = "col-sm-2";
		}
		$html = 
    '<div class="form-group ' . $this->el_custom_classes . '">

        <label class="col-sm-2 control-label label-class_' . $this->form_id . '" for="' . $this->el_id . '">' 
        		. $this->el_label . 
        '</label>
		
        <div class="' . $col_class . '">
			<div id="' . $this->el_id . '" class="dropzone">
				<input type="hidden" name="fields[' . $this->el_name . ']" value="" class="dropzone_input"
				data-rule-required="' . $this->el_v_required . '" '.$this->el_v_required_msg .' >
				<div class="dz-message" data-dz-message>
					<span class="text-center"><i class="fa fa-upload fa-3x" aria-hidden="true"></i></span><br/>
					<span class="upload_text">' . $this->el_file_upload_text . '</span>
				</div>
			</div>
        </div>

    </div>';

        return $html . PHP_EOL;
	}
}

?>