<?php
/**
 * Description of fields.php file
 * Contains all fields which can be used in form
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */
?>

<div>
    <form class="form-horizontal">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#input" aria-controls="home" role="tab" data-toggle="tab">Fields</a></li>
      <li role="presentation"><a href="#advance_fields" aria-controls="advance_fields" role="tab" data-toggle="tab">Advance fields</a></li>
    </ul>
  
    <!-- Tab panes -->
    
    <div class="tab-content">
    
        <div role="tabpanel" class="tab-pane active drag_tab_panel" id="input">
          <br>
          
            <div class="form-group draggable_text_input">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label">Text Input</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control draggable_input" placeholder="Text Input">
                    </div>
                </div>
            </div>
            <div class="form-group draggable_text_input">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control draggable_input" placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="form-group draggable_text_area">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label">Text Area</label>
                    <div class="col-sm-10">
                        <textarea type="textarea" class="form-control draggable_input"  placeholder="Text Area"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group draggable_text_area">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label form_label">Radio</label>
                    <div class="col-sm-10">
                        <div class="radio form_options">
                          <label>
                            <input type="radio" class="draggable_input" value="option1" checked>
                            Option one
                          </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group draggable_text_area">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label form_label">Checkbox</label>
                    <div class="col-sm-10">
                        <div class="checkbox form_options">
                          <label>
                            <input type="checkbox" value="" class="draggable_input">
                            Option one
                          </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group draggable_text_input">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label form_label">Select</label>
                    <div class="col-sm-10">
                      <select class="form-control draggable_input form_options" type="select">
                        <option>Option 1</option>
                        <option>Option 2</option>
                      </select>
                    </div>
                </div>
            </div>
            
            <div class="form-group draggable_text_input">
              <div class="col-sm-12">
                  <h4 type="text" class="draggable_input" role="heading">Add Heading / Paragraph</h4>
              </div>
            </div>
            
        </div>
        <!--advance fields-->
        <div role="tabpanel" class="tab-pane drag_tab_panel" id="advance_fields">
          <br>
            <div class="form-group draggable_text_input">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label form_label">Multiple select</label>
                    <div class="col-sm-10">
                      <select class="form-control draggable_input form_options" type="multiple_select" multiple>
                        <option>Option 1</option>
                        <option>Option 2</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="form-group draggable_text_input">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label">Calendar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control draggable_input"
                               placeholder="Calendar or Datepicker" readonly=true role="datepicker">
                    </div>
                </div>
            </div>
            <div class="form-group draggable_text_input">
                <div class="col-sm-12">
                    <div class="checkbox col-sm-10 col-sm-offset-2">
                        <label><input class="draggable_input" type="checkbox" role="tnc">
                        <span class="form_label">Terms & Conditions</span></label>
                    </div>
                </div>
            </div>
            <div class="form-group draggable_text_input">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label">Rating</label>
                    <div class="col-sm-10">
                        <input type="rating" class="rating rating-loading draggable_input"
                               data-min="0" data-max="5" data-step="1" data-size="sm">
                    </div>
                </div>
            </div>
            <div class="form-group draggable_text_input">
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label">File Upload</label>
                    <div class="col-sm-10">
                        <div type="file_upload" class="draggable_input dropzone" action="#">
                            <div class="dz-message" data-dz-message>
                                <span class="text-center"><i class="fa fa-upload fa-3x" aria-hidden="true"></i></span><br/>
                                <span class="upload_text">Drop a file here or click to upload</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </form>
</div>