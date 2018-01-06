<?php
/**
 * Description of create.php file
 * Landing page for form generator
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
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>Multipurpose form generator</title>

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
    <span id="required_css_span"></span>
    <span id="label_css_span"></span>
    <span id="background_css_span"></span>
    <span id="font_size_css_span"></span>
    <div class="container">
        <div class="spacer"></div>
        <div class="alert alert-dismissable hide">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <span id='msg'></span>
        </div>

        <?php
          //Check if tried to download then show a purchase link here.
            if(!empty($_GET['d'])) {
              echo '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                <strong>Hello!</strong> purchase the generator to download the forms <a href="https://codecanyon.net/item/multipurpose-form-generator-contact-forms-feedback-forms-event-registration-and-many-more/19472616?ref=thewebfosters" target="_blank">here. </a></div>';
            }
        ?>

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"> <span class="glyphicon glyphicon-info-sign text-danger" data-toggle="tooltip" data-placement="left" title="Drag & Drop fields from Left panel to Right Panel and create the form you want, provide a suitable unique form name, save the form, download the code and use it."></span> <b>Form Fields</b></div>
                    <div class="panel-body">
                      <?php include_once('partials/fields.php'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Create Your Form Here</div>
                    <form class="form-horizontal" action="?page=save" method="post">
                      <div class="panel-heading">
                        <div class="form-group well well-sm">
                          <label class="col-sm-3 control-label" for="form_name">Form Name*</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="form_name" name="form_name" placeholder="Enter form name - Keep it Short, Simple & Meaningfull">
                          </div>
                        </div>
                      </div>
                      <div class="panel-body">
                        <!--tab start-->
                        <div>

                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#form" aria-controls="form" role="tab" data-toggle="tab"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Form</a></li>
                            <li role="presentation"><a href="#email" aria-controls="email" id="email_tab" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Email</a></li>
                            <li role="presentation"><a href="#database" aria-controls="database" id="database_tab" role="tab" data-toggle="tab"><i class="fa fa-database" aria-hidden="true"></i> Database</a></li>
                            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a></li>
                            <li role="presentation"><a href="#additional-js-css" aria-controls="additional-js-css" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Additional JS/CSS</a></li>
                          </ul>
                        
                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active droppable_form" id="form">
                              <br/>
                              <p class="lead initial-msg">
                                Drop form fields here
                              </p>
                            </div>
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
                                    <textarea class="form-control" name="javascript" id="javascript" rows=4 placeholder="Additional javascript"></textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="css" class="col-sm-2 control-label">CSS</label>
                                  <div class="col-sm-10">
                                    <textarea class="form-control" name="css" id="css" rows=4 placeholder="Additional css"></textarea>
                                  </div>
                              </div>
                            </div>
                          </div>
                        
                        </div>
                        <!--tab end-->
                      </div>
                      <div class="panel-footer hide"><button class="btn btn-primary" id="save_form" type="button">Save Form</button></div>
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
    <script src="assets/js/dropzone.min.js"></script>
    <script src="assets/js/fontawesome_list.js?v=<?php echo RESOURCE_VERSION; ?>"></script>
    <script src="assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="assets/js/common.js?v=<?php echo RESOURCE_VERSION; ?>"></script>
    <script src="assets/js/save.js?v=<?php echo RESOURCE_VERSION; ?>"></script>
  </body>
</html>
