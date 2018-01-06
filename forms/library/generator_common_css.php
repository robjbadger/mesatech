<?php
/**
 * Description of GeneratorCommonCss Class
 * Generates CSS for the form
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */

class GeneratorCommonCss {
    
    //private $include_datepicker = false;

    protected $version = 1;

    function __construct( $form_id, $add_basic_css = true, $final_action = 'view' ) {

        $this->version = 1;
        $this->form_id = $form_id;
        $this->final_action = $final_action;
        $this->all_css_files = array();
        $this->is_fontawesome_set = false;

        //Check if condition is enabled.
        if($add_basic_css){
            $this->all_css_files[] = array('href' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
        }
    }

    public function cssFiles() {

        $css = '';

        foreach (array_unique($this->all_css_files, SORT_REGULAR) as $value) {

            $css .= ' <link rel="stylesheet"';

            foreach ($value as $k => $v) {
                if(is_numeric($k)){
                    $css .=  ' ' . $v ;
                } else {
                    $css .= ' ' . $k . '="' . $v . '"';
                }
            }

            $css .= '>' . PHP_EOL;
        }

        return $css;
    }


    public function cssStart($form_data) {

        $id = $this->form_id;
        $error_msg_color = $form_data['error_msg_color'];
        $required_asterisk_color = $form_data['required_asterisk_color'];
        $label_color = $form_data['label_color'];

        $css = '';
        if($this->final_action == 'view') {
            $css .= '<style>'  . PHP_EOL;
        }

        $css .= "    .error-class_$id {
                        color: $error_msg_color;
                    }

                    .required-field_$id {
                        color: $required_asterisk_color;
                    }

                    .label-class_$id {
                        color: $label_color ;
                    }";

        //Add css for highlighting the input field when there is error.
        if(!empty($form_data['error_field_highlight'])) {

            $css .= "
                .has-error_$id .checkbox, .has-error_$id .checkbox-inline, .has-error_$id .control-label, .has-error_$id .help-block, .has-error_$id .radio,.has-error_$id .radio-inline,.has-error_$id.checkbox label,.has-error_$id.checkbox-inline label,.has-error_$id.radio label,.has-error_$id.radio-inline label{
                        color: $error_msg_color
                    }
                    .has-error_$id .form-control{
                        border-color:$error_msg_color;
                        -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);
                        box-shadow:inset 0 1px 1px rgba(0,0,0,.075)
                    }
                    // .has-error_$id .form-control:focus{
                    //     border-color:$error_msg_color;
                    //     -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px ;
                    //     box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px 
                    // }
                    .has-error_$id .input-group-addon{
                        color:$error_msg_color;
                        background-color:#f2dede;
                        border-color:$error_msg_color
                    }
                    .has-error_$id .form-control-feedback{
                        color:$error_msg_color
                    }
                ";
        }

        return $css;
    }

    public function renderFormCss($element) {

        $type = $element['type'];

        //Check if font is set then add font-awesome link
        if( !$this->is_fontawesome_set && ( !empty($element['input_icon']) || $type == 'file_upload' ) ) {

            $this->all_css_files[] = array('href' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

            $this->is_fontawesome_set = true;
        }

        switch ($type) {
            
            case 'datepicker':

                $this->all_css_files[] = array('href' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css');
                break;

            case 'rating':
                $this->all_css_files[] = array('href' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.1/css/star-rating.min.css');
                break;
            case 'file_upload':
                $this->all_css_files[] = array('href' => 'https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css');
                break;
        }

        return true;
    }

    public function cssEnd($form_data) {

        if($this->final_action == 'view') {

            return $form_data['css'] . PHP_EOL . '</style>';

        } else {

            return $form_data['css'];
        }
    }
}

?>