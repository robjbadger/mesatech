<?php
/**
 * Description of edit.php file
 * Handles editing of form
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Multi purpose form generator, contact form, feedback form, event registration form">
    <meta name="author" content="thewebfosters.com">
    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>Contact Form Generator</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/css/star-rating.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="assets/css/dropzone.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <style>
      .required-field {
        color: red;
      }
    </style>
    <?php
      $form_name = $_GET['form_name'];
      $myfile = fopen( SAVED_FORMS_DIR . $form_name . '.json', "r") or die("Form not found!");

      $file_data = fread($myfile, filesize( SAVED_FORMS_DIR . $form_name . '.json'));
  
      fclose($myfile);
      
      $formData = json_decode($file_data, true);
    ?>
    <span id="required_css_span">
      <style>
        .droppable_form .required-field { color : <?php echo $formData['required_asterisk_color'] ; ?>}
      </style>
    </span>
    <span id="label_css_span">
      <style>
        .droppable_form .control-label { color : <?php echo $formData['label_color'] ; ?> }
      </style>
    </span>
    <span id="background_css_span">
      <style>
        .droppable_form { background-color : <?php echo $formData['background_color'] ; ?> }
      </style>
    </span>
    <span id="font_size_css_span">
      <style>
        .droppable_form { font-size : <?php if(!empty ( $formData['form_font_size'] )) { echo $formData['form_font_size'] . 'px;'; }
        else{ echo '';} ; ?> }
        .modal-content > div { font-size: 15px !important;}
      </style>
    </span>
    <div class="container">
        <div class="spacer"></div>
        <div class="alert alert-dismissable hide">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <span id='msg'></span>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"> <span class="glyphicon glyphicon-info-sign text-danger" data-toggle="tooltip" data-placement="left" title="Drag & Drop fields from Left panel to Right Panel and create the form you want, provide a suitable unique form name, save the form, download the code and use it."></span> <b>Form Fields</b></div>
                    <div class="panel-body">
                      <?php include_once('partials/fields.php'); ?>
                    </div>
                </div>
                <a href="?page=create" class="btn btn-primary">
                  <i class="fa fa-th-list"></i>
                  Create New Form
                </a>
            </div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Edit Form</b></div>
                    <form class="form-horizontal" action="?page=update" method="post">
                      
                      <input type="hidden" name="form_name" id="form_name" value="<?php echo $formData['form_name']; ?>">
                         
                      <div class="panel-body">
                        <!--tab start-->
                        <div>

                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#form" aria-controls="form" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Form</a></li>
                            <li role="presentation"><a href="#email" aria-controls="email" id="email_tab" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Email</a></li>
                            <li role="presentation"><a href="#database" aria-controls="database" id="database_tab" role="tab" data-toggle="tab"><i class="fa fa-database" aria-hidden="true"></i> Database</a></li>
                            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a></li>
                            <li role="presentation"><a href="#additional-js-css" aria-controls="additional-js-css" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Additional JS/CSS</a></li>
                          </ul>
                        
                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active droppable_form" id="form"><br class="ui-sortable-handle">
                            <?php include_once( ASSETS_DIR . 'fontawesome-list.php');
                            ?>

                            <?php                  
                              
                              $i = 0;
                              foreach($formData['field'] as $field){
                                $i = $i + 1 ;
                                switch($field['type']){
                                  case 'text':
                                    ?>
                                    <div class="sort">
                                      <div class="col-md-12">
                                          <div class="btn-group pull-left hide">
                                              <button type="button" class="btn btn-primary btn-edit btn-xs" modal="<?php echo $i; ?>">
                                                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-danger btn-delete btn-xs">
                                                  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                              </button>
                                          </div>
                                      </div>
                                      <div class="form-group ui-draggable ui-draggable-handle dropped field_details_modal_<?php echo $i; ?>" modal="<?php echo $i; ?>">
                                        <div class="col-md-12">
                                          <label class="col-sm-2 control-label"><?php echo $field['label'];
                                          if(isset($field['required']) && ($field['required'] == 'on'))
                                          echo ' <span class="required-field">*</span>'; ?></label>
                                          <div class="col-sm-10">
                                            <?php
                                              if(! empty( $field['input_icon'] ) ){
                                                  echo '<div class="input-group">';
                                                  if( $field['input_icon_position'] == 'left'){
                                                      echo '<span class="input-group-addon"><i class="fa '. $field['input_icon'] . '" aria-hidden="true"></i></span>';
                                                  }
                                              }
                                            ?>
                                              <input type="text" class="form-control draggable_input" placeholder="<?php echo $field['placeholder']; ?>" <?php if(!empty($field['input_size']))
                                              echo 'style="height: ' . $field['input_size'] . 'px;"' ; ?>>
                                              <?php
                                              if(! empty( $field['input_icon'] ) ){
                                                if( $field['input_icon_position'] == 'right'){
                                                      echo '<span class="input-group-addon"><i class="fa '. $field['input_icon'] . '" aria-hidden="true"></i></span>';
                                                  }
                                                  echo '</div>';
                                                  
                                              }
                                            ?>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal fade" id="field_details_modal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                           style="display: none;">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Enter field settings</h4>
                                                  </div>
                                                  <div class="modal-body padding-30">
                                                    <div class="row">
                                                      <div class="col-md-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                            <label for="name">Name<span class="required-field"> *</span></label>
                                                            <input type="text" name="field[<?php echo $i; ?>][name]" class="form-control field_name input-sm"
                                                            placeholder="Enter name" value="<?php echo $field['name']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="label">Label Text</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][label]" class="form-control field_label input-sm" placeholder="Enter Label" value="<?php echo $field['label']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="placeholder">Placeholder</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][placeholder]" class="form-control field_placeholder input-sm" placeholder="Enter Placeholder" value="<?php echo $field['placeholder']; ?>">
                                                            <input type="hidden" class="input_type" name="field[<?php echo $i; ?>][type]" value="text">
                                                          </div>
                                                          <div class="form-group">
                                                            <div class="checkbox">
                                                              <label><input class="required_checkbox" type="checkbox" name="field[<?php echo $i; ?>][required]"
                                                              <?php if(isset($field['required']) && ($field['required'] == 'on')) echo "checked"; ?>> Required</label>
                                                            </div>
                                                          </div>
                                                          <div class="form-group required_msg">
                                                            <label>Error message for required</label>
                                                            <input type="text" class="form-control required_error_msg input-sm" name="field[<?php echo $i; ?>][required_error_msg]" value="<?php echo $field['required_error_msg']; ?>">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                            <label>Validation</label>
                                                            <select class="form-control other_validation input-sm"
                                                                    name="field[<?php echo $i; ?>][validation]">
                                                              <option value="none" <?php if($field['validation'] == 'none') echo "selected"; ?>>None</option>
                                                              <option value="email" <?php if($field['validation'] == 'email') echo "selected"; ?>>Email</option>
                                                              <option value="url" <?php if($field['validation'] == 'url') echo "selected"; ?>>URL</option>
                                                              <option value="minlength" <?php if($field['validation'] == 'minlength') echo "selected"; ?>>Minlength</option>
                                                              <option value="maxlength" <?php if($field['validation'] == 'maxlength') echo "selected"; ?>>Maxlength</option>
                                                              <option value="digits" <?php if($field['validation'] == 'digits') echo "selected"; ?>>Digits</option>
                                                              <option value="number" <?php if($field['validation'] == 'number') echo "selected"; ?>>Number</option>
                                                              <option value="range" <?php if($field['validation'] == 'range') echo "selected"; ?>>Range</option>
                                                              <option value="alphanumeric"
                                                                      <?php if($field['validation'] == 'alphanumeric') echo "selected"; ?>>Alphanumeric</option>
                                                              <option value="lettersonly"
                                                                      <?php if($field['validation'] == 'lettersonly') echo "selected"; ?>>Letters Only</option>
                                                              <option value="phone" <?php if($field['validation'] == 'phone') echo "selected"; ?>>Phone</option>
                                                              <option value="phoneus" <?php if($field['validation'] == 'phoneus') echo "selected"; ?>>Phone US</option>
                                                              <option value="creditcard" <?php if($field['validation'] == 'creditcard') echo "selected"; ?>>Credit Card</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group validation_value <?php
                                                        if( !(($field['validation'] == 'minlength') || ($field['validation'] == 'maxlength') || ($field['validation'] == 'range') )) echo 'hide'; ?>">
                                                          <label>Value for above valiadtion</label>
                                                          <input type="text" class="form-control input-sm" name="field[<?php echo $i; ?>][validation_value]" placeholder="" value="<?php echo $field['validation_value']; ?>">
                                                        </div>
                                                        <div class="form-group custom_msg hide">
                                                          <label>Error message</label>
                                                          <input type="text" class="form-control custom_error_msg input-sm"
                                                                 name="field[<?php echo $i; ?>][custom_error_msg]"
                                                          value="<?php echo $field['custom_error_msg']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Height</label>
                                                            <input type="number" class="form-control input_height input-sm"
                                                                   name="field[<?php echo $i; ?>][input_size]"
                                                                   placeholder="Enter height in pixel" value="<?php echo $field['input_size']; ?>">
                                                            <p class="help-block">Leave blank for default size. (34px)</p>
                                                          
                                                        </div>
                                                        <div class="form-group">
                                                          <label>Custom Class</label>
                                                          <input type="text" name="field[<?php echo $i; ?>][custom_class]"
                                                                 class="form-control input-sm" value="<?php echo $field['custom_class']; ?>"
                                                                 placeholder="Custom classes">
                                                          <p class="help-block">
                                                            Comma separated string of classes.Ex: class1,class2,class3 .
                                                          </p>
                                                        </div>
                                    
                                                        <div class="form-group">
                                                          <label>Add input icon</label>
                                                          <select class="selectpicker" data-live-search="true" name="field[<?php echo $i; ?>][input_icon]">
                                                            <option value="" <?php if( !empty( $field['input_icon'] ) && ($field['input_icon'] == '') ) echo "checked"; ?> >None</option>
                                                            <?php
                                                            foreach( $fontawesome_list as $key => $val){
                                                               $checked = '';
                                                               if( !empty( $field['input_icon'] ) && ( $field['input_icon'] == $key ) ){
                                                                  $checked = 'selected';
                                                               }
                                                               echo '<option value="' . $key . '" data-content="' . $val . ' - '. $key . '" ' . $checked . '></option>';
                                                              } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group input_icon_postion_div <?php if( $field['input_icon'] == '' ) echo "hide"; ?>">
                                                          <label>Position</label>
                                                          <br><label class="radio-inline">
                                                          <input type="radio" class="icon_position" name="field[<?php echo $i; ?>][input_icon_position]"
                                                                 value="left" <?php if( !empty( $field['input_icon_position'] ) && ($field['input_icon_position'] != 'right') ) { echo "checked"; }
                                                                 if( empty($field['input_icon_position'])) echo 'checked'; ?>> Left</label><label class="radio-inline">
                                                          <input type="radio" class="icon_position" name="field[<?php echo $i; ?>][input_icon_position]"
                                                                 value="right" <?php if( !empty( $field['input_icon_position'] ) && ( $field['input_icon_position'] == 'right' ) ) echo "checked"; ?>> Right</label>
                                                        </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger pull-left delete_element">Delete</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary save_changes">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <?php
                                    break;
                                  case 'textarea':
                                    ?>
                                    <div class="sort">
                                      <div class="col-md-12">
                                          <div class="btn-group pull-left hide">
                                              <button type="button" class="btn btn-primary btn-edit btn-xs" modal="<?php echo $i; ?>">
                                                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-danger btn-delete btn-xs">
                                                  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                              </button>
                                          </div>
                                      </div>
                                      <div class="form-group ui-draggable ui-draggable-handle dropped field_details_modal_<?php echo $i; ?>" modal="<?php echo $i; ?>">
                                        <div class="col-sm-12">
                                          <label class="col-sm-2 control-label"><?php echo $field['label'];
                                          if(isset($field['required']) && ($field['required'] == 'on'))
                                          echo ' <span class="required-field">*</span>';?></label>
                                          <div class="col-sm-10">
                                              <textarea type="textarea" class="form-control draggable_input"  placeholder="<?php echo $field['placeholder']; ?>"></textarea>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal fade" id="field_details_modal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Enter field settings</h4>
                                                  </div>
                                                  <div class="modal-body padding-30">
                                                    <div class="row">
                                                      <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                              <label for="name">Name<span class="required-field"> *</span></label>
                                                              <input type="text" name="field[<?php echo $i; ?>][name]" class="form-control field_name input-sm" placeholder="Enter name" value="<?php echo $field['name']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="label">Label Text</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][label]" class="form-control field_label input-sm" placeholder="Enter Label" value="<?php echo $field['label']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="placeholder">Placeholder</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][placeholder]" class="form-control field_placeholder input-sm" placeholder="Enter Placeholder" value="<?php echo $field['placeholder']; ?>">
                                                              <input type="hidden" name="field[<?php echo $i; ?>][type]" value="textarea">
                                                          </div>
                                                          <div class="form-group">
                                                              <div class="checkbox">
                                                                  <label><input type="checkbox" class="required_checkbox" name="field[<?php echo $i; ?>][required]"
                                                                  <?php if(isset($field['required']) && ($field['required'] == 'on')) echo "checked"; ?>> Required</label>
                                                              </div>
                                                          </div>
                                                          <div class="form-group required_msg">
                                                              <label>Error message for required</label>
                                                              <input type="text" class="form-control required_error_msg input-sm" name="field[<?php echo $i; ?>][required_error_msg]" value="<?php echo $field['required_error_msg']; ?>">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                          
                                                          <div class="form-group">
                                                            <label>Custom Class</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][custom_class]"
                                                                   class="form-control input-sm" value="<?php echo $field['custom_class']; ?>" placeholder="Custom classes">
                                                            <p class="help-block">
                                                              Comma separated string of classes.Ex: class1,class2,class3 .
                                                            </p>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-danger pull-left delete_element">Delete</button>
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                      <button type="button" class="btn btn-primary save_changes">Save changes</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <?php
                                    break;
                                  case 'radio':
                                  case 'checkbox':
                                  case 'select':
                                  case 'multiple_select':
                                  ?>
                                  <div class="sort">
                                    <div class="col-md-12">
                                      <div class="btn-group pull-left hide">
                                        <button type="button" class="btn btn-primary btn-edit btn-xs" modal="<?php echo $i; ?>">
                                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-delete btn-xs">
                                          <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button>
                                      </div>
                                      </div>
                                    <div class="form-group ui-draggable ui-draggable-handle dropped field_details_modal_<?php echo $i; ?>" modal="<?php echo $i; ?>">
                                      <div class="col-md-12">
                                        <label class="col-sm-2 control-label form_label"><?php echo $field['label'];
                                        if(isset($field['required']) && ($field['required'] == 'on'))
                                          echo ' <span class="required-field">*</span>';?></label>
                                        <div class="col-sm-10">
                                            <?php
                                            $default = array();
                                            if(isset($field['default_select'])){
                                                $default = explode(", ", $field['default_select']);
                                            }
                                            if($field['type'] == 'checkbox' || $field['type'] == 'radio'){
                                                echo '<div class="' . $field['type'] . ' form_options">';
                                                foreach($field['options'] as $option){
                                                    $checked = "";
                                                    if (in_array($option, $default)) {
                                                        $checked = "checked";
                                                    }
                                                    
                                                    echo '<input type="' . $field['type'] . '" ' . $checked . '> ' . $option . '<br>';
                                                    
                                                }
                                                echo "</div>";
                                            } elseif($field['type'] == 'select'){
                                              $input_size = '';
                                              if(!empty($field['input_size'])){
                                                $input_size = 'style="height: ' . $field['input_size'] . 'px;"';
                                              }
                                                echo '<select class="form-control draggable_input form_options" type="' . $field['type'] . '" ' . $input_size . '>';
                                                foreach($field['options'] as $option){
                                                    $checked = "";
                                                    if (in_array($option, $default)) {
                                                        $checked = "selected";
                                                    }
                                                    
                                                    echo '<option ' . $checked . '> ' . $option . '</option>';
                                                    
                                                }
                                                echo "</select>";
                                            } elseif($field['type'] == 'multiple_select'){
                                                echo '<select class="form-control draggable_input form_options" type="' . $field['type'] . '" multiple>';
                                                foreach($field['options'] as $option){
                                                    $checked = "";
                                                    if (in_array($option, $default)) {
                                                        $checked = "selected";
                                                    }
                                                    
                                                    echo '<option ' . $checked . '> ' . $option . '</option>';
                                                    
                                                }
                                                echo "</select>";
                                            }
                                            ?>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal fade" id="field_details_modal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title">Enter field settings</h4>
                                                </div>
                                                <div class="modal-body padding-30">
                                                  <div class="row">
                                                    <div class="col-sm-6">
                                                      <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="group_name">Name<span class="required-field"> *</span></label>
                                                            <input type="text" name="field[<?php echo $i; ?>][name]" class="form-control field_name input-sm" placeholder="Enter name" value="<?php echo $field['name']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="group_label">Label</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][label]" class="form-control field_label input-sm" placeholder="Enter label"
                                                            value="<?php echo $field['label']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label><input type="checkbox" class="required_checkbox" name="field[<?php echo $i; ?>][required]"
                                                                <?php if(isset($field['required']) && ($field['required'] == 'on')) echo "checked"; ?>> Required</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group required_msg">
                                                            <label>Error message for required</label>
                                                            <input type="text" class="form-control required_error_msg input-sm" name="field[<?php echo $i; ?>][required_error_msg]"
                                                            value="<?php echo $field['required_error_msg']; ?>">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                      <div class="col-sm-12">
                                                        <?php
                                                        if($field['type'] == 'checkbox'){ ?>
                                                        
                                                          <div class="form-group">
                                                            <label>Validation</label>
                                                            <select class="form-control other_validation"
                                                                    name="field[<?php echo $i; ?>][validation]">
                                                              <option value="none"
                                                              <?php if($field['validation'] == 'none') echo "selected"; ?>>None</option>
                                                              <option value="minlength"
                                                              <?php if($field['validation'] == 'minlength') echo "selected"; ?>>Minimum checked fields</option>
                                                            </select>
                                                          </div>
                                                          <div class="form-group validation_value <?php if($field['validation'] != 'minlength') echo 'hide'; ?>">
                                                            <label>Value for above valiadtion</label>
                                                            <input type="text" class="form-control"
                                                                   name="field[<?php echo $i; ?>][validation_value]" placeholder=""
                                                                   value="<?php echo $field['validation_value']; ?>">
                                                          </div>
                                                          <div class="form-group custom_msg <?php if($field['validation'] != 'minlength') echo 'hide'; ?>">
                                                            <label>Error message</label>
                                                            <input type="text" class="form-control custom_error_msg"
                                                                   name="field[<?php echo $i; ?>][custom_error_msg]"  value="<?php echo $field['custom_error_msg']; ?>">
                                                          </div>
                                                          
                                                        <?php }
                                                        
                                                        ?>
                                                        <?php
                                                          if($field['type'] == 'select'){ ?>
                                                          
                                                          <div class="form-group">
                                                            <label>Height</label>
                                                            <input type="number" class="form-control input_height input-sm"
                                                               name="field[<?php echo $i; ?>][input_size]"
                                                               placeholder="Enter height in pixel" value="<?php echo $field['input_size']; ?>">
                                                                <p class="help-block">Leave blank for default size. (34px)</p>
                                                            </div>
                                                            
                                                          <?php }
                                                          ?>
                                                          <div class="form-group">
                                                              <label>Custom Class</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][custom_class]"
                                                                     class="form-control" value="<?php echo $field['custom_class']; ?>" placeholder="Custom classes">
                                                              <p class="help-block">
                                                                Comma separated string of classes.Ex: class1,class2,class3 .
                                                              </p>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-sm-12">
                                                      <h5>Options <button type="button" class="btn btn-primary add_options"> + </button></h5>
                                                      <div class="options_to_add">
                                                          <input class="input_type" type="hidden" name="field[<?php echo $i; ?>][type]"
                                                          value="<?php echo $field['type']; ?>">
                                                          <input type="hidden" class="modal_index" value="<?php echo $i; ?>">
                                                          <input class="default_select" type="hidden" name="field[<?php echo $i; ?>][default_select]"
                                                          value="<?php echo $field['default_select']; ?>">
                                                          <?php
                                                          if( $field['type'] == 'checkbox' || $field['type'] == 'multiple_select'){
                                                            if( !empty($field['options']) ){
                                                              foreach($field['options'] as $option){
                                                                  $checked = "";
                                                                  if (in_array($option, $default)) {
                                                                      $checked = "checked";
                                                                  }
                                                                  
                                                                  echo '<div class="row field_options"> <div class="form-group"> <div class="col-sm-4"> <input type="text" class="form-control input-sm" name=field[' . $i . '][options][] placeholder="Enter option" value="' . $option . '"> </div> <div class="col-sm-4"> <input type="checkbox" class="is_checked" value="" ' . $checked . '>&nbsp;Checked / Selected </div> <div class="col-sm-2"> <button type="button" class="btn btn-danger remove_option"> - </button> </div> </div> </div>';
                                                                  
                                                              } 
                                                            } 
                                                          } else {
                                                             if( !empty($field['options']) ){
                                                              foreach($field['options'] as $option){
                                                                $checked = "";
                                                                if (in_array($option, $default)) {
                                                                    $checked = "checked";
                                                                }
                                                                
                                                                echo '<div class="row field_options"> <div class="form-group"> <div class="col-sm-4"> <input type="text" class="form-control input-sm" name=field[' . $i . '][options][] placeholder="Enter option" value="' . $option . '"> </div> <div class="col-sm-4"> <input type="radio" name="is_checked_' . $i . '" class="is_checked" ' . $checked . '>&nbsp;Checked / Selected </div> <div class="col-sm-2"> <button type="button" class="btn btn-danger remove_option"> - </button> </div> </div> </div>';
                                                              }
                                                             }  
                                                          }
                                                          ?>
                                                      </div>
                                                    </div>
                                                  </div>                                                   
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger pull-left delete_element">Delete</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary save_element">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <?php
                                  break;
                                case 'datepicker': ?>
                                
                                  <div class="sort">
                                    <div class="col-md-12">
                                        <div class="btn-group pull-left hide">
                                          <button type="button" class="btn btn-primary btn-edit btn-xs" modal="<?php echo $i; ?>">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                          </button>
                                          <button type="button" class="btn btn-danger btn-delete btn-xs">
                                            <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                          </button>
                                        </div>
                                      </div>
                                      <div class="form-group ui-draggable ui-draggable-handle dropped field_details_modal_<?php echo $i; ?>" modal="<?php echo $i; ?>">
                                        <div class="col-md-12">
                                          <label class="col-sm-2 control-label"><?php echo $field['label']; if(isset($field['required']) && ($field['required'] == 'on'))
                                          echo ' <span class="required-field">*</span>';?></label>
                                          <div class="col-sm-10">
                                            <?php
                                              if(! empty( $field['input_icon'] ) ){
                                                    echo '<div class="input-group">';
                                                    if( $field['input_icon_position'] == 'left'){
                                                        echo '<span class="input-group-addon"><i class="fa '. $field['input_icon'] . '" aria-hidden="true"></i></span>';
                                                    }
                                                }
                                              ?>
                                              <input type="text" readonly=true class="form-control draggable_input" placeholder="<?php echo $field['placeholder']; ?>">
                                              <?php
                                              if(! empty( $field['input_icon'] ) ){
                                              
                                                if( $field['input_icon_position'] == 'right'){
                                                      echo '<span class="input-group-addon"><i class="fa '. $field['input_icon'] . '" aria-hidden="true"></i></span>';
                                                  }
                                                  echo '</div>';
                                              }
                                            ?>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal fade" id="field_details_modal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                           style="display: none;">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Enter date field settings</h4>
                                                  </div>
                                                  <div class="modal-body padding-30">
                                                    <div class="row">
                                                      <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                              <label for="name">Name<span class="required-field"> *</span></label>
                                                              <input type="text" name="field[<?php echo $i; ?>][name]" class="form-control field_name input-sm"
                                                              placeholder="Enter name" value="<?php echo $field['name']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="group_label">Label</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][label]" class="form-control field_label input-sm" placeholder="Enter label"
                                                              value="<?php echo $field['label']; ?>">
                                                          </div>                                                   
                                                          <div class="form-group">
                                                            <label for="placeholder">Placeholder</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][placeholder]"
                                                              class="form-control field_placeholder input-sm"
                                                              placeholder="Enter Placeholder" value="<?php echo $field['placeholder']; ?>">
                                                              <input type="hidden" name="field[<?php echo $i; ?>][type]" value="<?php echo $field['type']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                            <div class="checkbox">
                                                                <label><input type="checkbox" class="required_checkbox" name="field[<?php echo $i; ?>][required]"
                                                                <?php if(isset($field['required']) && ($field['required'] == 'on')) echo "checked"; ?>> Required</label>
                                                            </div>
                                                          </div>
                                                          <div class="form-group required_msg">
                                                              <label>Error message for required</label>
                                                              <input type="text" class="form-control required_error_msg input-sm" name="field[<?php echo $i; ?>][required_error_msg]" value="<?php echo $field['required_error_msg']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                            <label>Date Format</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][date_format]"
                                                              class="form-control date_format input-sm"
                                                                placeholder="Date format" value="<?php echo $field['date_format']; ?>">
                                                            <span class="help-block"><b>formats:</b> dd, d, mm, m, yyyy, yy <br/><b>separators:</b> -, /, .</span>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                            <label for="start_date">Start Date</label>
                                                              <select class="form-control start_date input-sm"
                                                                      name="field[<?php echo $i; ?>][start_date]">
                                                                <option value="none" <?php if($field['start_date'] == 'none') echo 'selected' ?> >None</option>
                                                                <option value="today" <?php if($field['start_date'] == 'today') echo 'selected' ?>>Today</option>
                                                                <option value="current_year" <?php if($field['start_date'] == 'current_year') echo 'selected' ?>>Current year</option>
                                                                <option value="current_month" <?php if($field['start_date'] == 'current_month') echo 'selected' ?>>Current Month</option>
                                                                <option value="n-after" <?php if($field['start_date'] == 'n-after') echo 'selected' ?>>n days from today</option>
                                                                <option value="n-before" <?php if($field['start_date'] == 'n-before') echo 'selected' ?>>n days before today</option>
                                                              </select>
                                                          </div>
                                                          <div class="form-group start_days <?php if($field['start_date'] != 'n-before' && $field['start_date'] != 'n-after') echo 'hide' ?>">
                                                            <label for="start_days">Days for start date</label>
                                                            <input type="text" class="form-control number input-sm" name="field[<?php echo $i; ?>][start_days]" value="<?php echo $field['start_days']; ?>">
                                                          </div>
                                                          
                                                          <div class="form-group">
                                                            <label for="start_date">End Date</label>
                                                              <select class="form-control end_date input-sm"
                                                                      name="field[<?php echo $i; ?>][end_date]">
                                                                <option value="none" <?php if($field['end_date'] == 'none') echo 'selected' ?> >None</option>
                                                                <option value="today" <?php if($field['end_date'] == 'today') echo 'selected' ?>>Today</option>
                                                                <option value="current_year" <?php if($field['end_date'] == 'current_year') echo 'selected' ?>>Current year</option>
                                                                <option value="current_month" <?php if($field['end_date'] == 'current_month') echo 'selected' ?>>Current Month</option>
                                                                <option value="n-after" <?php if($field['end_date'] == 'n-after') echo 'selected' ?>>n days from today</option>
                                                                <option value="n-before" <?php if($field['end_date'] == 'n-before') echo 'selected' ?>>n days before today</option>
                                                              </select>
                                                          </div>
                                                          <div class="form-group end_days <?php if($field['end_date'] != 'n-before' && $field['end_date'] != 'n-after') { echo 'hide' ;}?>">
                                                            <label for="start_days">Days for start date</label>
                                                            <input type="text" class="form-control number input-sm" name="field[<?php echo $i; ?>][end_days]" value="<?php echo $field['end_days']; ?>">
                                                          </div>
                                                          
                                                          <div class="form-group"> <label for="language">Calendar Language</label>
                                                          <?php
                                                            $langFile = fopen( ASSETS_DIR . 'date-picker-lang.json',
                                                                            "r") or die("Unable to open file!");
    
                                                                $lang_file_data = fread( $langFile, filesize( ASSETS_DIR . 'date-picker-lang.json'));
                                                          
                                                              fclose( $langFile );
                                                              
                                                              $languages = json_decode($lang_file_data, true);
                                                            ?>
                                                            <select class="form-control input-sm" name="field[<?php echo $i; ?>][datepicker_language]">
                                                            
                                                              <?php
                                                                foreach($languages['languages'] as $key => $val){
                                                                  $selected = '';
                                                                  if($field['datepicker_language'] == $key){
                                                                    $selected = 'selected';
                                                                  }
                                                                  echo '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
                                                                }
                                                              ?>
                                                            </select>
                                                          </div>
                                                          <div class="form-group">
                                                            <label>Custom Class</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][custom_class]"
                                                                   class="form-control input-sm" value="<?php echo $field['custom_class']; ?>" placeholder="Custom classes">
                                                            <p class="help-block">
                                                              Comma separated string of classes.Ex: class1,class2,class3 .
                                                            </p>
                                                          </div>
                                                          <div class="form-group">
                                                            <label>Add input icon</label>
                                                            <select class="selectpicker" data-live-search="true" name="field[<?php echo $i; ?>][input_icon]">
                                                              <option value="" <?php if( !empty( $field['input_icon'] ) && ( $field['input_icon'] == '' ) ) echo "checked"; ?> >None</option>
                                                              <?php foreach( $fontawesome_list as $key => $val){
                                                                 $checked = '';
                                                                 if( !empty( $field['input_icon'] ) && ( $field['input_icon'] == $key ) ){
                                                                    $checked = 'selected';
                                                                 }
                                                                 echo '<option value="' . $key . '" data-content="' . $val . ' - '. $key . '" ' . $checked . '></option>';
                                                                } ?>
                                                              </select>
                                                          </div>
                                                          <div class="form-group input_icon_postion_div <?php if($field['input_icon'] == '' ) echo "hide"; ?>">
                                                            <label>Position</label>
                                                            <br><label class="radio-inline">
                                                            <input type="radio" class="icon_position" name="field[<?php echo $i; ?>][input_icon_position]"
                                                                 value="left" <?php if( !empty( $field['input_icon_position'] ) && ($field['input_icon_position'] != 'right') ) { echo "checked"; }
                                                                 if( empty($field['input_icon_position'])) echo 'checked'; ?>> Left</label><label class="radio-inline">
                                                            <input type="radio" class="icon_position" name="field[<?php echo $i; ?>][input_icon_position]"
                                                                 value="right" <?php if( !empty( $field['input_icon_position'] ) && ( $field['input_icon_position'] == 'right' ) ) echo "checked"; ?>> Right</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-sm-12">
                                                        <div class="form-group">
                                                          <label>Disable Days</label>
                                                          <div class="checkbox"> <label><input type="checkbox" value=0 name="field[<?php echo $i; ?>][disabled_days][]" <?php if(isset($field['disabled_days']) && in_array(0, $field['disabled_days'])) {echo 'checked';} ?> >Sunday</input> </label><label><input type="checkbox" value=1 name="field[<?php echo $i; ?>][disabled_days][]" <?php if( isset($field['disabled_days']) && in_array(1, $field['disabled_days'])) {echo 'checked';} ?>>Monday</input> </label><label><input type="checkbox" value=2 name="field[<?php echo $i; ?>][disabled_days][]" <?php if(isset($field['disabled_days']) && in_array(2, $field['disabled_days'])) {echo 'checked';} ?>>Tuesday</input> </label><label><input type="checkbox" value=3 name="field[<?php echo $i; ?>][disabled_days][]" <?php if(isset($field['disabled_days']) && in_array(3, $field['disabled_days'])) {echo 'checked';} ?>>Wednesday</input> </label><label><input type="checkbox" value=4 name="field[<?php echo $i; ?>][disabled_days][]" <?php if(isset($field['disabled_days']) && in_array(4, $field['disabled_days'])) {echo 'checked';} ?>>Thrusday</input> </label><label><input type="checkbox" value=5 name="field[<?php echo $i; ?>][disabled_days][]" <?php if(isset($field['disabled_days']) && in_array(5, $field['disabled_days'])) {echo 'checked';} ?>>Friday</input> </label><label><input type="checkbox" value=6 name="field[<?php echo $i; ?>][disabled_days][]" <?php if(isset($field['disabled_days']) && in_array(6, $field['disabled_days'])) {echo 'checked';} ?>>Saturday</input> </label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                              
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger pull-left delete_element">Delete</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary save_datepicker">Save changes</button>
                                                </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                <?php
                                break;
                              case "tnc":
                                ?>                     
                                <div class="sort">
                                  <div class="col-md-12">
                                    <div class="btn-group pull-left hide">
                                      <button type="button" class="btn btn-primary btn-edit btn-xs" modal="<?php echo $i; ?>">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                      </button>
                                      <button type="button" class="btn btn-danger btn-delete btn-xs">
                                        <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="form-group  ui-draggable ui-draggable-handle dropped
                                    field_details_modal_<?php echo $i; ?>" modal="<?php echo $i; ?>">
                                    <div class="col-md-12">
                                      <div class="checkbox col-sm-10 col-sm-offset-2">
                                        <label><input class="draggable_input" type="checkbox" role="tnc">
                                        <span class="form_label"><?php echo $field['label'];
                                            if(isset($field['required']) && ($field['required'] == 'on'))
                                            echo ' <span class="required-field">*</span>';?></span>
                                        </label>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="modal fade" id="field_details_modal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                          </button>
                                          <h4 class="modal-title">Enter field settings</h4>
                                        </div>
                                        <div class="modal-body padding-30">
                                          <div class="row">
                                            <div class="col-sm-6">
                                              <div class="col-sm-12">
                                                <div class="form-group">
                                                  <label for="group_name">Name<span class="required-field"> *</span></label>
                                                  <input type="text" name="field[<?php echo $i; ?>][name]" class="form-control field_name input-sm" placeholder="Enter name" value="<?php echo $field['name']; ?>">
                                                </div>
                                                <div class="form-group">
                                                  <label for="group_label">Label</label>
                                                  <input type="text" name="field[<?php echo $i; ?>][label]"
                                                  value="<?php echo $field['label']; ?>" class="form-control field_label input-sm"
                                                  placeholder="Enter label">
                                                </div>
                                                <div class="form-group">
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" class="required_checkbox"
                                                             name="field[<?php echo $i; ?>][required]" <?php if(isset($field['required']) && ($field['required'] == 'on')) echo "checked"; ?>> Required</label>
                                                  </div>
                                                </div>
                                                <div class="form-group required_msg">
                                                  <label>Error message for required</label>
                                                  <input type="text" class="form-control required_error_msg input-sm"
                                                         name="field[<?php echo $i; ?>][required_error_msg]" value="This field is required."
                                                         value="<?php echo $field['required_error_msg']; ?>">
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="col-sm-12">
                                                <div class="form-group tnc_link">
                                                  <label>Link</label>
                                                  <input type="url" class="form-control input-sm" name="field[<?php echo $i; ?>][tnc_link]" placeholder="Enter link for the label." value="<?php echo $field['tnc_link']; ?>">
                                                </div>                       
                                                
                                                <div class="form-group">
                                                  <label>Custom Class</label>
                                                  <input type="text" name="field[<?php echo $i; ?>][custom_class]"
                                                         class="form-control input-sm" value="<?php echo $field['custom_class']; ?>" placeholder="Custom classes">
                                                  <p class="help-block">
                                                    Comma separated string of classes.Ex: class1,class2,class3 .
                                                  </p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <input class="input_type" type="hidden" name="field[<?php echo $i; ?>][type]" value="tnc">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger pull-left delete_element">Delete</button>
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-primary save_element">Save changes</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                break;
                              case "heading":
                                ?>
                                <div class="sort">
                                  <div class="col-md-12">
                                    <div class="btn-group pull-left hide">
                                      <button type="button" class="btn btn-primary btn-edit btn-xs" modal="<?php echo $i; ?>">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                      </button>
                                      <button type="button" class="btn btn-danger btn-delete btn-xs">
                                        <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="form-group ui-draggable ui-draggable-handle dropped field_details_modal_<?php echo $i; ?>" modal="<?php echo $i; ?>">
                                      <div class="col-sm-12">
                                          <?php echo '<' . $field['heading_type'] . ' style="color: ' . $field['font_color'] .' !important;">'
                                                  . $field['heading_text'] . '</' . $field['heading_type'] . '>'; ?>
                                      </div>
                                  </div>
                                  <div class="modal fade" id="field_details_modal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                  </button>
                                                  <h4 class="modal-title">Enter field settings</h4>
                                              </div>
                                              <div class="modal-body padding-30">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="group_name">Type</label>
                                                            <select class="form-control heading_type input-sm" name="field[<?php echo $i; ?>][heading_type]">
                                                                <option value="h1" <?php if($field['heading_type'] == 'h1') echo "selected"; ?>>H1</option>
                                                                <option value="h2" <?php if($field['heading_type'] == 'h2') echo "selected"; ?>>H2</option>
                                                                <option value="h3" <?php if($field['heading_type'] == 'h3') echo "selected"; ?>>H3</option>
                                                                <option value="h4" <?php if($field['heading_type'] == 'h4') echo "selected"; ?>>H4</option>
                                                                <option value="h5" <?php if($field['heading_type'] == 'h5') echo "selected"; ?>>H5</option>
                                                                <option value="h6" <?php if($field['heading_type'] == 'h6') echo "selected"; ?>>H6</option>
                                                                <option value="p" <?php if($field['heading_type'] == 'p') echo "selected"; ?>>Paragraph</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="group_label">Text</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][heading_text]"
                                                            class="form-control heading_text input-sm" placeholder="Enter heading text" value="<?php echo $field['heading_text']; ?>">
                                                        </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Font Color</label>
                                                            <div class="heading_color input-group colorpicker-component">
                                                                <input name="field[<?php echo $i; ?>][font_color]"
                                                                type="text" value="<?php echo $field['font_color']; ?>" class="form-control font_color input-sm" />
                                                                <span class="input-group-addon"><i></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                          <label>Custom Class</label>
                                                          <input type="text" name="field[<?php echo $i; ?>][custom_class]"
                                                                 class="form-control input-sm" value="<?php echo $field['custom_class']; ?>" placeholder="Custom classes">
                                                          <p class="help-block">
                                                            Comma separated string of classes.Ex: class1,class2,class3 .
                                                          </p>
                                                        </div>
                                                      </div>
                                                  </div>
                                                </div>
                                                  <input class="input_type" type="hidden" name="field[<?php echo $i; ?>][type]" value="heading">
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger pull-left delete_element">Delete</button>
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                  <button type="button" class="btn btn-primary save_heading">Save changes</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                                <?php
                                break;
                              case 'password':
                                    ?>
                                    <div class="sort">
                                      <div class="col-md-12">
                                        <div class="btn-group pull-left hide">
                                          <button type="button" class="btn btn-primary btn-edit btn-xs" modal="<?php echo $i; ?>">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                          </button>
                                          <button type="button" class="btn btn-danger btn-delete btn-xs">
                                            <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                          </button>
                                        </div>
                                      </div>
                                      <div class="form-group ui-draggable ui-draggable-handle dropped field_details_modal_<?php echo $i; ?>" modal="<?php echo $i; ?>">
                                        <div class="col-md-12">
                                          <label class="col-sm-2 control-label"><?php echo $field['label'];
                                          if(isset($field['required']) && ($field['required'] == 'on'))
                                          echo ' <span class="required-field">*</span>'; ?></label>
                                          <div class="col-sm-10">
                                            <?php
                                              if(! empty( $field['input_icon'] ) ){
                                                    echo '<div class="input-group">';
                                                    if( $field['input_icon_position'] == 'left'){
                                                        echo '<span class="input-group-addon"><i class="fa '. $field['input_icon'] . '" aria-hidden="true"></i></span>';
                                                    }
                                                }
                                              ?>
                                              <input type="password" class="form-control draggable_input"
                                              <?php
                                                echo 'style="height: ' . $field['input_size'] . 'px;"' ; ?>
                                              >
                                              <?php
                                              if(! empty( $field['input_icon'] ) ){
                                                if( $field['input_icon_position'] == 'right'){
                                                        echo '<span class="input-group-addon"><i class="fa '. $field['input_icon'] . '" aria-hidden="true"></i></span>';
                                                    }
                                                    echo '</div>';
                                                    
                                                }
                                              ?>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal fade" id="field_details_modal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                           style="display: none;">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Enter field settings</h4>
                                                  </div>
                                                  <div class="modal-body padding-30">
                                                    <div class="row">
                                                      <div class="col-md-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                              <label for="name">Name<span class="required-field"> *</span></label>
                                                              <input type="text" name="field[<?php echo $i; ?>][name]" class="form-control field_name input-sm"
                                                              placeholder="Enter name" value="<?php echo $field['name']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="label">Label Text</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][label]" class="form-control field_label input-sm" placeholder="Enter Label" value="<?php echo $field['label']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="placeholder">Placeholder</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][placeholder]" class="form-control field_placeholder input-sm" placeholder="Enter Placeholder" value="<?php echo $field['placeholder']; ?>">
                                                              <input type="hidden" name="field[<?php echo $i; ?>][type]" value="password">
                                                          </div>
                                                          <div class="form-group">
                                                              <div class="checkbox">
                                                                  <label><input class="required_checkbox" type="checkbox" name="field[<?php echo $i; ?>][required]"
                                                                  <?php if(isset($field['required']) && ($field['required'] == 'on')) echo "checked"; ?>> Required</label>
                                                              </div>
                                                          </div>
                                                          <div class="form-group required_msg">
                                                              <label>Error message for required</label>
                                                              <input type="text" class="form-control required_error_msg input-sm" name="field[<?php echo $i; ?>][required_error_msg]" value="<?php echo $field['required_error_msg']; ?>">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                              <label>Validation</label>
                                                              <select class="form-control other_validation input-sm" name="field[<?php echo $i; ?>][validation]">
                                                                  <option value="none" <?php if($field['validation'] == 'none') echo "selected"; ?>>None</option>
                                                                  <option value="minlength" <?php if($field['validation'] == 'minlength') echo "selected"; ?>>Minlength</option>
                                                                  <option value="maxlength" <?php if($field['validation'] == 'maxlength') echo "selected"; ?>>Maxlength</option>
                                                              </select>
                                                          </div>
                                                          <div class="form-group validation_value <?php
                                                          if( $field['validation'] == 'none' ) echo 'hide'; ?>">
                                                            <label>Value for above valiadtion</label>
                                                            <input type="text" class="form-control input-sm" name="field[<?php echo $i; ?>][validation_value]" placeholder="" value="<?php echo $field['validation_value']; ?>">
                                                          </div>
                                                          <div class="form-group custom_msg hide">
                                                              <label>Error message</label>
                                                              <input type="text" class="form-control custom_error_msg input-sm"
                                                                     name="field[<?php echo $i; ?>][custom_error_msg]"
                                                              value="<?php echo $field['custom_error_msg']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label>Height</label>

                                                              <input type="number" class="form-control input_height input-sm"
                                                                   name="field[<?php echo $i; ?>][input_size]"
                                                                   placeholder="Enter height in pixel" value="<?php echo $field['input_size']; ?>">
                                                            <p class="help-block">Leave blank for default size. (34px)</p>
                                                          </div>
                                                          <div class="form-group">
                                                            <label>Custom Class</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][custom_class]"
                                                                   class="form-control input-sm" value="<?php echo $field['custom_class']; ?>" placeholder="Custom classes">
                                                            <p class="help-block">
                                                              Comma separated string of classes.Ex: class1,class2,class3 .
                                                            </p>
                                                          </div>
                                                          <div class="form-group">
                                                            <label>Add input icon</label>
                                                            <select class="selectpicker" data-live-search="true" name="field[<?php echo $i; ?>][input_icon]">
                                                              <option value="" <?php if( !empty( $field['input_icon'] ) && ( $field['input_icon'] == '' ) ) echo "checked"; ?> >None</option>
                                                              <?php foreach( $fontawesome_list as $key => $val){
                                                                 $checked = '';
                                                                 if( !empty( $field['input_icon'] ) && ( $field['input_icon'] == $key ) ){
                                                                    $checked = 'selected';
                                                                 }
                                                                 echo '<option value="' . $key . '" data-content="' . $val . ' - '. $key . '" ' . $checked . '></option>';
                                                                } ?>
                                                              </select>
                                                          </div>
                                                          <div class="form-group input_icon_postion_div <?php if($field['input_icon'] == '' ) echo "hide"; ?>">
                                                            <label>Position</label>
                                                            <br><label class="radio-inline">
                                                            <input type="radio" class="icon_position" name="field[<?php echo $i; ?>][input_icon_position]"
                                                                 value="left" <?php if( !empty( $field['input_icon_position'] ) && ($field['input_icon_position'] != 'right') ) { echo "checked"; }
                                                                 if( empty($field['input_icon_position'])) echo 'checked'; ?>> Left</label><label class="radio-inline">
                                                          <input type="radio" class="icon_position" name="field[<?php echo $i; ?>][input_icon_position]"
                                                                 value="right" <?php if( !empty( $field['input_icon_position'] ) && ( $field['input_icon_position'] == 'right' ) ) echo "checked"; ?>> Right</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                               
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-danger pull-left delete_element">Delete</button>
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                      <button type="button" class="btn btn-primary save_changes">Save changes</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <?php
                                    break;
                                  case 'rating':
                                    ?>
                                    <div class="sort">
                                      <div class="col-md-12">
                                        <div class="btn-group pull-left hide">
                                          <button type="button" class="btn btn-primary btn-edit btn-xs" modal="<?php echo $i; ?>">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                          </button>
                                          <button type="button" class="btn btn-danger btn-delete btn-xs">
                                            <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                          </button>
                                        </div>
                                      </div>
                                      <div class="form-group ui-draggable ui-draggable-handle dropped field_details_modal_<?php echo $i; ?>" modal="<?php echo $i; ?>">
                                        <div class="col-md-12">
                                          <label class="col-sm-2 control-label"><?php echo $field['label'];
                                          if(isset($field['required']) && ($field['required'] == 'on'))
                                          echo ' <span class="required-field">*</span>';?></label>
                                          <div class="col-sm-10">
                                             <input class="rating rating-loading draggable_input"
                                                    data-min="<?php echo $field['min_value']; ?>" data-max="<?php echo $field['max_value']; ?>" data-step="<?php echo $field['step']; ?>"
                                                    data-size="<?php echo $field['size']; ?>"
                                                    value="<?php echo $field['default_val']; ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal fade" id="field_details_modal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Enter field settings</h4>
                                                  </div>
                                                  <div class="modal-body padding-30">
                                                    <div class="row">
                                                      <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                              <label for="name">Name<span class="required-field"> *</span></label>
                                                              <input type="text" name="field[<?php echo $i; ?>][name]" class="form-control field_name input-sm" placeholder="Enter name" value="<?php echo $field['name']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="label">Label Text</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][label]" class="form-control field_label input-sm" placeholder="Enter Label" value="<?php echo $field['label']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <div class="checkbox">
                                                                  <label><input type="checkbox" class="required_checkbox" name="field[<?php echo $i; ?>][required]"
                                                                  <?php if(isset($field['required']) && ($field['required'] == 'on')) echo "checked"; ?>> Required</label>
                                                              </div>
                                                          </div>
                                                          <div class="form-group required_msg">
                                                              <label>Error message for required</label>
                                                              <input type="text" class="form-control required_error_msg input-sm" name="field[<?php echo $i; ?>][required_error_msg]" value="<?php echo $field['required_error_msg']; ?>">
                                                          </div>
                                                         <div class="form-group">
                                                              <label >Minimum Value</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][min_value]" class="form-control rating_min input-sm"
                                                              placeholder="Enter minimum value"
                                                                     value="<?php echo $field['min_value']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="label">Maximum Value</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][max_value]" class="form-control rating_max input-sm"
                                                              placeholder="Enter maximum value"
                                                                     value="<?php echo $field['max_value']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label>Default value</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][default_val]" class="form-control rating_def_val input-sm"
                                                              placeholder="Enter default value."value="<?php echo $field['default_val']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="label">Step</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][step]" class="form-control rating_step input-sm"
                                                              placeholder="Enter step"
                                                                     value="<?php echo $field['step']; ?>">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                            <label>Stars</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][stars]"
                                                                   class="form-control rating_stars input-sm"
                                                                   placeholder="Enter number of stars"
                                                                   value="<?php echo $field['stars']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="placeholder">Captions</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][caption]"
                                                                     class="form-control rating_caption input-sm"
                                                                     placeholder="Enter Captions"
                                                                     value="<?php echo $field['caption']; ?>">
                                                              <p class="help-block">Comma separated string of values.Ex: Not Rated,One Star,Two star,Three star .Leave blank for default caption.</p>
                                                          </div>
                                                          <div class="form-group">
                                                            <label>Not rated caption</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][not_rated_caption]"
                                                                   class="form-control rating_not_rated input-sm"
                                                                   placeholder="Enter not rated caption."
                                                                   value="<?php echo $field['not_rated_caption']; ?>">
                                                            <p class="help-block">Default is "Not Rated".</p></div>
                                                          <div class="form-group">
                                                              <label for="placeholder">Size</label>
                                                              <select class="form-control rating_size input-sm" name="field[<?php echo $i; ?>][size]">
                                                                  <option value="xs" <?php if( $field['size'] == 'xs') echo 'selected' ?>>Extra small</option>
                                                                  <option value="sm" <?php if( $field['size'] == 'sm') echo 'selected' ?>>Small</option>
                                                                  <option value="md" <?php if( $field['size'] == 'md') echo 'selected' ?>>Medium</option>
                                                                  <option value="lg" <?php if( $field['size'] == 'lg') echo 'selected' ?>>Large</option>
                                                                  <option value="xl" <?php if( $field['size'] == 'xl') echo 'selected' ?>>Extra large</option>
                                                              </select> 
                                                          </div>
                                                          <div class="form-group">
                                                              <div class="checkbox">
                                                                  <label><input type="checkbox" class="disable_caption" name="field[<?php echo $i; ?>][disable_caption]"
                                                                  <?php if(isset($field['disable_caption']) && ($field['disable_caption'] == 'on')) echo 'checked' ?>> Disable caption</label>
                                                              </div>
                                                          </div>
                                                          <input type="hidden" name="field[<?php echo $i; ?>][type]" value="rating">
                                                          
                                                          <div class="form-group">
                                                            <label>Custom Class</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][custom_class]"
                                                                   class="form-control input-sm" value="<?php echo $field['custom_class']; ?>" placeholder="Custom classes">
                                                            <p class="help-block">
                                                              Comma separated string of classes.Ex: class1,class2,class3 .
                                                            </p>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-danger pull-left delete_element">Delete</button>
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                      <button type="button" class="btn btn-primary save_changes">Save changes</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <?php
                                    break;
                                   case 'file_upload':
                                    ?>
                                    <div class="sort">
                                      <div class="col-md-12">
                                          <div class="btn-group pull-left hide">
                                              <button type="button" class="btn btn-primary btn-edit btn-xs" modal="<?php echo $i; ?>">
                                                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                              </button>
                                              <button type="button" class="btn btn-danger btn-delete btn-xs">
                                                  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                              </button>
                                          </div>
                                      </div>
                                      <div class="form-group ui-draggable ui-draggable-handle dropped field_details_modal_<?php echo $i; ?>" modal="<?php echo $i; ?>">
                                        <div class="col-sm-12">
                                          <label class="col-sm-2 control-label"><?php echo $field['label'];  if(isset($field['required']) && ($field['required'] == 'on'))
                                          echo ' <span class="required-field">*</span>'; ?></label>
                                          <div class="col-sm-10">
                                            <div type="file_upload" class="draggable_input dropzone" action="#">
                                                <div class="dz-message" data-dz-message>
                                                    <span class="text-center"><i class="fa fa-upload fa-3x" aria-hidden="true"></i></span><br/>
                                                    <span class="upload_text"><?php echo $field['upload_text']; ?></span>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal fade" id="field_details_modal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Enter field settings</h4>
                                                  </div>
                                                  <div class="modal-body padding-30">
                                                    <div class="row">
                                                      <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                              <label for="name">Name<span class="required-field"> *</span></label>
                                                              <input type="text" name="field[<?php echo $i; ?>][name]" class="form-control field_name input-sm" placeholder="Enter name" value="<?php echo $field['name']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="label">Label Text</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][label]" class="form-control field_label input-sm" placeholder="Enter Label" value="<?php echo $field['label']; ?>">
                                                          </div>
                                                          <div class="form-group">
                                                              <label>Upload Text</label>
                                                              <input type="text" name="field[<?php echo $i; ?>][upload_text]" class="form-control input-sm upload_text" placeholder="Enter upload text" value="<?php echo $field['upload_text']; ?>">
                                                              <input type="hidden" class="input_type" name="field[<?php echo $i; ?>][type]" value="file_upload">
                                                          </div>
                                                          <div class="form-group">
                                                            <label>No. of files can be uploaded</label><input type="number" name="field[<?php echo $i; ?>][no_of_files]" class="form-control input-sm" placeholder="Enter number of files to be uploaded" value="<?php echo $field['no_of_files']; ?>">
                                                              <p class="help-block">Default is 1</p>
                                                             
                                                            </div>
                                                            <div class="form-group">
                                                              <div class="checkbox">
                                                                  <label><input type="checkbox" class="required_checkbox" name="field[<?php echo $i; ?>][required]"
                                                                  <?php if(isset($field['required']) && ($field['required'] == 'on')) echo "checked"; ?>> Required</label>
                                                              </div>
                                                          </div>
                                                          <div class="form-group required_msg">
                                                              <label>Error message for required</label>
                                                              <input type="text" class="form-control required_error_msg input-sm" name="field[<?php echo $i; ?>][required_error_msg]" value="<?php if(!empty($field['required_error_msg'])) echo $field['required_error_msg']; ?>">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                          <div class="form-group">
                                                            <div class="checkbox">
                                                            <label><input type="checkbox" name="field[<?php echo $i; ?>][send_as_attachment]" value="1" <?php if( !empty($field['send_as_attachment']) && ( $field['send_as_attachment'] == 1 ) ) {echo 'checked'; } ?>>Send uploaded file as E-mail attachment</label></div>
                                                            </div>
                                                          <div class="form-group">
                                                              <label>File size limits </label><input type="number" name="field[<?php echo $i; ?>][file_limit]" class="form-control input-sm" placeholder="Enter file size limit in MB" value="<?php echo $field['file_limit']; ?>">
                                                              <p class="help-block" >Enter file size limit in MB</p>
                                                           </div>
                                                          <div class="form-group">
                                                            <label>Allowed file types</label><br>
                                                            <label class="radio-inline">
                                                              <input type="radio" name="field[<?php echo $i; ?>][allowed_file]" value="0" class="file_type_radio"  <?php if(  $field['allowed_file'] == '0') echo 'checked'; ?>> All types
                                                            </label>
                                                            <label class="radio-inline">
                                                              <input type="radio" name="field[<?php echo $i; ?>][allowed_file]" value="1" class="file_type_radio" <?php if(  $field['allowed_file'] == '1') echo 'checked'; ?>> Specify allowed types
                                                            </label>
                                                          </div>
                                                          <div class="form-group file_types_div <?php if(  $field['allowed_file'] == '0') echo 'hide'; ?>">
                                                          <label>Add file types</label>
                                                          <input type="text" class="form-control file_type_options input-sm"
                                                                 name="field[<?php echo $i; ?>][allowed_file_types]" value="<?php echo $field['allowed_file_types']; ?>" placeholder="Enter file types">
                                                          <p class="help-block">Comma separated string of file types.Ex: jpg,png,jpeg</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Custom Class</label>
                                                            <input type="text" name="field[<?php echo $i; ?>][custom_class]"
                                                                   class="form-control input-sm" value="<?php echo $field['custom_class']; ?>" placeholder="Custom classes">
                                                            <p class="help-block">
                                                              Comma separated string of classes.Ex: class1,class2,class3
                                                            </p>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-danger pull-left delete_element">Delete</button>
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                      <button type="button" class="btn btn-primary save_changes">Save changes</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <?php
                                    break;
                              
                                }
                              }
                            ?>
                            </div>
                            <input type="hidden" id="modal_count" value="<?php echo $i; ?>">
                            <div role="tabpanel" class="tab-pane" id="email"><br>
                               
                               <?php include_once('partials/email_settings.php'); ?>
                               
                            </div>
                            <div role="tabpanel" class="tab-pane" id="database"><br>
                            
                              <?php include_once('partials/database_settings.php'); ?>
                            
                            </div>
                            <div role="tabpanel" class="tab-pane" id="settings"><br>
                              
                              <?php include_once('partials/settings.php'); ?>
                              
                            </div>
                            
                            <div role="tabpanel" class="tab-pane" id="additional-js-css"><br>
                              <p>Additional JS, CSS will be loaded at the end of the form.</p>
                              <br/>
                              <div class="form-group">
                                  <label for="javascript" class="col-sm-2 control-label">Javascript</label>
                                  <div class="col-sm-10">
                                    <textarea class="form-control" name="javascript" id="javascript" rows=4 placeholder="Additional javascript"><?php echo $formData['javascript']; ?></textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="css" class="col-sm-2 control-label">CSS</label>
                                  <div class="col-sm-10">
                                    <textarea class="form-control" name="css" id="css" rows=4 placeholder="Additional css"><?php echo $formData['css']; ?></textarea>
                                  </div>
                              </div>
                            </div>
                            
                          </div>
                        
                        </div>
                        <!--tab end-->
                      </div>
                      <div class="panel-footer"><button class="btn btn-primary" id="save_form" type="button">Save Form</button></div>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once('partials/saved-forms.php'); ?>
        <?php include_once('partials/footer.php'); ?>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/js/star-rating.min.js"></script>
    <script src="assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <script src="assets/js/common.js?v=<?php echo RESOURCE_VERSION; ?>"></script>
    <script src="assets/js/fontawesome_list.js"></script>
    <script src="assets/js/update.js?v=<?php echo RESOURCE_VERSION; ?>"></script>
  </body>
</html>