language = {'': 'English',
            'ar':'Arabic',
            'az':'Azerbaijani',
            'bg':'Bulgarian',
            'br':'Breton',
            'bs':'Bosnian',
            'ca': 'Catalan',
            'cs': 'Czech',
            'cy': 'Welsh',
            'da': 'Danish',
            'de': 'German',
            'el': 'Greek',
            'eo': 'Esperanto',
            'es': 'Sundanese',
            'et': 'Estonian',
            'eu': 'Basque',
            'fa': 'Persian (Farsi)',
            'fi': 'Finnish',
            'fo': 'Faroese',
            'fr': 'French',
            'fr-CH': 'French (Switzerland)',
            'gl': 'Galician',
            'he': 'Hebrew',
            'hr': 'Croatian',
            'hu': 'Hungarian',
            'hy': 'Armenian',
            'id': 'Indonesian',
            'is': 'Icelandic',
            'it': 'Italian',
            'it-CH': 'Italian (Switzerland)',
            'ja': 'Japanese',
            'ka': 'Georgian',
            'kh': 'Khmer',
            'kk': 'Kazakh',
            'ko': 'Korean',
            'lt': 'Lithuanian',
            'lv': 'Latvian',
            'me': 'Serbian',
            'mk': 'FYRO Macedonian',
            'mn': 'Mongolian',
            'ms': 'Malay',
            'nb': 'Norwegian (Bokm?l)',
            'nl': 'Dutch',
            'nl-BE': 'Dutch (Belgium)',
            'pl': 'Polish',
            'pt-BR': 'Portuguese (Brazil)',
            'pt': 'Portuguese',
            'ro': 'Romanian',
            'rs': 'Serbian',
            'rs-latin': 'Serbian',
            'ru': 'Russian',
            'sk': 'Slovak',
            'sl': 'Slovenian',
            'sq': 'Albanian',
            'sv': 'Swedish',
            'sw': 'Swahili',
            'th': 'Thai',
            'tr': 'Turkish',
            'uk': 'Ukrainian',
            'vi': 'Vietnamese',
            'zh-CN': 'Chinese (S)',
            'zh-TW': 'Chinese (T)',
};
//Check if the name for input field is unique
function check_unique_name(current_modal, current_name) {
    
    if(current_name === ''){
        alert("Name field can not be blank.");
        return false;
    }
    
    var name = '';
    var is_same = false;
    
    $('.droppable_form').find('.modal').not(current_modal).each(function() {
        
        if ($(this).find('.field_name').length > '0' ){
            name = $(this).find('.field_name').val();
            if (name == current_name) {
                is_same = true;
            }
        }
    });
    
    if (is_same) {
        alert("Input field with name '" + current_name + "' already exist, please change it");
        return false;
    } else {
        return true;
    }
}

//generate modal 
function generate_modal(i, type) {
    id = "field_details_modal_" + i;
    switch( type ){
    case "text":
    case "password":
        var icon_options = '';
        
        for (var key in fontawesome_list) {
            if ( fontawesome_list.hasOwnProperty(key) ){
                icon_options += '<option value="' + key + '" data-content="' + fontawesome_list[key] + ' - '+ key + '" ></option>' ;
                //' + fontawesome_list[key] + '
            }
        }
        var other_validation_options = '<option value="none" selected="selected">None</option><option value="email">Email</option><option value="url">URL</option><option value="minlength">Minlength</option> <option value="maxlength">Maxlength</option><option value="digits">Digits</option><option value="number">Number</option><option value="range">Range</option><option value="alphanumeric">Alphanumeric</option><option value="lettersonly">Letters Only</option><option value="phone">Phone</option><option value="phoneus">Phone US</option><option value="creditcard">Credit Card</option>';
        
        if(type == 'password'){
            other_validation_options = '<option value="none" selected="selected">None</option><option value="minlength">Minlength</option> <option value="maxlength">Maxlength</option>';
        }
        var html = '<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Enter field settings</h4></div><div class="modal-body padding-30"><div class="row"><div class="col-md-6"><div class="col-sm-12"><div class="form-group"><label for="name">Name<span class="required-field"> *</span></label><input type="text" name="field[' + i + '][name]" class="form-control field_name input-sm" placeholder="Enter name" value="field_' + i + '"></div><div class="form-group"><label>Label Text</label><input type="text" name="field[' + i + '][label]" class="form-control field_label input-sm" placeholder="Enter Label" value=""></div><div class="form-group"><label for="placeholder">Placeholder</label><input type="text" name="field[' + i + '][placeholder]" class="form-control field_placeholder input-sm" placeholder="Enter Placeholder" value=""><input type="hidden" class="input_type" name="field[' + i + '][type]" value="' + type +'"></div><div class="form-group"><div class="checkbox"><label><input class="required_checkbox" type="checkbox" name="field[' + i + '][required]"> Required</label></div></div><div class="form-group required_msg hide"><label>Error message for required</label><input type="text" class="form-control required_error_msg input-sm" name="field[' + i + '][required_error_msg]" value="This field is required."></div></div></div><div class="col-md-6"><div class="col-sm-12"><div class="form-group"><label>Validation</label><select class="form-control other_validation input-sm" name="field[' + i + '][validation]">' + other_validation_options + '</select></div><div class="form-group validation_value hide"><label>Value for the valiadtion</label><input type="text" class="form-control input-sm" name="field[' + i + '][validation_value]" placeholder=""></div><div class="form-group custom_msg hide"><label>Error message</label><input type="text" class="form-control custom_error_msg input-sm" name="field[' + i + '][custom_error_msg]"></div><div class="form-group"><label>Height</label><input type="number" class="form-control input_height input-sm" name="field[' + i + '][input_size]"placeholder="Enter height in pixel"><p class="help-block">Leave blank for default size (34px).</p></div><div class="form-group"><label>Custom Class</label><input type="text" name="field[' + i + '][custom_class]" class="form-control input-sm" placeholder="Custom classes"><p class="help-block">Comma separated string of classes.Ex: class1,class2,class3 .</p></div><div class="form-group"><label>Add input icon</label><select class="selectpicker" data-live-search="true" name="field[' + i + '][input_icon]"><option value="">None</option>' + icon_options + '</select></div><div class="form-group input_icon_postion_div hide"><label>Position</label><br><label class="radio-inline"><input type="radio" class="icon_position" name="field[' + i + '][input_icon_position]" value="left" checked> Left</label><label class="radio-inline"><input type="radio" class="icon_position" name="field[' + i + '][input_icon_position]" value="right"> Right</label></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger pull-left delete_element">Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-primary save_changes">Save changes</button></div></div></div></div>';
        break;
    case "textarea":
        html = '<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Enter field settings</h4></div><div class="modal-body padding-30"><div class="row"><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><label for="name">Name<span class="required-field"> *</span></label><input type="text" name="field[' + i + '][name]" class="form-control field_name input-sm" placeholder="Enter name" value="field_' + i + '"></div><div class="form-group"><label for="label">Label Text</label><input type="text" name="field[' + i + '][label]" class="form-control field_label input-sm" placeholder="Enter Label" value=""></div><div class="form-group"><label for="placeholder">Placeholder</label><input type="text" name="field[' + i + '][placeholder]" class="form-control field_placeholder input-sm" placeholder="Enter Placeholder" value=""><input type="hidden" name="field[' + i + '][type]" value="' + type +'"></div><div class="form-group"><div class="checkbox"><label><input type="checkbox" class="required_checkbox" name="field[' + i + '][required]"> Required</label></div></div><div class="form-group required_msg hide"><label>Error message for required</label><input type="text" class="form-control required_error_msg input-sm" name="field[' + i + '][required_error_msg]" value="This field is required."></div></div></div><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><label>Custom Class</label> <input type="text" name="field[' + i + '][custom_class]" class="form-control input-sm" placeholder="Custom classes"><p class="help-block">Comma separated string of classes.Ex: class1,class2,class3 .</p></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger pull-left delete_element">Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-primary save_changes">Save changes</button></div></div></div></div>';
    break;
    case "radio":
    case "checkbox":
    case "select":
    case "multiple_select":
        min_checked = '';
        if (type == 'checkbox'){
            min_checked = '<div class="form-group"><label>Validation</label> <select class="form-control other_validation input-sm" name="field[' + i + '][validation]"> <option value="none" selected="selected">None</option><option value="minlength">Minimum checked fields</option></select> </div><div class="form-group validation_value hide"><label>Value for above valiadtion</label><input type="text" class="form-control" name="field[' + i + '][validation_value]" placeholder=""></div><div class="form-group custom_msg hide"><label>Error message</label><input type="text" class="form-control custom_error_msg input-sm" name="field[' + i + '][custom_error_msg]"></div>';
        }
        
        input_size = '';
         if (type == 'select'){
            input_size = '<div class="form-group"><label>Height</label><input type="number" class="form-control input_height input-sm" name="field[' + i + '][input_size]"placeholder="Enter height in pixel"><p class="help-block">Leave blank for default size. (34px)</p></div>';
         }
        
        html = '<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button><h4 class="modal-title">Enter field settings</h4> </div><div class="modal-body padding-30"><div class="row"><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><label for="group_name">Name<span class="required-field"> *</span></label><input type="text" name="field[' + i + '][name]" class="form-control field_name input-sm" placeholder="Enter name" value="field_' + i + '"> </div><div class="form-group"><label for="group_label">Label</label><input type="text" name="field[' + i + '][label]" class="form-control field_label input-sm" placeholder="Enter label"> </div><div class="form-group"><div class="checkbox"><label><input type="checkbox" class="required_checkbox" name="field[' + i + '][required]"> Required</label></div></div><div class="form-group required_msg hide"><label>Error message for required</label><input type="text" class="form-control required_error_msg input-sm" name="field[' + i + '][required_error_msg]" value="This field is required."></div></div></div><div class="col-sm-6"><div class="col-sm-12">' + min_checked + input_size +'<div class="form-group"><label>Custom Class</label><input type="text" name="field[' + i + '][custom_class]" class="form-control input-sm" placeholder="Custom classes"><p class="help-block">Comma separated string of classes.Ex: class1,class2,class3 .</p></div></div></div></div><div class="row"><div class="col-sm-12"><h5>Options <button type="button" class="btn btn-primary add_options"> + </button></h5><div class="options_to_add"><input class="input_type" type="hidden" name="field[' + i + '][type]" value="' + type +'"><input type="hidden" class="modal_index" value="' + i + '"><input class="default_select" type="hidden" name="field[' + i + '][default_select]" value=""></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger pull-left delete_element">Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-primary save_element">Save changes</button></div></div></div></div>';
        break;
    case "datepicker":
        datepicker_lang = '';
        for (var k in language) {
            if (language.hasOwnProperty(k)) {
                datepicker_lang += '<option value="' + k  + '">' + language[k] + '</option>';
            }
        }
        icon_options = '';
        
        for ( key in fontawesome_list) {
            if ( fontawesome_list.hasOwnProperty(key) ){
                icon_options += '<option value="' + key + '" data-content="' + fontawesome_list[key] + ' - '+ key + '" ></option>' ;
            }
        }
        
        html = '<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button><h4 class="modal-title">Enter date field settings</h4></div><div class="modal-body padding-30"><div class="row"><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><label for="group_name">Name<span class="required-field"> *</span></label><input type="text" name="field[' + i + '][name]" class="form-control field_name input-sm" placeholder="Enter name" value="field_' + i + '"> </div><div class="form-group"><label for="group_label">Label</label><input type="text" name="field[' + i + '][label]" class="form-control field_label input-sm" placeholder="Enter label"> </div><div class="form-group"><label for="placeholder">Placeholder</label><input type="text" name="field[' + i + '][placeholder]" class="form-control field_placeholder input-sm" placeholder="Enter Placeholder" value=""><input type="hidden" class="input_type" name="field[' + i + '][type]" value="' + type +'"></div><div class="form-group"><div class="checkbox"><label><input type="checkbox" class="required_checkbox" name="field[' + i + '][required]"> Required</label></div></div><div class="form-group required_msg hide"><label>Error message for required</label><input type="text" class="form-control required_error_msg input-sm" name="field[' + i + '][required_error_msg]" value="This field is required."></div><div class="form-group"><label>Date Format</label><input type="text" name="field[' + i + '][date_format]" class="form-control date_format input-sm" placeholder="Date format" value="mm-dd-yyyy"> <span class="help-block"><b>formats:</b> dd, d, mm, m, yyyy, yy <br/><b>separators:</b> -, /, .</span></div></div></div><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><label for="start_date">Start Date</label><select class="form-control start_date input-sm" name="field[' + i + '][start_date]"><option value="none">None</option><option value="today">Today</option><option value="current_year">Current year</option><option value="current_month">Current Month</option><option value="n-after">n days from today</option><option value="n-before">n days before today</option></select></div><div class="form-group hide start_days"><label for="start_days">Days for start date</label><input type="text" class="form-control number input-sm" name="field[' + i + '][start_days]"></div><div class="form-group"><label for="end_date">End Date</label><select class="form-control end_date input-sm" name="field[' + i + '][end_date]"><option value="none">None</option><option value="today">Today</option><option value="current_year">Current year</option><option value="current_month">Current Month</option><option value="n-after">n days from today</option><option value="n-before">n days before today</option></select></div><div class="form-group hide end_days"><label for="start_days">Days for end date</label><input type="text" class="form-control number input-sm" name="field[' + i + '][end_days]"></div><div class="form-group"><label for="language">Calendar Language</label><select class="form-control input-sm" name="field[' + i + '][datepicker_language]">' + datepicker_lang +'</select></div><div class="form-group"><label>Custom Class</label><input type="text" name="field[' + i + '][custom_class]" class="form-control input-sm" placeholder="Custom classes"><p class="help-block">Comma separated string of classes.Ex: class1,class2,class3 .</p></div><div class="form-group"><label>Add input icon</label><select class="selectpicker" data-live-search="true" name="field[' + i + '][input_icon]"><option value="">None</option>' + icon_options + '</select></div><div class="form-group input_icon_postion_div hide"><label>Position</label><br><label class="radio-inline"><input type="radio" class="icon_position" name="field[' + i + '][input_icon_position]" value="left" checked> Left</label><label class="radio-inline"><input type="radio" class="icon_position" name="field[' + i + '][input_icon_position]" value="right"> Right</label></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label>Disable Days</label><div class="checkbox"><label><input type="checkbox" value=0 name="field[' + i + '][disabled_days][]">Sunday</input></label><label><input type="checkbox" value=1 name="field[' + i + '][disabled_days][]">Monday</input></label><label><input type="checkbox" value=2 name="field[' + i + '][disabled_days][]">Tuesday</input></label><label><input type="checkbox" value=3 name="field[' + i + '][disabled_days][]">Wednesday</input></label><label><input type="checkbox" value=4 name="field[' + i + '][disabled_days][]">Thrusday</input></label><label><input type="checkbox" value=5 name="field[' + i + '][disabled_days][]">Friday</input></label><label><input type="checkbox" value=6 name="field[' + i + '][disabled_days][]">Saturday</input></label></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger pull-left delete_element">Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-primary save_datepicker">Save changes</button></div></div></div></div>';
        break;
    case "tnc":
        html = '<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Enter field settings</h4></div><div class="modal-body padding-30"><div class="row"><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><label for="group_name">Name<span class="required-field"> *</span></label><input type="text" name="field[' + i + '][name]" class="form-control field_name input-sm" placeholder="Enter name" value="field_' + i + '"></div><div class="form-group"><label for="group_label">Label</label><input type="text" name="field[' + i + '][label]" value="Terms & Conditions" class="form-control field_label input-sm" placeholder="Enter label"></div><div class="form-group"><div class="checkbox"><label><input type="checkbox" class="required_checkbox" name="field[' + i + '][required]"> Required</label></div></div><div class="form-group required_msg hide"><label>Error message for required</label><input type="text" class="form-control required_error_msg input-sm" name="field[' + i + '][required_error_msg]" value="This field is required."></div><input class="input_type" type="hidden" name="field[' + i + '][type]" value="' + type +'"></div></div><div class="col-sm-6"><div class="col-sm-12"><div class="form-group tnc_link"><label>Link</label><input type="url" class="form-control input-sm" name="field[' + i + '][tnc_link]" placeholder="Enter link for the label."></div><div class="form-group"><label>Custom Class</label><input type="text" name="field[' + i + '][custom_class]" class="form-control input-sm" placeholder="Custom classes"><p class="help-block">Comma separated string of classes.Ex: class1,class2,class3 .</p></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger pull-left delete_element">Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-primary save_element">Save changes</button></div></div></div></div>';
        break;
    
    case "heading":
        html = '<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Enter field settings</h4></div><div class="modal-body padding-30"><div class="row"><div class="col-md-6"><div class="col-md-12"><div class="form-group"><label for="group_name">Type</label><select class="form-control heading_type input-sm" name="field[' + i + '][heading_type]"><option value="h1" selected="selected">H1</option><option value="h2">H2</option><option value="h3">H3</option><option value="h4">H4</option><option value="h5">H5</option><option value="h6">H6</option><option value="p">Paragraph</option></select></div><div class="form-group"><label>Text</label><input type="text" name="field[' + i + '][heading_text]" class="form-control heading_text input-sm" placeholder="Enter heading text" value="Heading / Paragraph"></div></div></div><div class="col-md-6"><div class="col-md-12"><div class="form-group"><label>Font Color</label><div class="heading_color input-group colorpicker-component"><input name="field[' + i + '][font_color]" type="text" value="#000000" class="form-control font_color input-sm" /><span class="input-group-addon"><i></i></span></div></div><input class="input_type" type="hidden" name="field[' + i + '][type]" value="' + type +'"><div class="form-group"><label>Custom Class</label><input type="text" name="field[' + i + '][custom_class]" class="form-control input-sm" placeholder="Custom classes"><p class="help-block">Comma separated string of classes.Ex: class1,class2,class3 .</p></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger pull-left delete_element">Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-primary save_heading">Save changes</button></div></div></div></div>';
        break;
    case "rating":
        html = '<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Enter field settings</h4></div><div class="modal-body padding-30"><div class="row"><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><label for="name">Name<span class="required-field"> *</span></label><input type="text" name="field[' + i + '][name]" class="form-control field_name input-sm" placeholder="Enter name" value="field_' + i + '"></div><div class="form-group"><label for="label">Label Text</label><input type="text" name="field[' + i + '][label]" class="form-control field_label input-sm" placeholder="Enter Label" value=""></div><div class="form-group"><div class="checkbox"><label><input type="checkbox" class="required_checkbox" name="field[' + i + '][required]"> Required</label></div></div><div class="form-group required_msg hide"><label>Error message for required</label><input type="text" class="form-control required_error_msg input-sm" name="field[' + i + '][required_error_msg]" value="This field is required."></div><div class="form-group"><label for="label">Minimum Value</label><input type="text" name="field[' + i + '][min_value]" class="form-control rating_min input-sm" placeholder="Enter minimum value" value="0"></div><div class="form-group"><label for="label">Maximum Value</label><input type="text" name="field[' + i + '][max_value]" class="form-control rating_max input-sm" placeholder="Enter maximum value" value="5"></div><div class="form-group"><label>Default value</label><input type="text" name="field[' + i + '][default_val]" class="form-control rating_def_val input-sm" placeholder="Enter default value." value="0"></div><div class="form-group"><label>Step</label><input type="text" name="field[' + i + '][step]" class="form-control rating_step input-sm" placeholder="Enter step" value="1"></div></div></div><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><label>Stars</label><input type="text" name="field[' + i + '][stars]" class="form-control rating_stars input-sm" placeholder="Enter number of stars" value="5"></div><div class="form-group"><label>Captions</label><input type="text" name="field[' + i + '][caption]" class="form-control rating_caption input-sm" placeholder="Enter Captions"><p class="help-block">Comma separated string of values.Ex: Not Rated,One Star,Two star,Three star .Leave blank for default caption.</p></div><div class="form-group"><label>Not rated caption</label><input type="text" name="field[' + i + '][not_rated_caption]" class="form-control rating_not_rated input-sm" placeholder="Enter not rated caption."><p class="help-block">Default is "Not Rated".</p></div><div class="form-group"><label for="placeholder">Size</label><select class="form-control rating_size input-sm" name="field[' + i + '][size]"><option value="xs">Extra small</option><option value="sm" selected>Small</option><option value="md">Medium</option><option value="lg">Large</option><option value="xl">Extra large</option></select></div><div class="form-group"><div class="checkbox"><label><input type="checkbox" class="disable_caption" name="field[' + i + '][disable_caption]"> Disable caption</label></div></div><input type="hidden" name="field[' + i + '][type]" value="' + type +'"><div class="form-group"><label>Custom Class</label><input type="text" name="field[' + i + '][custom_class]" class="form-control input-sm" placeholder="Custom classes"><p class="help-block">Comma separated string of classes.Ex: class1,class2,class3 .</p></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger pull-left delete_element">Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-primary save_changes">Save changes</button></div></div></div></div>';
        break;
    case "file_upload":
        html = '<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Enter field settings</h4></div><div class="modal-body padding-30"><div class="row"><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><label for="name">Name<span class="required-field"> *</span></label><input type="text" name="field[' + i + '][name]" class="form-control field_name input-sm" placeholder="Enter name" value="field_' + i + '"></div><div class="form-group"><label for="label">Label Text</label><input type="text" name="field[' + i + '][label]" class="form-control field_label input-sm" placeholder="Enter Label" value=""></div><div class="form-group"><label>Upload Text</label><input type="text" name="field[' + i + '][upload_text]" class="form-control input-sm upload_text" placeholder="Enter upload text" value=""><input type="hidden" class="input_type" name="field[' + i + '][type]" value="' + type +'"></div><div class="form-group"><label>No. of files can be uploaded</label><input type="number" name="field[' + i + '][no_of_files]" class="form-control input-sm" placeholder="Enter number of files to be uploaded" value="1"><p class="help-block">Default is 1</p></div><div class="form-group"><div class="checkbox"><label><input class="required_checkbox" type="checkbox" name="field[' + i + '][required]"> Required</label></div></div><div class="form-group required_msg hide"><label>Error message for required</label><input type="text" class="form-control required_error_msg input-sm" name="field[' + i + '][required_error_msg]" value="This field is required."></div></div></div><div class="col-sm-6"><div class="col-sm-12"><div class="form-group"><div class="checkbox"><label><input type="checkbox" name="field[' + i + '][send_as_attachment]" value="1">Send uploaded file as E-mail attachment</label></div></div><div class="form-group"><label>File size limits </label><input type="number" name="field[' + i + '][file_limit]" class="form-control input-sm" placeholder="Enter file size limit in MB" ><p class="help-block" >Enter file size limit in MB</p></div><div class="form-group"><label>Allowed file types</label><br><label class="radio-inline"><input type="radio" name="field[' + i + '][allowed_file]" value="0" class="file_type_radio" checked> All types</label><label class="radio-inline"><input type="radio" name="field[' + i + '][allowed_file]" value="1" class="file_type_radio"> Specify allowed types</label></div><div class="form-group file_types_div hide"><label>Add file types</label><input type="text" class="form-control file_type_options input-sm" name="field[' + i + '][allowed_file_types]" placeholder="Enter file types"><p class="help-block">Comma separated string of file types.Ex: jpg,png,jpeg</p></div><div class="form-group"><label>Custom Class</label><input type="text" name="field[' + i + '][custom_class]" class="form-control input-sm" placeholder="Custom classes"><p class="help-block">Comma separated string of classes.Ex: class1,class2,class3 </p></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger pull-left delete_element">Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-primary save_changes">Save changes</button></div></div></div></div>';
    }
    
    return html;    
}

 //error message color picker
$('#cp_error_msg').colorpicker();

//required aestrisk color picker
$('#cp_required').colorpicker();

//label color picker
$('#cp_label').colorpicker();

//background color color picker
$('#cp_backgroung').colorpicker();

function set_input_height( modal_id, height){
    
    if( height !== ''){
        $("." + modal_id).find('.draggable_input').css('height', height + 'px');
    } else {
        $("." + modal_id).find('.draggable_input').css('height', '');
    }
}

function post_submit_setting() {
    if( $('input[type=radio][name=post_submit_action]').filter(':checked').val() === 'show_msg' ){
        $('span#redirect_span').hide();
        $('span#show_msg_span').show();
        
    } else if ( $('input[type=radio][name=post_submit_action]').filter(':checked').val() === 'redirect' ){    
        $('span#show_msg_span').hide();
        $('span#redirect_span').show();
    }
}

post_submit_setting();

$('input[type=radio][name=post_submit_action]').change(function() {
    post_submit_setting();
});

$('.droppable_form').on('click', '.btn-delete', function(){
        
    var is_confirmed = confirm("Are you sure to delete the field ?");

    if (is_confirmed) {
        $(this).parents('.sort').remove();
    }
        
});

$(function() {
    $('#label_color').colorpicker().on('changeColor', function(e) {
        $('#label_css_span').html( '<style>.droppable_form .control-label { color : ' + e.color.toString(
            'rgba') +'; }</style>');
    });
});

$(function() {
    $('#required_asterisk_color').colorpicker().on('changeColor', function(e) {
        $('#required_css_span').html( '<style>.droppable_form .required-field { color : ' + e.color.toString(
            'rgba') +'; }</style>');
    });
});

$(function() {
    $('#background_color').colorpicker().on('changeColor', function(e) {
        $('#background_css_span').html( '<style>.droppable_form { background-color : ' + e.color.toString(
            'rgba') +'; }</style>');
    });
});

$('#form_font_size').change(function() {
    if( $(this).val() !== ''){
        $('#font_size_css_span').html( '<style>.droppable_form{ font-size: ' + $(this).val() +'px ; } .modal-content > div { font-size: 15px !important;}</style>');
    } else {
        $('#font_size_css_span').html( '');
    }
});

function add_input_icon( this_element, id ){
    var input_icon = this_element.closest('.modal').find('.selectpicker').val();
    var position = 'left';
    if( this_element.closest('.modal').find(".icon_position:checked").length > 0){
        position = this_element.closest('.modal').find(".icon_position:checked").val();
    }
    if( input_icon !== ''){
        if ( $("." + id).find('.draggable_input').closest('.input-group').length > 0 ) {
            $("." + id).find('.draggable_input').closest('.input-group').find('.input-group-addon').remove();
            $("." + id).find('.draggable_input').unwrap();
        } 
        $("." + id).find('.draggable_input').wrap('<div class="input-group"></div>');
        if(position == 'left'){
            $("." + id).find('.draggable_input').before('<span class="input-group-addon"><i class="fa ' + input_icon + '" aria-hidden="true"></i></span>');
        }
        if(position == 'right'){
            $("." + id).find('.draggable_input').after('<span class="input-group-addon"><i class="fa ' + input_icon + '" aria-hidden="true"></i></span>');
        }
        
    } else {
        if ( $("." + id).find('.draggable_input').closest('.input-group').length > 0 ) {
            $("." + id).find('.draggable_input').closest('.input-group').find('.input-group-addon').remove();
            $("." + id).find('.draggable_input').unwrap();
        } 
    }
}

$(document).ready(function(){
    //delete form
    $('.delete_form').click(function() {
        var sure = confirm("This form will be deleted permanently. \n Are you sure?");
        var form_name = $(this).attr('form_name');
        var t = $(this);
        if (sure) {
            
            $.ajax({
                url: "?page=delete",
                data: { 'form_name': form_name },
                success: function(result){
                    if(result == 'true'){
                        t.closest('tr').remove();
                        $( '.alert' ).removeClass('hide');
                        $( '.alert' ).addClass('alert-success');
                        $( '#msg' ).text('Form deleted successfully.');
                        
                    } else {
                        $( '.alert' ).removeClass('hide');
                        $( '.alert' ).addClass('alert-danger');
                        $( '#msg' ).text('Something went wrong. Please try again.');
                    }
                }
            });
            
        } else {
            return false;
        }
    });
    checkbox_toggle( $('#enable_auto_response'), $('#auto_response_span') );
    checkbox_toggle( $('#enable_smtp'), $('#smtp_settings') );
    $('#enable_auto_response').change(function() {
        checkbox_toggle( $(this), $('#auto_response_span') ); 
    });
    $('#enable_smtp').change(function(){
        checkbox_toggle( $(this), $('#smtp_settings') );
    });
    checkbox_toggle( $('#enable_database'), $('#database_details') );
    $('#enable_database').change(function(){
        checkbox_toggle( $(this), $('#database_details') );
    });
    $('#add_db_column').click( function(){
        var col_index = parseInt($('#column_index').val());
        var field_name_tags = get_name_tags();
        var col_html = '<div class="table_column"><div class="form-group"><div class="col-sm-5"><input type="text" class="form-control db_column_name" placeholder="Enter column name" name="db_data[' + col_index + '][column]"></div><div class="col-sm-5"><input type="text" class="form-control" placeholder="Enter value" name="db_data[' + col_index +'][value]"><p class="help-block help_text">' + field_name_tags + '</p></div><div class="col-sm-2"><button type="button" class="btn btn-danger remove_db_column">-</button></div></div></div>';
        $('#table_columns').append(col_html);
        $('#column_index').val(col_index + 1);
    });
    $("#table_columns").on("click", ".remove_db_column", function(){
        $(this).closest('.table_column').remove();
    });
    $('#database_tab').click( function(){
        var field_name_tags = get_name_tags();
        $("#table_columns").find('.help_text').each( function(){
            $(this).html(field_name_tags);
        });
    });
    $("#table_columns").on("keypress", ".db_column_name", function(e){
        var regex = new RegExp("^[a-zA-Z0-9_]+$");
        if(this.selectionStart===0){
            regex = new RegExp("^[a-zA-Z_]+$");
        }
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
    $("#database_details").on("keypress", "#db_name", function(e){
        var regex = new RegExp("^[a-zA-Z0-9_]+$");
        if(this.selectionStart===0){
            regex = new RegExp("^[a-zA-Z_]+$");
        }
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
    $("#database_details").on("keypress", "#db_table", function(e){
        var regex = new RegExp("^[a-zA-Z0-9_]+$");
        if(this.selectionStart===0){
            regex = new RegExp("^[a-zA-Z_]+$");
        }
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
});
function checkbox_toggle( checkbox, content ){
    if( checkbox.is(":checked") ){
        content.removeClass('hide');
    } else {
        content.addClass('hide');
    }
}
function get_name_tags(){
    var name_tags = '';
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
            }
        }
    });
    return name_tags ;
}
$(document).on("change", ".file_type_radio", function(){
    if($(this).val() === '1' ){
        $(this).closest('.modal').find('.file_types_div').removeClass('hide');
    } else {
        $(this).closest('.modal').find('.file_types_div').addClass('hide');
    }
});

//save form
$( '#save_form' ).click(function() {
    var regex = new RegExp("^[a-zA-Z0-9_]+$");
    if($('#form_name').val().trim() === ''){
        alert('Please enter form name.');
        return false ;
    } else if( !regex.test($('#form_name').val()) ){
        alert('Only alphanumeric values and "_" allowed in the form name.');
        return false ;
    } else if($('#msg_from').val().trim() === ''){
        alert("Please fill From field in Email tab.");
        return false ;
    } else if($('#msg_to').val().trim() === ''){
        alert("Please enter receiver's email in Email tab.");
        return false ;
    } else if($('#msg_sub').val().trim() === ''){
        alert("Email subject is required.");
        return false ;
    } else if($('#msg_body').val().trim() === ''){
        alert("Email body is required.");
        return false ;
    } else if($('#enable_auto_response').is(':checked') && $('#auto_response_from').val().trim() === '' ){
        alert('"Response From" is required.');
        return false ;
    } else if($('#enable_auto_response').is(':checked') && $('#auto_response_body').val().trim() === '' ){
        alert('"Response body" is required.');
        return false ;
    } else if( $('#enable_smtp').is(":checked") &&
              ( ($('#smtp_host').val().trim() === '') ||
               ($('#smtp_username').val().trim() === '') ||
               ($('#smtp_password').val().trim() === '') ||
               ($('#smtp_port').val().trim() === '') ) ){
        alert("Please fill all SMTP settings.");
        return false ;
    } else if( $('#enable_database').is(":checked") &&
              ( ($('#db_host').val().trim() === '') ||
               ($('#db_username').val().trim() === '') ||
               ($('#db_password').val().trim() === '') ||
               ($('#db_table').val().trim() === '') ||
               ($('#db_name').val().trim() === '') ) ){
        alert("Please fill all database details.");
        return false ;
    } else if( $('#enable_recaptcha').is(":checked") &&
              ( ($('#site_key').val().trim() === '') || ($('#secret_key').val().trim() === '') ) ){
        alert("Please fill all reCAPTCHA keys.");
        return false ;
    } else {
        $('form').submit();
    }
});
$(document).on('click','span.name_tags',function(){
    var var_parent_input = $(this).parent().closest('div').find('.form-control');
    var caretPos = var_parent_input[0].selectionStart;
    var textAreaTxt = var_parent_input.val();
    var txtToAdd = $(this).attr('tag');
    var_parent_input.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
});