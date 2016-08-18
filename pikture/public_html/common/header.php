<?php
    require_once(realpath( dirname( __FILE__ ) ).'/../pikture_data_engine/UserHandler.php');
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $user_handler = new UserHandler();
    $logged_in = $user_handler->isUserLoggedIn();
?>
<!-- Static navbar -->

<script src="/~s16g10/common/js/common-scripts.js"></script>


<nav class="navbar navbar-default navbar-static-top navbar-inverse">
    <div class="col-lg-12">
        <div class="" style = "margin-left:0px!important;margin-right:0px!important;padding-left:0px!important;padding-right:0px!important;">
            <div class="col-lg-3 col-md-3 text-left">
                <div class="navbar-header logo-navbar" >
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand pull-left" href="/~s16g10/index.html"><img src = "/~s16g10/img/pikture2.png" style = "height: 60px; position: relative;top:-20px; padding-left: 0"></a>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 text-center">
                <ul class="nav navbar-nav" style = "float:none !important;display:inline-block!important;">
                    <li><a href="/~s16g10/browse/index.html">Browse </a></li>
                    <li>
                        <div class="input-group" style = "height:30px;width:300px;padding:10px;">
                               <span class="input-group-addon" >
                                        <span class="glyphicon glyphicon-search"  aria-hidden="true"></span>
                                    </span>
                                    <input id= "searchInput"  style="height:50px;" type="text" class="form-control search-bar" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <button id = "search-button" class="btn btn-default search-button" type="button">Search!</button>
                                    </span>
                        </div>
                    </li>

                    <li><a href="/~s16g10/art-requests/index.html">Art Requests!</a></li>

                </ul>
            </div>
            <div class="col-lg-3 col-md-3 text-right" >
                <ul class="nav navbar-nav navbar-right" style="margin-right:-30px;">
                    <li class="dropdown">
                        <a href="#" style="width:250px; text-align:center;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">
                            <img src ="/~s16g10/img/user_login_icon.png" style = "height:30px;">
                            <?php
                                if(!$logged_in){
                                    echo 'Log in / Sign up';
                                }else{
                                    echo $_SESSION['first_name'].' '.$_SESSION['last_name'];
                                }
                            ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu drop-menu-right" style = "padding:20px; width: 100%; background-color: #222222;">
                            
                            
                            <li>
                                <form id="sign-in-form" action="/~s16g10/pikture_data_engine/User.php" method="post">
                                <?php
                                    if(!$logged_in){
                                        echo'<i style="color:white;">Username: </i><br>
                                            <input style="width:100%" type="hidden" name="action" value="sign_in"><br>
                                            <input style="width:100%" type="text" id="user_name" name="user_name" ><br>
                                            <i style="color:white;">Password: </i><br>
                                            <input style="width:100%" type="password" id="password" name="password" ><br><br>
                                            <button style="width:100%" id="sign-in-submit" type="button" class="btn btn-primary btn-info" >Log in</button>';
                                    }
                                    else{
                                        echo '<a href ="/~s16g10/user-profile/" type="button" style="width:100%;" class="btn btn-primary btn-info">My Profile</a>';
                                        echo '<hr style="width: 100%; color: black; height: 1px; background-color:black;" />';
                                        echo '<button style="width: 100%" id="sign-out-submit" type="button" class="btn btn-default btn-danger" >Sign Out</button>';
                                    }
                                    echo '</form></li>';
                                    if(!$logged_in){
                                        echo '<strong style="color:white;"><center>-OR-</center></strong>';
                                        echo '<li><button class="btn btn-primary btn-danger" data-toggle="modal" data-target="#sign-up-modal" style = "width:100%;">REGISTER</button></li>';
                                    }
                                ?>                                                         
                        </ul>

                    </li>
                </ul>

            </div>

        </div>
    </div>
</nav>

<div id="sign-up-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style = "display:block;">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h2 class="modal-title">Create an Account</h2>

            </div>
            <div class="modal-body">

                <div class="container">
                    <form id="sign-up-form" class="form-horizontal" role="form" action="/~s16g10/pikture_data_engine/User.php" method="post">
                        <input type="hidden"  name="action" value="sign_up">
                        <div class="form-group">
                            <label id="email-label" for="email" class="control-label col-sm-2">Email:</label>
                            <div class="col-sm-3">
                                <input type="email" id="sign-up-email" name="email" class="form-control" placeholder="E-mail Address">
                            </div>
                        </div>

                        <div class="form-group">
                            <label id="un-label" for="username" class="control-label col-sm-2">User Name:</label>
                            <div class="col-sm-3">
                                <input type="text" id="sign-up-un" name="user_name" class="form-control" placeholder="User Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label id="pw-label" for="password" class="control-label col-sm-2">Password:</label>
                            <div class="col-sm-3">
                                <input type="password" id="sign-up-pw" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label id="pw-confirm-label" for="passwordconfim" class="control-label col-sm-2">Confirm Password:</label>
                            <div class="col-sm-3">
                                <input type="password" id="sign-up-confirm-pw" class="form-control" placeholder="Re-type Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label id="fn-label" for="firstname" class="control-label col-sm-2">First name:</label>
                            <div class="col-sm-3">
                                <input type="text" id="sign-up-fn" name="first_name" class="form-control" placeholder="First Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label id="ln-label" for="lastname" class="control-label col-sm-2">Last name:</label>
                            <div class="col-sm-3">
                                <input type="text" id="sign-up-ln" name="last_name" class="form-control" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="form-group" id="sign-up-user-type">
                            <label id="user-type-label" class="control-label col-sm-2">Account Type:</label>
                            <div class="col-sm-4">
                                <label class="radio-inline"><input type="radio" name="account_type" id="sign-up-is-artist" value="artist">Artist</label>
                                <label class="radio-inline"><input type="radio" name="account_type" id="sign-up-is-customer" value="customer">Customer</label>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-8">
                                <label class="checkbox-inline"><input type="checkbox" value="" id="sign-up-terms">I agree to the Pikture <a href="http://sfsuswe.com/~s16g10/terms.html" target="popup" onclick="window.open('http://sfsuswe.com/~s16g10/terms.html', 'popup', 'width=600,height=600');
                                        return false;">Terms / Condition </a> and <a href="http://sfsuswe.com/~s16g10/privacy.html" target="popup" onclick="window.open('http://sfsuswe.com/~s16g10/privacy.html', 'popup', 'width=600,height=600');
                                                return false;">Privacy Policy</a></label>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="sign-up-submit" class="btn btn-primary btn-success">Create an Account</button>
                <button type="submit" class="btn btn-default btn-danger" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        //artist-thumbnails

     

        $('#search-button').click(function (e) { 
            var search_string = $('#searchInput').val();

            window.location.href = "/~s16g10/search/index.html" + "?searchString=" + search_string ;


        });
        $('#sign-up-submit').click(function (e) {
            validateSignUpSubmission();
        });
        $('#sign-in-submit').click(function (e) {
            $("#sign-in-form").submit();
        });
        $('#sign-out-submit').click(function (e) {
            window.location.href = "/~s16g10/pikture_data_engine/SignOut.php";
        });
    });
    $(document).keypress(function(e) {
        if(e.which === 13 && $("#searchInput").is(':focus')) { 
            var search_string = $('#searchInput').val();
            window.location.href =  "/~s16g10/search/index.html" + "?searchString=" + search_string;
        }
    });
    
    function validateSignUpSubmission(){
        var success = signUpValidateEmail();
        success = signUpValidateUserName()&&success;
        success = signUpValidatePassword()&&success;
        success = signUpValidateConfirmPassword()&&success;
        success = signUpValidateFirstName()&&success;
        success = signUpValidateLastName()&&success;
        success = validateUserType()&&success;
        success = validateTerms()&&success;
        if(success){
            $("#sign-up-form").submit();
        }
        
        
    };
    
    function validateTerms(){
        if(!$('#sign-up-terms').is(':checked')){
            $("#sign-up-terms").closest(".form-group").addClass("has-warning has-feedback");
            return false;
        } 
        else{
            $("#sign-up-terms").closest(".form-group").removeClass("has-warning has-feedback");
            return true;
        }
    }
    
        
    function validateUserType(){
        if($("#sign-up-is-artist").is(":checked")
                ||$("#sign-up-is-customer").is(":checked")
                ||$("#sign-up-is-admin").is(":checked")){
            $("#sign-up-is-artist").closest(".form-group").removeClass("has-warning has-feedback");
            $("#user-type-label").text("Account Type:");
            return true;
        } 
        else{
            $("#sign-up-is-artist").closest(".form-group").addClass("has-warning has-feedback");
            $("#user-type-label").text("Select account type.");
            return false;
        }
    }
    
    function signUpValidateLastName(){
        if( !$('#sign-up-ln').val() ) {
            $("#sign-up-ln").closest(".form-group").addClass("has-warning has-feedback");
            $("#ln-confirm-label").text("Last name is required.");
            return false;
        }
        else{
            $("#sign-up-ln").closest(".form-group").removeClass("has-warning has-feedback");
            $("#ln-confirm-label").text("Last name is required.");
            return true;
        }
    }
    
    function signUpValidateFirstName(){
        if( !$('#sign-up-fn').val() ) {
            $("#sign-up-fn").closest(".form-group").addClass("has-warning has-feedback");
            $("#fn-confirm-label").text("First name is required.");
            return false;
        }
        else{
            $("#sign-up-fn").closest(".form-group").removeClass("has-warning has-feedback");
            $("#fn-confirm-label").text("First Name:");
            return true;
        }
    }
    
    
    function signUpValidateConfirmPassword(){
        if( !$('#sign-up-confirm-pw').val() ) {
            $("#sign-up-confirm-pw").closest(".form-group").addClass("has-warning has-feedback");
            $("#pw-confirm-label").text("A password is required.");
            return false;
        }
        else if($('#sign-up-confirm-pw').val().length<8){
            $("#sign-up-confirm-pw").closest(".form-group").addClass("has-warning has-feedback");
            $("#pw-confirm-label").text("Password is too short.");
            return false;
        }
        else if(!($('#sign-up-confirm-pw').val()===$('#sign-up-pw').val())){
            $("#sign-up-confirm-pw").closest(".form-group").addClass("has-warning has-feedback");
            $("#pw-confirm-label").text("Password doesn't match.");
            return false;
        }
        else{
            $("#sign-up-confirm-pw").closest(".form-group").removeClass("has-warning has-feedback");
            $("#pw-confirm-label").text("Confirm Password:");
            return true;
        }
    }
    
    function signUpValidatePassword(){
        if( !$('#sign-up-pw').val() ) {
            $("#sign-up-pw").closest(".form-group").addClass("has-warning has-feedback");
            $("#pw-label").text("A password is required");
            return false;
        }
        else if($('#sign-up-pw').val().length<8){
            $("#sign-up-pw").closest(".form-group").addClass("has-warning has-feedback");
            $("#pw-label").text("Password is too short.");
            return false;
        }
        else{
            $("#sign-up-pw").closest(".form-group").removeClass("has-warning has-feedback");
            $("#pw-label").text("Password:");
            return true;
        }
    }
    
    function signUpValidateUserName(){
        if( !$('#sign-up-un').val() ) {
               $("#sign-up-un").closest(".form-group").addClass("has-warning has-feedback");
               $("#un-label").text("Please enter a user name.");
               return false;
        }
        else if($('#sign-up-un').val().length<8){
            $("#sign-up-un").closest(".form-group").addClass("has-warning has-feedback");
            $("#un-label").text("User Name is too short.");
            return false;
        }
        else{
            $("#sign-up-un").closest(".form-group").removeClass("has-warning has-feedback");
            $("#un-label").text("User Name:");
            return true;
        }
    }
    
    function signUpValidateEmail(){
            if( !$('#sign-up-email').val() ) {
               $("#sign-up-email").closest(".form-group").addClass("has-warning has-feedback");
               $("#email-label").text("An email is required.");
               return false;
            }
            else if(!basic_email_check($('#sign-up-email').val())){
               $("#sign-up-email").closest(".form-group").addClass("has-warning has-feedback");
               $("#email-label").text("Please enter a valid email.");
               return false;
            }
            else{
                $("#sign-up-email").closest(".form-group").removeClass("has-warning has-feedback");
                $("#email-label").text("Email:");
                return true;
            }
    }
    
    function basic_email_check(email) {
        return /^.+@.+\..+$/.test(email); 
    }
    
</script>
