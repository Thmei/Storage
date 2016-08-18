<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(realpath(dirname(__FILE__)) . '/../pikture_data_engine/UserHandler.php');
$user_handler = new UserHandler();
$loggedin = false;
if( $user_handler->isUserLoggedIn() == 1) $loggedin = true;
?>

<html>
    <head>
        <title>Pikture!</title>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Customized css -->
        <link rel="stylesheet" href="/~s16g10/common/css/homestyle.css">
        <link rel="stylesheet" href="/~s16g10/common/css/common.css">
        <link rel="stylesheet" href="/~s16g10/user-profile/css/artist_profile.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/~s16g10/common/js/bootstrap-filestyle.min.js"></script>
        
        
        <script src="/~s16g10/common/js/common-scripts.js"></script>
        <script src="js/user_profile.js"></script>



    </head>

    <body>
        <!-- Preloader -->
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>

        <!-- header nav --> 
        <div id ="standard-nav">
        </div>
        <!-- end of header -->

        <!-- Modal to buy if not logged in  -->
        <div id="edit-profile-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">Edit Profile Description</h2>
                    </div>

                    <div class="modal-body">
                        <div class="container">

                            <form role="form" class="form-horizontal">

                                <div class="form-group">


                                    <div class="alert alert-info alert-dismissable col-sm-6">
                                        <a class="panel-close close" data-dismiss="alert">×</a> 
                                        <i class="fa fa-coffee"></i>
                                        Update the fields below for necessary changes.
                                    </div>

                                </div>


                                <div class="form-group">

                                    <label for="source" class="control-label col-sm-2">Profile Image file:</label>
                                    <div class="col-sm-4">

                                        <input type="file" class="filestyle" data-buttonName="btn-primary" name="fileToUpload" id="fileToUpload">

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="fname" class="control-label col-sm-2">First Name:</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="fname" name="fname" class="form-control" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="lname" class="control-label col-sm-2">Last Name:</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="lname" name="lname" class="form-control">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="control-label col-sm-2">Email:</label>
                                    <div class="col-sm-4">
                                        <input type="email" id="lname" name="email" class="form-control">

                                    </div>
                                </div>

                                <div class ="form-group">
                                    <label for="tags" class="control-label col-sm-2">About:</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="name" class="form-control" placeholder="Artist/Photographer">
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label for="category" class="control-label col-sm-2">Skills:</label>
                                    <div class="btn-group col-sm-3">
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" data-label-placement>Click to choose <span class="caret"></span></button>
                                        <ul class="dropdown-menu" style="padding-left:5px">
                                            <li><input type="checkbox" id="ID" name="NAME" value="VALUE"><label for="ID">&nbsp;Painting</label></li>
                                            <li><input type="checkbox" id="ID" name="NAME" value="VALUE"><label for="ID">&nbsp;Craft</label></li>
                                            <li><input type="checkbox" id="ID" name="NAME" value="VALUE"><label for="ID">&nbsp;Drawing</label></li>
                                            <li><input type="checkbox" id="ID" name="NAME" value="VALUE"><label for="ID">&nbsp;Design</label></li>
                                            <li><input type="checkbox" id="ID" name="NAME" value="VALUE"><label for="ID">&nbsp;Performance art</label></li>
                                            <li><input type="checkbox" id="ID" name="NAME" value="VALUE"><label for="ID">&nbsp;Photography</label></li>
                                            <li><input type="checkbox" id="ID" name="NAME" value="VALUE"><label for="ID">&nbsp;Other</label></li>
                                            <!-- Other items -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="desc" class="control-label col-sm-2">Hobbies / Interest</label>
                                    <div class="col-sm-4">
                                        <textarea class="form-control" rows ="6" id="desc" name="description" placeholder="Read, out with friends, listen to music, draw and learn new things."></textarea>
                                    </div>
                                </div>



                            </form>   



                        </div>
                        <!--/container-->  
                    </div>


                    <div class="modal-footer">
                        <button type="button" id="save" class="btn btn-default btn-lg btn-success" data-dismiss="modal">Save!</button>
                        <button type="button" class="btn btn-default btn-lg btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!-- Edit profile modal -->

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        Edit your profile information
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <p>Thank you for your interest in this media. Please log in or sign up to purchase the item.</p>
                        <ul class="list-unstyled">

                            <li>User name</li>
                            <li><input id ="username"></input></li>
                            <li>Password</li>
                            <li><input id = "passsword"></input></li>

                            <li><button type="button" class="btn btn-primary" style = "margin-top:10px;">Log in</button></li>
                            <br>
                            <li><a href="/~s16g10/sign-up/index.html">If you don't have an account, click here to sign up!</a></li>

                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- end modal -->

        <div class="container">

            <div class="row">

                <!-- Profile Desc-->   
                <div class="container">
                    <div class="fb-profile">
                        <img align="left" class="fb-image-lg" src="http://photo.elsoar.com/wp-content/images/Best-Covers-for-Facebook-Timeline-3.jpg" alt="Profile image example" style="height: 300px;object-fit: cover;">
                        <img align="left" id = "profile-image" class="fb-image-profile thumbnail" onerror="this.src='/~s16g10/img/defaultprofile.jpg'" src="" alt="Profile image example"/>
                        <div class="fb-profile-text">
                          <?php if($loggedin){ ?>  <h2><strong> <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];?>  </h2></strong> <?php } ?> 
                       
                         <div id ="user-profile-info" <?php if($loggedin){ ?> style = "display:none;" <?php } ?> >
                            <h2><strong><span id = "artist-name"></strong></h2>
                            <label><strong>Email:  </strong></label><span id = "email"></span><br>
                          
                            <label><strong>Account Type:  </strong></label><span id = "account-type"> Artist</span><br>
                            
                            <label><strong>About:  </strong></label><span id = "about"></span>
                         </div>
                        
                        </div>

                    </div>
                    <div id ="account-edit-options" <?php if(!$loggedin){ ?> style = "display:none;" <?php } ?> >
                    <div class="col-xs-12 col-sm-4">

                        <button class="btn btn-info btn-block" data-toggle="modal" data-target="#edit-profile-modal"><span class="fa fa-user"></span>Edit Profile </button>
                    </div>
                    <!--/col-->
                    <div class="col-xs-12 col-sm-4">

                        <a href="/~s16g10/artist-account/index.php"><button type="button" class="btn btn-primary btn-block"><span class="fa fa-gear"></span>View Your Account </button></a>  
                    </div>
                    </div>
                </div>


                <!-- end of desc -->

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                <div class = "container art-thumbnails"  id ="art-thumbnails">
                    <br>
                    <div class="row">
                        <div id="mainwrapper">
                            <div id = "your-images" class="container">
                                <center><h2 style="font-size:55px;"><strong>Artist Gallery</strong></h2></center>
                                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

 
                            </div>
                        </div>

                    </div>
                </div>

            </div> <!-- end row-->


        </div> 

        <div id ="standard-footer">
        </div>

    </body>
</html>