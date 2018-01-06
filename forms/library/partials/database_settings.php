<?php
/**
 * Description of database_settings.php file
 * Database Tab
 * Last Modified: 14.07.2017
 * @author www.thewebfosters.com
 */
?>

<h4 class="text-primary">Save fields in database:</h4>
<div class="form-group">
  <div class="col-sm-offset-3 col-sm-9">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="enable_database" id="enable_database" value="1"
        <?php if(isset($formData['enable_database']) && ($formData['enable_database'] == '1'))
        echo 'checked'; ?>> Enable MySQL database integration
      </label>
    </div>
  </div>
</div>
<span id="database_details">
<h4 class="text-primary">Database details:</h4>
  <div class="form-group">
    <label for="db_host" class="col-sm-3 control-label">Host*</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="db_host" id="db_host"
             placeholder="Enter database host" value="<?php if( isset($formData['db_host']) ) echo $formData['db_host']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="db_username" class="col-sm-3 control-label">Username*</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="db_username" id="db_username"
             placeholder="Enter database username" value="<?php if( isset($formData['db_username']) ) echo $formData['db_username']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="db_password" class="col-sm-3 control-label">Password*</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="db_password" id="db_password"
             placeholder="Enter database password" value="<?php if( isset($formData['db_password']) ) echo $formData['db_password']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="db_name" class="col-sm-3 control-label">Database name*</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="db_name" id="db_name"
             placeholder="Enter database name" value="<?php if( isset($formData['db_name']) ) echo $formData['db_name']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="db_table" class="col-sm-3 control-label">Database table*</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="db_table" id="db_table"
             placeholder="Enter table name" value="<?php if( isset($formData['db_table']) ) echo $formData['db_table']; ?>">
    </div>
  </div>
  <h4 class="text-primary">Database field details:</h4>
  <div class="form-group">
    <div class="col-sm-12">
      <button type="button" class="btn btn-primary" id="add_db_column">Add column +</button>
    </div>
  </div>
  
  <div id="table_columns">
    <div class="form-group">
        <div class="col-sm-5">
            <h4>Database Column</h4>
        </div>
        <div class="col-sm-5">
            <h4>Form Field</h4>
        </div>
        <div class="col-sm-2">
            <h4>Delete</h4>
        </div>
    </div>
    <?php
        $column_index = 0;
        if(!empty($formData['db_data'])){
            foreach( $formData['db_data'] as $column){
                echo '<div class="table_column"><div class="form-group"><div class="col-sm-5"><input type="text" class="form-control db_column_name" placeholder="Enter column name" name="db_data[' . $column_index . '][column]" value="' . $column['column'] .'"></div><div class="col-sm-5"><input type="text" class="form-control" placeholder="Enter value" name="db_data[' . $column_index . '][value]" value="' . $column['value'] .'"><p class="help-block help_text"></p></div><div class="col-sm-2"><button type="button" class="btn btn-danger remove_db_column">-</button></div></div></div>';
                $column_index++ ;
            }
        }
    ?>
  </div>
  <input type="hidden" id="column_index" value="<?php echo $column_index ;?>">
</span>
