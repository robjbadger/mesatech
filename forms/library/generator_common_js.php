<?php

/**
 * Description of GeneratorCommonJs Class
 * Generates Javascript for the form
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */

class GeneratorCommonJs {
    
    //private $include_datepicker = false;

    protected $version = 1;

    function __construct( $form_id, $add_basic_js = true, $final_action = 'view', $form_name ) {

        $this->version = 1;
        $this->form_id = $form_id;
        $this->final_action = $final_action;
        $this->all_js_files = array();
        $this->form_name = $form_name;

        //Check if condition is enabled.
        if($add_basic_js){
            $this->all_js_files[] = array('src' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');
            $this->all_js_files[] = array('src' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
        }

        //Add validation js files
        $this->all_js_files[] = array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js');
        $this->all_js_files[] = array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.min.js');
    }

    public function jsFiles() {

        $js = '';

        foreach (array_unique($this->all_js_files, SORT_REGULAR) as $value) {
            
            $js .= '<script';

            foreach ($value as $k => $v) {
                if(is_numeric($k)){
                    $js .=  ' ' . $v ;
                } else {
                    $js .= ' ' . $k . '="' . $v . '"';
                }
            }

            $js .= '> </script>' . PHP_EOL;
        }

        return $js;
    }

    public function jsStart() {

        $js = '';
        if($this->final_action == 'view') {
            $js .= '            <script>' . PHP_EOL;
        }

        $js .= 
'               var form_submitted = "0";
                $(document).ready(function(){'.
                '$.validator.addMethod("lettersonly", function(value, element) {
                    return this.optional(element) || /^[a-z]+$/i.test(value);
                });'.

                "
                $('#$this->form_id').validate({".
                    ' ignore: "",
                    errorPlacement: function(error, element) {
                            if (element.attr("type") == "checkbox") {
                                error.insertAfter(element.closest(".checkbox"));
                            } else if (element.attr("type") == "radio") {
                                error.insertAfter(element.closest(".radio"));
                            } else if (element.attr("input_type") == "rating") {
                                error.insertAfter(element.closest(".error_place"));
                            } else if (element.parent(".input-group").length) {
                                error.insertAfter(element.parent());
                            }else if ( element.hasClass("dropzone_input") ) {
                                error.insertAfter(element.closest(".dropzone"));
                            } else {
                                error.insertAfter(element);
                            }
                        },
                    highlight: function(element) {
                        $(element).closest(".form-group").addClass("has-error_'.$this->form_id.'");
                    },
                    unhighlight: function(element) {
                        $(element).closest(".form-group").removeClass("has-error_' . $this->form_id . '");
                    },
                    errorClass: "error-class_' . $this->form_id . '",
                    submitHandler: function (form) {
                        var form_data = $(form).serialize();
                        if( typeof uploadedFiles !== "undefined" && uploadedFiles.length){
                            form_data += "&attachments="  + uploadedFiles.join(",") ;
                        }
                        var $btn = $(form).find(".send_email").button("loading");
                        $.ajax({
                            type: $(\'#' . $this->form_id . '\').attr(\'method\'),
                            url: $(\'#' . $this->form_id . '\').attr(\'action\'),
                            data: form_data,
                            dataType: "json",
                            success: function (result) {
                                $btn.button("reset");';

                            if($this->final_action == 'view') {
                                $js .= '
                                if(result.db_success == 0){
                                    alert(result.db_msg);    
                                }';
                            }

                    $js .= 'if(result.success == 1){
                                    if (typeof ' . $this->form_name . '_success_true === "function") {
                                        ' . $this->form_name . '_success_true(result);
                                    }
                                    if( result.redirect == 1 ){
                                        window.location = result.url;
                                    } else {
                                        var html = \'<div class="alert alert-dismissable alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\' + result.msg + \'</div>\';
                                        $(form).find( "#msg" ).html(html);
                                        form_submitted = "1"
                                        $(form)[0].reset();
                                        if(typeof uploadedFiles !== "undefined"){
                                            $(".dropzone").each( function(){
                                                 Dropzone.forElement(this).removeAllFiles();
                                            });
                                            form_submitted = "0"
                                        }
                                    }
                                } else {
                                    if (typeof ' . $this->form_name . '_success_false === "function") {
                                        ' . $this->form_name . '_success_false(result);
                                    }
                                    var html = \'<div class="alert alert-dismissable alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\' + result.msg + \'</div>\';
                                    $(form).find( "#msg" ).html(html);
                                }';
                $js .=  '}
                        });
                        return false;
                    }
                });
            });
        ';

        return $js;
    }

    public function renderFormJs($element, $id) {

        $type = $element['type'];
        $js = '';
        switch ($type) {
            
            case 'datepicker':
                $format = $element['date_format'];
                $start = $element['start_date'];
                $end = $element['end_date'];
                $lang = $element['datepicker_language'];
                $disabled_days = '';
                if( isset( $element['disabled_days']) ){
                    $disabled_days = implode(',', $element['disabled_days']);
                }
                if($start == 'none') {
                    $start = '-50y';
                } elseif ($start == 'today') {
                    $start = '+0d';
                } elseif ($start == 'current_year') {
                    $start = '+0y';
                } elseif ($start == 'current_month') {
                    $start = '+0m';
                } elseif ($start == 'n-after') {
                    $start = '+' . $element['start_days'] . 'd';
                } elseif ($start == 'n-before') {
                    $start = '-' . $element['start_days'] . 'd';
                }
                
                if($end == 'none') {
                    $end = '+50y';
                } elseif ($end == 'today') {
                    $end = '+0d';
                } elseif ($end == 'current_year') {
                    $end = '+1y';
                } elseif ($end == 'current_month') {
                    $end = '+1m';
                } elseif ($end == 'n-after') {
                    $end = '+' . $element['end_days'] . 'd';
                } elseif ($end == 'n-before') {
                    $end = '-' . $element['end_days'] . 'd';
                }

                $this->all_js_files[] = array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js');

                if(!empty($lang)) {

                    $this->all_js_files[] = array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.' . $lang . '.min.js',
                            'charset' => "UTF-8"
                        );
                }

                $js .= "$('#$id').datepicker({
                        format: '$format',
                        startDate: '$start',
                        endDate: '$end',
                        language: '$lang',
                        daysOfWeekDisabled: '$disabled_days',
                        autoclose: true,
                        clearBtn: true
                    });";
                    
                break;

            case 'rating':

                $js = '$("#' . $id . '").rating({';

                if(!empty($element['caption'])){
                
                    $star_captions = 'starCaptions: {';
                    $min = $element['min_value'] + $element['step'];
                    $caption_array = explode(",", $element['caption']);
                    
                    foreach($caption_array as $caption){
                        
                        $star_captions .= "$min: \"$caption\", ";
                        $min = $min +  $element['step'] ;
                    }
                    $star_captions .= '},';
                    
                    $js .=  $star_captions;
                }
                
                if(!empty($element['disable_caption'])){
                    $js .= 'showCaption: false,';
                }

                if(!empty($element['not_rated_caption'])){
                    $js .= 'clearCaption: "' . $element['not_rated_caption'] . '"';
                }

                $js .= '});';

                $this->all_js_files[] = array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.1/js/star-rating.min.js');

                break;
             case 'file_upload':
                $accepted_files = '';
                if(isset($element['allowed_file']) && ($element['allowed_file'] == 1 && (!empty($element['allowed_file_types'])) )){
                    $file_type_arr = array_map('trim', explode(',', $element['allowed_file_types']));
                    $accepted_files = 'acceptedFiles: ".' . implode(',.', $file_type_arr) . '",';
                }
                $max_file_size = 'maxFilesize: 20,';
                if(isset( $element['file_limit'] ) && !empty( $element['file_limit'] )){
                     $max_file_size = 'maxFilesize: ' . $element['file_limit'] . ',';
                }
                 $max_uploads = 'maxFiles: 1,
                                 parallelUploads : 1,';
                if(isset( $element['no_of_files'] ) && !empty( $element['no_of_files'] )){
                    $max_uploads = 'maxFiles: ' . $element['no_of_files'] . ',
                            parallelUploads: ' . $element['no_of_files'] . ',';
                }
                $send_as_attachment = '';
                if(!empty( $element['send_as_attachment'] ) && ($element['send_as_attachment'] == 1 ) ){
                    $send_as_attachment = 'uploadedFiles.push(obj.uploaded_file_name);';
                }
                $js = 'if(!uploadedFiles){
                            var uploadedFiles = [];
                            Dropzone.autoDiscover = false;
                        }
                        $("#' . $id . '").dropzone({
                            url: "library/upload.php",
                            addRemoveLinks: true,
                            ' . $accepted_files . '
                            ' . $max_file_size . '
                            ' . $max_uploads . '
                            init: function() {
                                this.on("removedfile", function(file) {
                                    if( form_submitted === "0" ){
                                        $.ajax({
                                            url: "library/delete_file.php",
                                            data: { "file_name": file.uploaded_as },
                                            type: "POST",
                                        });
                                        
                                        var index = uploadedFiles.indexOf(file.uploaded_as);
                                        if(index!=-1){
                                           uploadedFiles.splice(index, 1);
                                        }
                                        
                                        var elementVal = $(this.element).find(".dropzone_input").val();
                                        var oldVal = elementVal.split(",");
                                        index = oldVal.indexOf(file.uploaded_as);
                                        if(index!=-1){
                                           oldVal.splice(index, 1);
                                        }
                                        var newVal = oldVal.join(",");
                                        $(this.element).find(".dropzone_input").val(newVal);
                                    }
                                });
                            },
                            success: function( file, response ){
                                obj = JSON.parse(response);
                                if( obj.success === 1 ){
                                    ' . $send_as_attachment . '
                                    file.uploaded_as = obj.uploaded_file_name;
                                    
                                    var elementVal = $(this.element).find(".dropzone_input").val();
                                    if( elementVal === ""){
                                        var oldVal = [];
                                    } else {
                                        var oldVal = elementVal.split(",");
                                    }
                                    oldVal.push(obj.uploaded_file_name);
                                    var newVal = oldVal.join(",");
                                    $(this.element).find(".dropzone_input").val(newVal);
                                    return file.previewElement.classList.add("dz-success");
                                } else {
                                    var node, _i, _len, _ref, _results;
                                    var message = obj.msg 
                                    file.previewElement.classList.add("dz-error");
                                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                                    _results = [];
                                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                                      node = _ref[_i];
                                      _results.push(node.textContent = message);
                                    }
                                    return _results;
                                }
                            },
                        });';
                        
                
                $this->all_js_files[] = array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js');
                break;
            default:
                $js = '';
        }
        
        return $js;
    }

    public function jsEnd( $form_data ) {

        $js = $form_data['javascript'];
        
        if($this->final_action == 'view') {
            $js .= PHP_EOL . '          </script>';
        }

        return $js;
    }

    public function jsRecaptcha($form_data) {

        $js = '';

        if(isset( $form_data['enable_recaptcha'] ) 
                && ( $form_data['enable_recaptcha'] == '1' )){

            $js = 'var CaptchaCallback = function(){
                    $(\'.g-recaptcha\').each(function(index, el) {
                        grecaptcha.render(el, {\'sitekey\' : "' . $form_data['site_key'] . '"});
                    });
                };';

            $this->all_js_files[] = array('src' => 'https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit', 'async', 'defer');

        }

        return $js;
    }

}

?>