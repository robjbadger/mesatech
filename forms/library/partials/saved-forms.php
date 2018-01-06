<?php
/**
 * Description of saved-forms.php file
 * Shows list of forms saved
 * Last Modified: 21.05.2017
 * @author www.thewebfosters.com
 */
?>

<hr/>
<div class="row">
          <?php
          $files = array_diff(scandir(SAVED_FORMS_DIR), array('..', '.'));
          
          if(!empty($files)){
          ?>
          <div class="col-md-8">
            <div class="panel panel-success">
            <div class="panel-heading"><b>All Your Saved Forms</b></div>
              <!-- Table -->
              <table class="table">
                <tr>
                  <th>Form</th>
                  <th>Edit</th>
                  <th>Download Code</th>
                  <th>Delete</th>
                </tr>
                <?php
                foreach( $files as $file){

                  if (is_dir(SAVED_FORMS_DIR . $file)) {
                    continue;
                  }

                  $form_name = str_replace( '.json', '', $file);
                  
                  echo'<tr>
                          <td>' . $form_name . ' <a href="?page=generate_common&action=view&form_name=' . $form_name . '" data-toggle="tooltip" target="_blank" title="View form"> <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a>
                          </td>
                          <td>
                            <a href="?page=edit&form_name=' . $form_name . '" class="btn btn-primary btn-sm"> 
                              <i class="fa fa-pencil"></i> Edit
                            </a>
                          </td>
                          <td><a href="?page=generate_common&action=download&form_name=' . $form_name . '" " class="btn btn-success btn-sm download_form">
                            <i class="fa fa-download"></i> Download</button>
                          </td>
                          <td>
                            <button type="button" form_name="' . $form_name . '" class="btn btn-danger btn-sm delete_form">
                              <i class="fa fa-trash"></i> Delete
                            </button>
                          </td>
                          
                        </tr>';
                }
                ?>
                
              </table>
            </div>
          </div>
          <?php }?>
        </div>