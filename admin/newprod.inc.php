<div class="section-frame">
	<h1 class="section-title" align="center">Add new Product</h1><hr>
		<hr>

<div class="container">
		<form class="form-horizontal" action="addprod.inc.php" method="post">
				
			<div class="form-group">
				<label class="col-sm-2 control-label" for="catid">Category:</label>
				<div class="col-sm-10">
					<select class="form-control"  name="catid"><option>Select</option>
							<?php
							$query = "SELECT catid, name FROM categories ORDER BY name ASC";
							$result = mysqli_query($dbc, $query);
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								$catid = $row['catid'];
								$name = $row['name'];
								echo "<option name='$catid'>$name</option>";
							}
						
						?>
					
					</select>
					</div>
			</div>
		
				
			<div class="form-group">
				<label class="col-sm-2 control-label" for="description">Description:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="description" maxlength='50'>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="count">Count:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="count" maxlength="10">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="pack">Pack:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="pack">
				</div>
			</div>
								<div class="form-group">
				<label class="col-sm-2 control-label" for="cmnum">CoreMark #:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="cmnum">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="mtcnum">MesaTech #"</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="mtcnum">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="price">Price:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="price">
				</div>
			</div>

			
					<div class="form-group">
				<label class="col-sm-2 control-label" for="assocprod">Assoc. Product:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="assocprod">
				</div>
			</div>
					<div class="form-group">
				<label class="col-sm-2 control-label" for="assocprod2">Assoc. Prod. 2:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="assocprod2">
				</div>
			</div>
					<div class="form-group">
				<label class="col-sm-2 control-label" for="assocprod3">Assoc. Prod. 3:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="assocprod3">
				</div>
			</div>
					<div class="form-group">
				<label class="col-sm-2 control-label" for="assocprod">Picture:</label>
				<div class="col-sm-10">
				<input type="hidden" name="MAX_FILE_SIZE" value="2048000">
				<input type="file" class="form-control" name="picture">
				</div>
			</div>
			<!----

  echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1024000\">\n";
   echo "<tr><td>Picture</td><td><input type=\"file\" name=\"picture\"></td></tr>\n";
   echo "</table>\n";
   echo "<input type=\"submit\" value=\"Submit\">\n";
   echo "<input type=\"hidden\" name=\"content\" value=\"addproduct\">\n";







-->
			
			
			
			
					<div class="form-group">
				
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-mesa" name="Submit">
				</div>
			</div>
				 	

		</form>

</div>
</div>