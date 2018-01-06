$(document).ready(
    function(){
        
        $('[data-toggle="tooltip"]').tooltip();
        
        var i = 0;
        //draggable
        $( ".draggable_text_input, .draggable_text_area" ).draggable({
            cursor: "crosshair",
            cursorAt: { left: 5 },
            helper: function() {
                return $(this).clone().appendTo('body');
            },
        });
        
        //droppable
        $( ".droppable_form" ).droppable({
            activeClass: "ui-state-default",
            hoverClass: "dashed",
            accept: ".draggable_text_input, .draggable_text_area",
            drop: function(event, ui) {
                $('.initial-msg').remove();
                i = i + 1;
                
                if (!ui.draggable.hasClass("dropped")){
                    
                    var type = $(ui.draggable).clone().find('.draggable_input').attr('type');
                    var role = $(ui.draggable).clone().find('.draggable_input').attr('role');
                   
                    if (type == "text" && role == "datepicker") {
                        type="datepicker";
                    }
                    if (type == "checkbox" && role == "tnc") {
                        type="tnc";
                    }
                    if (type == "text" && role == "heading") {
                        type="heading";
                    }
                    
                    var modal_html = generate_modal(i, type);
                    
                    var btn_html = '<div class="col-md-12"><div class="btn-group pull-left hide"><button type="button" class="btn btn-primary btn-edit btn-xs" modal="' + i + '"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button><button type="button" class="btn btn-danger btn-delete btn-xs"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span></button></div></div>';
                
                    $(this).append($(ui.draggable).clone().addClass('dropped field_details_modal_' + i).attr('modal', i));
                    
                    $(this).find('.field_details_modal_' + i).wrap( "<div class='sort'></div>");
                    
                    $(this).find('.field_details_modal_' + i).parent().closest('.sort').append(modal_html);
                    $(this).find('.field_details_modal_' + i).parent().closest('.sort').prepend(btn_html);
                }
                
                $('#field_details_modal_' + i).modal('show');
                
                $( '.btn-edit' ).click(function() {
                    modal_id = "field_details_modal_" + $(this).attr('modal');
                    
                    $('#' + modal_id).modal('show');
                });
                $(".selectpicker").selectpicker('refresh');
                $('.selectpicker').on('changed.bs.select', function () {
                    if( $(this).val() !== '' ){
                         $(this).closest('.modal').find('.input_icon_postion_div').removeClass( 'hide' );
                    } else {
                         $(this).closest('.modal').find('.input_icon_postion_div').addClass( 'hide' );
                    }
                });
                //save modal changes for text and texarea
                $( '.save_changes' ).click(function() {
                    
                    var name = $(this).closest('.modal').find('.field_name').val();
                    
                    if(! check_unique_name($(this).closest('.modal'), name) ){
                        $(this).closest('.modal').find('.field_name').val('').focus();
                        return true;
                    }
                    
                    var id =  $(this).closest('.modal').attr('id');
                    var label = $(this).closest('.modal').find('.field_label').val();
                    
                    
                    if($(this).closest('.modal').find('.required_checkbox').is(":checked")) {
                        label = label + ' <span class="required-field">*</span>';
                    }
                    
                    var input_height = $(this).closest('.modal').find('.input_height').val();
                    set_input_height(id, input_height);
                    
                    var placeholder = $(this).closest('.modal').find('.field_placeholder').val();
                    //set input icon
                   
                    var type = $(this).closest('.modal').find('.input_type').val();
                    if( type == 'text' || type == 'password' ){
                        this_selector = $(this);
                        add_input_icon( this_selector, id);
                    }
                    if( type === 'file_upload' ){
                        var upload_text = $(this).closest('.modal').find('.upload_text').val();
                        $("." + id).find('.upload_text').html(upload_text);
                    }
                    $("." + id).find('label').html(label);
                    $("." + id).find('.draggable_input').attr('placeholder', placeholder);
                    $('#' + id).modal('hide');
                   
                });
                
                //delete element
                $( '.delete_element' ).click(function() {
                    var id =  $(this).closest('.modal').attr('id');
                    $('#' + id).modal('hide');
                    $("." + id).remove();
                    $('#' + id).html('');
                    
                    if($('.dropped').length === 0){
                        $('.panel-footer').addClass('hide');
                    } 
                });
                
                if($('.dropped').length > 0){
                    $('.panel-footer').removeClass('hide');
                } else {
                     $('.panel-footer').addClass('hide');
                }
                
                //add options for select, checkbox and radio
                $( '.add_options' ).off().click(function() {
                    
                    var  modal = $(this).closest('.modal');
                    
                    var modal_index  = modal.find('.modal_index').val();
                    
                    var type = modal.find('.input_type').val();
                    
                    var option_html = '';
                    if(type === "checkbox" || type === "multiple_select"){
                        option_html = '<div class="row field_options"> <div class="form-group"> <div class="col-sm-4"> <input type="text" class="form-control input-sm" name=field[' + modal_index + '][options][] placeholder="Enter option"> </div> <div class="col-sm-4"> <input type="checkbox" class="is_checked" value="">&nbsp;Checked / Selected </div> <div class="col-sm-2"> <button type="button" class="btn btn-danger remove_option"> - </button> </div> </div> </div>';
                        
                    } else {
                        option_html = '<div class="row field_options"> <div class="form-group"> <div class="col-sm-4"> <input type="text" class="form-control input-sm" name=field[' + modal_index + '][options][] placeholder="Enter option"> </div> <div class="col-sm-4"> <input type="radio" name="is_checked_' + modal_index + '" class="is_checked" value="">&nbsp;Checked / Selected </div> <div class="col-sm-2"> <button type="button" class="btn btn-danger remove_option"> - </button> </div> </div> </div>';
                    }

                    modal.find('.options_to_add').append(option_html);
                });
                
                $(document).on('click', '.remove_option', function(){ 
                    $(this).closest('.field_options').remove();
                }); 
                
                //save modal changes for checkbox, select, radio
                $( '.save_element' ).click(function() {
                    var modal = $(this).closest('.modal');
                    
                    var name = modal.find('.field_name').val();
                    
                    if(! check_unique_name(modal, name) ){
                        modal.find('.field_name').val('').focus();
                        return true;
                    }
                    
                    var default_options = [];
                    modal.find('.is_checked').each(function() {
                    if($(this).is(":checked")){
                            def_val =  $(this).closest('.field_options').find('.form-control').val();
                            default_options.push(def_val);
                        }
                    });
                    
                    modal.find('.default_select').val(default_options.join(", "));
                    
                    var id =  modal.attr('id');
                    var label = modal.find('.field_label').val();
                    if(modal.find('.required_checkbox').is(":checked")) {
                        label = label + ' <span class="required-field">*</span>';
                    }
                    form_element_html = '';
                    var type = modal.find('.input_type').val();
                    
                    modal.find('.field_options').each(function() {
                        
                        var op = $(this).find('.form-control').val();
                        var checked = "";
                        
                        if($(this).find('.is_checked').is(":checked")){
                            checked = 'checked';
                            if(type == 'select' || type == 'multiple_select'){
                                checked = 'selected';
                            }
                        }

                        switch( type ){
                            case "radio":       
                                form_element_html += '<input type="radio"' + checked + '> ' + op + '<br>';
                                break;
                            
                            case "checkbox":
                                form_element_html += '<input type="checkbox" ' + checked + '> ' + op + '<br>';
                                break;
                            
                            case "select":
                            case "multiple_select":
                                form_element_html += '<option ' + checked + '> ' + op + '</option>';
                                break;
                        }
                        
                    });
                    if(type == 'select'){
                        var input_height = modal.find('.input_height').val();
                        set_input_height(id, input_height);
                    }
                    $("." + id).find('.form_label').html(label);
                   
                    $('.' + id).find('.form_options').html(form_element_html);
                    $('#' + id).modal('hide');
                   
                });
                
                //save modal changes for date picker
                $( '.save_datepicker' ).click(function() {
                    
                    var id =  $(this).closest('.modal').attr('id');
                    var label = $(this).closest('.modal').find('.field_label').val();
                    
                    var name = $(this).closest('.modal').find('.field_name').val();
                    var this_selector = $(this);
                    add_input_icon( this_selector, id);
                    if(! check_unique_name($(this).closest('.modal'), name) ){
                        $(this).closest('.modal').find('.field_name').val('').focus();
                        return true;
                    }
                    
                    if($(this).closest('.modal').find('.required_checkbox').is(":checked")) {
                        label = label + ' <span class="required-field">*</span>';
                    }
                    
                    var placeholder = $(this).closest('.modal').find('.field_placeholder').val();
                   
                    $("." + id).find('label').html(label);
                    $("." + id).find('.draggable_input').attr('placeholder', placeholder);
                    $('#' + id).modal('hide');
                });
                
                $( '.start_date' ).change(function() {
                    var start_date = $(this).val();
                    
                    if (start_date == 'n-after' || start_date == 'n-before') {
                        $(this).closest('.modal').find('.start_days').removeClass('hide');
                    } else {
                        $(this).closest('.modal').find('.start_days').addClass('hide');
                    }
                });
                
                $( '.end_date' ).change(function() {
                    var end_date = $(this).val();
                    
                    if (end_date == 'n-after' || end_date == 'n-before') {
                        $(this).closest('.modal').find('.end_days').removeClass('hide');
                    } else {
                        $(this).closest('.modal').find('.end_days').addClass('hide');
                    }
                });
                
                //disable space from name field
                $("input.field_name").on({
                    keydown: function(e) {
                      if (e.which === 32)
                        return false;
                    },
                    change: function() {
                      this.value = this.value.replace(/\s/g, "");
                    }
                });
                
                $("input.number").on({
                    keydown: function(e) {
                        if ((e.which < 48 || e.which > 57) && e.which != 8)
                            return false;
                    }
                });
                
                $('.required_checkbox').change(function() {
                    var modal = $(this).closest('.modal');
                    if($(this).is(":checked")) {
                        modal.find('.required_msg').removeClass('hide');
                    } else {
                        modal.find('.required_msg').addClass('hide');
                    }     
                });
                $('.other_validation').change(function() {
                    var modal = $(this).closest('.modal');
                    if($(this).val() !== 'none') {
                        
                        var validation = $(this).val();
                        var error_msg = 'minlength';
                        modal.find('.validation_value :input').val('');
                        if(validation == 'minlength' || validation == 'maxlength' || validation ==
                           'equalto' || validation == 'range'){
                            
                            modal.find('.validation_value').removeClass('hide');
                            
                        } else {
                            
                            modal.find('.validation_value').addClass('hide');
                            
                        }
                        switch(validation){
                            case 'email':
                                error_msg = 'Invalid email.';
                                break;
                            case 'url':
                                error_msg = 'Invalid url.';
                                break;
                            case 'minlength':
                                modal.find('.validation_value :input').attr('placeholder' , 'Enter minimum length in digit.');
                                error_msg = 'Please check minimum length.';
                                break;
                            case 'maxlength':
                                modal.find('.validation_value :input').attr('placeholder' , 'Enter maximum length in digit.');
                                error_msg = 'Please check maximum length.';
                                break;
                            case 'range':
                                modal.find('.validation_value :input').attr('placeholder' , 'Enter ranges separated with with "-". ( Ex: 1-10 )');
                                error_msg = 'Not between range.';
                                break;
                            case 'digits':
                                error_msg = 'Enter digits only.';
                                break;
                            case 'number':
                                error_msg = 'Invalid number.';
                                break;
                            case 'phone':
                                error_msg = 'Invalid phone number.';
                                break;
                            case 'phoneus':
                                error_msg = 'Invalid phone number.';
                                break;
                            case 'creditcard':
                                error_msg = 'Invalid credit card.';
                                break;
                            case 'alphanumeric':
                                error_msg = 'Only alphanumeric characters are allowed.';
                                break;
                            case 'lettersonly':
                                error_msg = 'Only letters are allowed.';
                                break;
                                
                        }
                        modal.find('.custom_msg').removeClass('hide');
                        modal.find('.custom_error_msg').val(error_msg);
                        
                    } else {
                        modal.find('.validation_value').addClass('hide');
                        modal.find('.custom_msg').addClass('hide');
                    }     
                });
                
                //save modal changes for heading
                $( '.save_heading' ).click(function() {
                    
                    var id =  $(this).closest('.modal').attr('id');
                    var heading_text = $(this).closest('.modal').find('.heading_text').val();
                    var heading_type = $(this).closest('.modal').find('.heading_type').val();
                    var font_color = $(this).closest('.modal').find('.font_color').val();
                   
                    $("." + id).html( '<div class="col-sm-12"><' + heading_type + ' style="color: ' + font_color +' !important;">' + heading_text + '</' + heading_type + '></div>');
                    $('#' + id).modal('hide');
                });
                $('.heading_color').colorpicker();
               
            }
        });
        
        $('#form_name').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z0-9_]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
        
            e.preventDefault();
            return false;
        });
        
        //sortable 
        $('.droppable_form').sortable({placeholder: "ui-state-highlight", cursor: "move", opacity: 0.5});
        
        //show available tags for message body
        $( '#email_tab' ).click(function() {
            var name_tags = '';
            var response_to_html = '<select name="auto_response_to" class="form-control">';
            var email_body = '';
            $('.droppable_form').find('.modal').each(function() {
                
                if ($(this).find('.field_name').length > '0' ){
                    name = $(this).find('.field_name').val();
                    this_label = $(this).find('.field_label').val();
                    if(name){
                        if (name_tags !== '') {
                            name_tags += ' , ';
                        }
                        if(this_label === ''){
                            this_label = name;
                        }
                        name_tags += '<span title="click to add" class="name_tags text-primary" tag="__' + name + '__" style="cursor: pointer;"><b> ' + this_label + ' </b></span> ';
                        email_body += this_label + ' : ' + '__' + name + '__\n';
                    }
                    
                    input_type = $(this).find('.input_type').val();
                    if(input_type === 'text'){
                        response_to_html += '<option value="' + name + '">' + this_label + '</option>';
                    }
                }
                
            });
            response_to_html += '</select>';
            
            $('.auto_response_to_div').html(response_to_html);
            
            if(name_tags !== ''){
                $('.help_text').html('Use these input fields, Click to add them: ' + name_tags );
            } else {
                $('.help_text').text('');
            }
            if($('#msg_body').val().trim() === ''){
                $('#msg_body').val(email_body);
            }
        });
        
        $('#enable_recaptcha').change(function() {
            if($(this).is(":checked")) {
                $('#recaptcha_keys').removeClass('hide');
            } else {
                $('#recaptcha_keys').addClass('hide');
            }     
        });
    }
);