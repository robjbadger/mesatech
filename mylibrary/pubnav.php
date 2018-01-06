
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
  <i class="fa fa-bars" aria-hidden="true"></i>                      
      </button>
      <a class="navbar-brand" id="mesanav" href="index.php"><img src="favicon-16x16.png" alt="mesatech ico"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php"><i class="fa fa-home" style='font-size:18px'></i> </a></li>
       <li class="active"></li>
      <li><a href="index.php?content=vendor">Vendors</a></li>
      <li><a href="index.php?content=about">About</a></li>
      <li><a href="index.php?content=contact-us">Contact</a></li>

              <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Wholesale <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-content">
            <li><a href="users/user.php">C-Store</a></li>
            <li><a href="users/user.php">ATM Supplies</a></li>
            <li><a href="users/user.php">Programs</a></li>
          </ul>
        </li>
      <li><a href="index.php?content=users/retail">Retail</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Responsibility <span class="caret"></span></a>
      <ul class="dropdown-menu dropdown-content">
		<li><a href="index.php?content=corporate">Corporate Responsibility</a></li>
		  <li><a href="index.php?content=mission">Mission Statement</a> </li>
		 <li><a href="index.php?content=socialresp">Social Responsibility</a> </li>
<li><a href="index.php?content=mesagreen">MesaGreen</a></li>	

      </ul>
      	
      </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
       
       <li><a href="index.php?content=mylibrary/userregistration" class="btn btn-mesa" style='font-size:18px'><i class="fa fa-user-plus" style='font-size:18px'></i> Sign Up</a></li>
     
            <li><a href="#myModalLogin" type="button" class="btn btn-mesa" data-toggle="modal" data-target="#myModalLogin"><i class="fa fa-sign-in" style="font-size:18px"></i> Login</a>
</li>
      </ul>
    </div>
  </div>
</nav>



  <!-- Modal -->
  <div class="modal fade" id="myModalLogin" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please Login</h4>
        </div>
        <div class="modal-body">
      <form class="form-horizontal" action = "mylibrary/validate.php" method = "post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="userid">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="userid" id="userid" placeholder="Enter User ID">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="password">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" name="password" placeholder="Enter Password">
    </div>
  </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  

  