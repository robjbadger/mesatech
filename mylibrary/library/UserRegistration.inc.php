<div class="section-frame">
        <div class="container">
            <h1 class="section-title" align="center">User Registration Form</h1><hr>
            <form class="form-horizontal" method="POST" 
                action="/library/UserRegistration_submit.php"
                id="UserRegistration_1514917765"
                style="background-color: #ffffff; ">
                <input type="hidden" name="form_name" value="UserRegistration">
            </br>

            <span id="msg"></span>
            <div class="form-group ">
                <label class="col-sm-2 control-label label-class_UserRegistration_1514917765" for="userid1514917765">User Id: <span class="required-field_UserRegistration_1514917765">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" 
                        id="userid1514917765" 
                        name="fields[userid]" 
                        placeholder="" 
                        data-rule-required="true"
                        data-msg-required="This field is required."  style=""></div>
    </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label label-class_UserRegistration_1514917765" for="firstname1514917765">First Name: <span class="required-field_UserRegistration_1514917765">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" 
                        id="firstname1514917765" 
                        name="fields[firstname]" 
                        placeholder="" 
                        data-rule-required="true"
                        data-msg-required="This field is required."  style=""></div>
    </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label label-class_UserRegistration_1514917765" for="lastname1514917765">Last Name: <span class="required-field_UserRegistration_1514917765">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" 
                        id="lastname1514917765" 
                        name="fields[lastname]" 
                        placeholder="" 
                        data-rule-required="true"
                        data-msg-required="This field is required."  style=""></div>
    </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label label-class_UserRegistration_1514917765" for="phone1514917765">Phone: <span class="required-field_UserRegistration_1514917765">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" 
                        id="phone1514917765" 
                        name="fields[phone]" 
                        placeholder="" 
                        data-rule-required="true"
                        data-msg-required="This field is required." data-rule-phoneus="true" data-msg-phoneus="Invalid phone number."style=""></div>
    </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label label-class_UserRegistration_1514917765" for="ext1514917765">Ext:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" 
                        id="ext1514917765" 
                        name="fields[ext]" 
                        placeholder="" 
                        data-rule-required="false"
                          style=""></div>
    </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label label-class_UserRegistration_1514917765" for="email1514917765">Email: <span class="required-field_UserRegistration_1514917765">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" 
                        id="email1514917765" 
                        name="fields[email]" 
                        placeholder="" 
                        data-rule-required="true"
                        data-msg-required="This field is required." data-rule-email="true" data-msg-email="Invalid email."style=""></div>
    </div>
<div class="form-group ">

        <label class="col-sm-2 control-label label-class_UserRegistration_1514917765" for="password11514917765">Password: <span class="required-field_UserRegistration_1514917765">*</span></label>

        <div class="col-sm-10"><input type="password" class="form-control" style="" 
                            id="password11514917765" 
                            name="fields[password1]" 
                            placeholder="" 
                            data-rule-required="true"
                        data-msg-required="This field is required." data-rule-minlength="6" data-msg-minlength="Password must be 6 characters long"></div>
    </div>
<div class="form-group ">

        <label class="col-sm-2 control-label label-class_UserRegistration_1514917765" for="cpassword1514917765">Confirm Password: <span class="required-field_UserRegistration_1514917765">*</span></label>

        <div class="col-sm-10"><input type="password" class="form-control" style="" 
                            id="cpassword1514917765" 
                            name="fields[cpassword]" 
                            placeholder="" 
                            data-rule-required="true"
                        data-msg-required="This field is required." data-rule-minlength="6" data-msg-minlength="Password must be at least 6 characters long"></div>
    </div>
           <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="send_email btn  btn-mesa"
                        type="submit" 
                        data-loading-text="Sending...">Register</button>
                </div>
            </div>
       </form>
    </div>

</div>
        <!-- Put your body content here -->

    <link rel="stylesheet" type="text/css" href="./css/UserRegistration.css"> <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.min.js"> </script>
<script type="text/javascript" 
                    src="./js/UserRegistration.js"></script>
