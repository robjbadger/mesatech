<!--collapse start-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-success">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <b>Email Settings</b>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <div class="form-group">
          <label class="col-sm-3" for="msg_from">From*</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="msg_from" name="msg_from" placeholder="Enter sender's name or email"
              value="<?php if(!empty($formData['msg_from'])) { echo $formData['msg_from'];} ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3" for="msg_to">To*</label>
          <div class="col-sm-9">
              <input type="email" class="form-control" id="msg_to" name="msg_to" placeholder="Enter receiver's email"
              value="<?php if(!empty($formData['msg_to'])) { echo $formData['msg_to'];} ?>">
              <p class="help-block">Send to multiple person by entering email comma seperated. Example: receiver1@example.com, receiver2@example.com</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3" for="msg_cc">Cc</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="msg_cc" name="msg_cc"
                     placeholder="Enter Cc email address, multiple email comma seperated"
                     value="<?php if(!empty($formData['msg_cc'])) { echo $formData['msg_cc'];} ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3" for="msg_sub">Subject*</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="msg_sub" name="msg_sub" placeholder="Enter subject"
               value="<?php if(!empty($formData['msg_sub'])) { echo $formData['msg_sub'];} ?>">
              <p class="help-block help_text"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3" for="msg_body">Body*</label>
          <div class="col-sm-9">
              <textarea class="form-control" name="msg_body" id="msg_body" rows=7><?php if(!empty($formData['msg_body'])) { echo $formData['msg_body'];} ?></textarea>
              <p class="help-block help_text"></p>
              <p class="help-block">More informations:
                <span title="click to add" class="name_tags text-primary" tag="__SENDER_IP__"
                      style="cursor: pointer;"><b> Sender IP </b></span>, 
                <span title="click to add" class="name_tags text-primary" tag="__DATE_TIME__"
                      style="cursor: pointer;"><b> Date-time </b></span>
              </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-success">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <b>Auto Response Settings</b>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <div class="form-group">
          <label class="col-sm-3" for="enable_auto_response">Enable auto response</label>
          <div class="col-sm-9">
            <input type="checkbox" name="enable_auto_response" id="enable_auto_response" value="1"
            <?php if( !empty( $formData['enable_auto_response'] )) echo "checked"; ?>>                                                                   
          </div>
        </div>
        <span id="auto_response_span"> <!--auto_response start-->
          <div class="form-group">
          <label class="col-sm-3" for="auto_response_from">Response From*</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="auto_response_from" name="auto_response_from"
                     placeholder="Enter response from"
                     value="<?php if(!empty($formData['auto_response_from'])) echo $formData['auto_response_from']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3" for="auto_response_to">Response To*</label>
          <?php if(!empty($formData['auto_response_to'])){
                echo '<input type="hidden" id="response_to_saved_value" value="' .$formData['auto_response_to'] . '" >';
            } ?>
          <div class="col-sm-9 auto_response_to_div">
             
          </div>
          <p class="help-block col-sm-9 col-sm-offset-3">Choose an email field from the options to send response.</p>
        </div>
        <div class="form-group">
          <label class="col-sm-3" for="auto_response_sub">Response Subject</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="auto_response_sub" name="auto_response_sub"
                     placeholder="Enter response subject"
                     value="<?php if(!empty($formData['auto_response_sub'])) echo $formData['auto_response_sub']; ?>">
              <p class="help-block help_text"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3" for="auto_response_body">Response Body*</label>
          <div class="col-sm-9">
              <textarea class="form-control" name="auto_response_body" id="auto_response_body" rows=7><?php if(!empty($formData['auto_response_body'])) echo $formData['auto_response_body']; ?></textarea>
              <p class="help-block help_text"></p>
          </div>
        </div>
         
      </span> <!--auto response end-->
      </div>
    </div>
  </div>
  <!--smtp settings start-->
    <div class="panel panel-success">
        <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <b>SMTP Settings</b>
            </a>
          </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
          <div class="panel-body">
            <div class="form-group">
              <label class="col-sm-3" for="enable_smtp">Use SMTP</label>
              <div class="col-sm-9">
                <input type="checkbox" name="enable_smtp" id="enable_smtp" value="1"
                <?php if( !empty( $formData['enable_smtp'] )) echo "checked"; ?>>                                                                   
              </div>
            </div>
            <span id="smtp_settings">
                <div class="form-group">
                    <label class="col-sm-3" for="smtp_host">Host*</label>
                    <div class="col-sm-9">
                      <input type="text" name="smtp_host" id="smtp_host" class="form-control"
                             value="<?php if( !empty( $formData['smtp_host'] )){ echo $formData['smtp_host']; } ?>">                                                                   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="smtp_username">Username*</label>
                    <div class="col-sm-9">
                      <input type="text" name="smtp_username" id="smtp_username" class="form-control"
                             value="<?php if( !empty( $formData['smtp_username'] )){ echo $formData['smtp_username']; } ?>">                                                                   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="smtp_password">Password*</label>
                    <div class="col-sm-9">
                      <input type="password" name="smtp_password" id="smtp_password" class="form-control"
                             value="<?php if( !empty( $formData['smtp_username'] )){ echo $formData['smtp_password']; } ?>">                                                                   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="smtp_port">Port*</label>
                    <div class="col-sm-9">
                      <input type="text" name="smtp_port" id="smtp_port" class="form-control"
                             value="<?php if( !empty( $formData['smtp_username'] )){ echo $formData['smtp_port']; } ?>">                                                                   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="smtp_secure">SMTP Secure*</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="smtp_secure" id="smtp_secure">
                            <option value="">None</option>
                            <option value="tls"
                            <?php if(!empty($formData['smtp_secure']) && ($formData['smtp_secure'] == 'tls' ) ) { echo 'selected';} ?>>TLS</option>
                            <option value="ssl"
                            <?php if(!empty($formData['smtp_secure']) && ($formData['smtp_secure'] == 'ssl' ) ) { echo 'selected';} ?>>SSL</option>
                        </select>                                                                   
                    </div>
                </div>
            </span>
          </div>
        </div>
      </div>
  <!--smtp settings end-->
</div>
<!--collapse end-->