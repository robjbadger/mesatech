<?php
/**
 * Description of settings.php file
 * Settings Tab
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */
?>

<h4 class="text-primary">Google reCAPTCHA setting:</h4>
<div class="form-group">
  <div class="col-sm-offset-3 col-sm-9">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="enable_recaptcha" id="enable_recaptcha" value="1"
        <?php if(isset($formData['enable_recaptcha']) && ($formData['enable_recaptcha'] == '1'))
        echo 'checked'; ?>> Add Google reCAPTCHA
      </label>
    </div>
  </div>
</div>
<span id="recaptcha_keys" class="hide">
  <div class="form-group">
    <label for="site_key" class="col-sm-3 control-label">Site key</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="site_key" id="site_key"
             placeholder="Enter site key" value="<?php if( isset($formData['site_key']) ) echo $formData['site_key']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="secret_key" class="col-sm-3 control-label">Secret key</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="secret_key" id="secret_key"
             placeholder="Enter secret key" value="<?php if( isset($formData['secret_key']) ) echo $formData['secret_key']; ?>">
      <span class="help-block">Don't have Site key or Secret key ??
      <a href="https://www.google.com/recaptcha/admin"
         target="_blank">Click here</a> to create.</span>
    </div>
  </div>
</span>
<h4 class="text-primary">Color setting:</h4>
<div class="form-group">
  <label for="label_color" class="col-sm-3 control-label">Label color</label>
  <div class="col-sm-9">
    <div id="cp_label" class="input-group colorpicker-component">
        <input type="text"  id="label_color"
               value="<?php if( isset($formData['label_color']) ) { echo $formData['label_color']; } else { echo '#000000' ;} ?>"
        class="form-control" name="label_color" />
        <span class="input-group-addon"><i></i></span>
    </div>
  </div>
 </div>

<div class="form-group">
  <label for="error_msg_color" class="col-sm-3 control-label">Error message color</label>
  <div class="col-sm-5">
    <div id="cp_error_msg" class="input-group colorpicker-component">
        <input type="text"  id="error_msg_color"
               value="<?php if( isset($formData['error_msg_color']) ) { echo $formData['error_msg_color'];} else { echo '#a94442' ;} ?>" class="form-control" name="error_msg_color" />
        <span class="input-group-addon"><i></i></span>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="checkbox">
    <label>
      <input type="checkbox" name="error_field_highlight" value="1" <?php if( isset($formData['error_field_highlight']) ) { echo 'checked';} ?> > <b>Highlight error fields</b>
    </label>
  </div>
  </div>
</div>
<div class="form-group">
  <label for="required_asterisk_color"
         class="col-sm-3 control-label">Required asterisk's color (*)</label>
  <div class="col-sm-9">
    <div id="cp_required" class="input-group colorpicker-component">
        <input type="text"  id="required_asterisk_color"
               value="<?php if( isset($formData['required_asterisk_color']) ) { echo $formData['required_asterisk_color'];} else { echo '#a94442' ;}  ?>"
               class="form-control" name="required_asterisk_color" />
        <span class="input-group-addon"><i></i></span>
    </div>
  </div>
</div>
<div class="form-group">
  <label for="background_color" class="col-sm-3 control-label">Background color</label>
  <div class="col-sm-9">
    <div id="cp_backgroung" class="input-group colorpicker-component">
        <input type="text"  id="background_color"
               value="<?php if( isset($formData['background_color']) ) { echo $formData['background_color'];} else { echo '#FFFFFF' ;}  ?>"
        class="form-control" name="background_color" />
        <span class="input-group-addon"><i></i></span>
    </div>
  </div>
</div>
<h4 class="text-primary">Notification setting:</h4>
<div class="form-group">
  <label class="col-sm-3 control-label">Action after submit</label>
  <div class="col-sm-9">
    <label class="radio-inline">
      <input type="radio" name="post_submit_action" value="show_msg"
      <?php if( isset($formData['post_submit_action']) && ($formData['post_submit_action'] == 'show_msg')) { echo 'checked'; }
      else if ( empty($formData['post_submit_action'] ) ){ echo 'checked'; } ?>> Show Notification in the same page
    </label>
    <label class="radio-inline">
      <input type="radio" name="post_submit_action" value="redirect"
      <?php if( isset($formData['post_submit_action']) && ($formData['post_submit_action'] == 'redirect') ) echo 'checked'; ?>> Redirect to thank you page
    </label>
    
  </div>
</div>
<span id="show_msg_span">
  <div class="form-group">
    <label for="email_success_msg" class="col-sm-3 control-label">Email success notification</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="email_success_msg" id="email_success_msg"
             placeholder="Enter email success notification"
             value="<?php if( isset($formData['background_color']) ) { echo $formData['email_success_msg']; }
             else{ echo 'Email sent successfully.';} ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="email_failed_msg" class="col-sm-3 control-label">Email failed notification</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="email_failed_msg" id="email_failed_msg"
             placeholder="Enter email failed notification"
             value="<?php if( isset($formData['email_failed_msg']) ) { echo $formData['email_failed_msg']; }
             else{ echo 'Something went wrong, please try again.';} ?>">
    </div>
  </div>
</span>
<span id="redirect_span">
  <div class="form-group">
    <label for="redirect_url" class="col-sm-3 control-label">Redirect url</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="redirect_url" id="redirect_url"
             placeholder="Enter redirect url" value="<?php if( isset($formData['redirect_url']) ) { echo $formData['redirect_url']; }?>">
    </div>
  </div>
</span>
<h4 class="text-primary">Submit button setting:</h4>
<div class="form-group">
    <label for="btn_text" class="col-sm-3 control-label">Submit button text</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="btn_text" id="btn_text"
             placeholder="Enter submit button text"
             value="<?php if( isset($formData['btn_text']) ) { echo $formData['btn_text']; }
             else{ echo 'Send';} ?>">
</div>
</div>
<div class="form-group">
    <label for="loading_text" class="col-sm-3 control-label">Submit button loading text</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="loading_text" id="loading_text"
             placeholder="Enter submit button loading text"
             value="<?php if( isset($formData['loading_text']) ) { echo $formData['loading_text']; }
             else{ echo 'Sending...';} ?>">
  </div>
</div>
<div class="form-group">
  <label for="btn_size" class="col-sm-3 control-label">Submit button size</label>
  <div class="col-sm-9">
    <div class="btn-group" data-toggle="buttons">
      <label class="btn btn-primary btn-lg <?php if( !empty($formData['btn_size']) && ($formData['btn_size'] == 'btn-lg') ) echo "active" ?>">
        <input type="radio" name="btn_size" value="btn-lg"
        <?php if( !empty($formData['btn_size']) && ($formData['btn_size'] == 'btn-lg') ) echo "checked" ?>
        > Large
      </label>
      <label class="btn btn-primary <?php if( !empty($formData['btn_size']) && ($formData['btn_size'] == ' ') ) echo "active" ?>">
        <input type="radio" name="btn_size" value=" "
          <?php if( !empty($formData['btn_size']) && ($formData['btn_size'] == ' ') ) echo "checked" ?>
        > Medium
      </label>
      <label class="btn btn-primary btn-sm <?php if( !empty($formData['btn_size']) && ($formData['btn_size'] == 'btn-sm') ) echo "active" ?>">
        <input type="radio" name="btn_size" value="btn-sm"
        <?php if( !empty($formData['btn_size']) && ($formData['btn_size'] == 'btn-sm') ) echo "checked" ?>
               > Small
      </label>
      <label class="btn btn-primary btn-xs <?php if( !empty($formData['btn_size']) && ($formData['btn_size'] == 'btn-xs') ) echo "active" ?>">
        <input type="radio" name="btn_size" value="btn-xs"
               <?php if( !empty($formData['btn_size']) && ($formData['btn_size'] == 'btn-xs') ) echo "checked" ?>
               > Extra small
      </label>                                 
    </div>
    <p class="help-block">Default size is "Medium".</p>                              
  </div>
</div>
<div class="form-group">
  <label for="btn_size" class="col-sm-3 control-label">Submit button color</label>
  <div class="col-sm-9">
    <div class="btn-group" data-toggle="buttons">
      <label class="btn btn-default <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-default') ) echo "active" ?>">
        <input type="radio" name="btn_color" value="btn-default"
               <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-default') ) echo "checked" ?>
        > Default
      </label>
      <label class="btn btn-primary <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-primary') ) echo "active" ?>">
        <input type="radio" name="btn_color" value="btn-primary"
               <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-primary') ) echo "checked" ?>
        > Primary
      </label>
      <label class="btn btn-success <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-success') ) echo "active" ?>">
        <input type="radio" name="btn_color" value="btn-success"
               <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-success') ) echo "checked" ?>
        > Success
      </label>
      <label class="btn btn-warning <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-warning') ) echo "active" ?>">
        <input type="radio" name="btn_color" value="btn-warning"
               <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-warning') ) echo "checked" ?>
        > warning
      </label>
      <label class="btn btn-danger <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-danger') ) echo "active" ?>">
        <input type="radio" name="btn_color" value="btn-danger"
               <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-danger') ) echo "checked" ?>
        > Danger
      </label>
      <label class="btn btn-link <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-link') ) echo "active" ?>">
        <input type="radio" name="btn_color" value="btn-link"
               <?php if( !empty($formData['btn_color']) && ($formData['btn_color'] == 'btn-link') ) echo "checked" ?>
        > None
      </label>
      <p class="help-block">Default color is "Primary".</p>
    </div>
  </div>
</div>
<div class="form-group">
    <label for="loading_text" class="col-sm-3 control-label">Submit button allignment</label>
    <div class="col-sm-9">
      <label class="radio-inline">
        <input type="radio" name="btn_allign" value="pull-left"
        <?php if( !empty($formData['btn_allign']) && ($formData['btn_allign'] == 'pull-left') ) echo "checked" ?>> Left
      </label>
      <label class="radio-inline">
        <input type="radio" name="btn_allign" value="pull-right"
        <?php if( !empty($formData['btn_allign']) && ($formData['btn_allign'] == 'pull-right') ) echo "checked" ?>> Right
      </label>
      <p class="help-block">Default allignment is "Left".</p>
  </div>
</div>
<h4 class="text-primary">Other settings:</h4>
<div class="form-group">
    <label for="btn_text" class="col-sm-3 control-label">Form font size</label>
    <div class="col-sm-9">
      <input type="number" class="form-control" name="form_font_size" id="form_font_size"
             placeholder="Enter font size in pixel"
             value="<?php if( !empty($formData['form_font_size']) ) { echo $formData['form_font_size']; } ?>">
             <p class="help-block">Leave this field blank for default font size.</p>
</div>
</div>