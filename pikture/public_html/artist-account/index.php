<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(realpath(dirname(__FILE__)) . '/../pikture_data_engine/UserHandler.php');
$user_handler = new UserHandler();
if (!$user_handler->isUserLoggedIn()) {
    header("Location: /~s16g10/");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Artist Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/~s16g10/common/css/homestyle.css">
    <link rel="stylesheet" href="/~s16g10/common/css/common.css">
    <link rel="stylesheet" href="/~s16g10/artist-account/css/artist-account-style.css">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="/~s16g10/img/favicon.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="/~s16g10/artist-account/js/artist_account.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/~s16g10/common/js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript">
        $(":file").filestyle({buttonName: "btn-primary"});
    </script>

    <script type="text/javascript" >
        google.charts.load('current', {'packages': ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawChart);
 
        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Arts');
            data.addColumn('number', 'Art Views');

            data.addRows([
                ['August', 6],
                ['September', 45],
                ['October', 27],
                ['November', 39],
                ['December', 45],
                ['January', 55],
                ['Febuary', 80],
                ['March', 40],
                ['April', 75]

            ]);

            var dataB = new google.visualization.arrayToDataTable([
                ['Arts', 'Views'],
                ["Art 1", 44],
                ["Art 2", 31],
                ["Art 3", 12],
                ["Art 4", 10],
                ["Art 5", 3]
            ]);

            var options = {
                hAxis: {
                    title: 'Months'
                },
                vAxis: {
                    title: 'Number of views'
                },
                backgroundColor: '#f1f8e9'
            };

            var optionsB = {
                chart: {subtitle: 'Arts by their number of views'},
                axes: {
                    x: {
                        0: {side: 'bottom', label: 'White to move'} // Top x-axis.
                    }
                },
                bar: {groupWidth: "50%"}
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            var chartB = new google.charts.Bar(document.getElementById('column_chart'));

            chart.draw(data, options);
            chartB.draw(dataB, google.charts.Bar.convertOptions(optionsB));

            $("a[href='#graph-one']").on('shown.bs.tab', function (e) {
                drawChart();
                clearChart();
            });
            $("a[href='#graph-two']").on('shown.bs.tab', function (e) {
                drawChart();
                clearChart();
            });

        }


    </script>

    


    <!-- Preloader -->
    <script type="text/javascript">
        //<![CDATA[
        $(window).load(function () { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.

            $('body').delay(350).css({'overflow': 'visible'});

        });
        //]]>
    </script>

</head>
<body>
    <div id="cover" style = "display:none;" ></div>
<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<!-- Header nav -->
<div id ="standard-nav">
</div>

<div class="text-left" style="background-color:#DECDB8; margin-top:-20px; ">
    <h1 style="margin-left:100px;">
        <br>Welcome <?php echo $_SESSION['first_name'] ?>!<br>
        <small>This is your Art Account Page </small>

    </h1>

    <h3 style="margin-left:100px;">
        <small>In this page, you can manage your gallery by being able to add more media to your gallery, edit media information, or delete a media.<br>
            In addition, you can see how many views your media have gotten based on the statistics below.</small>

    </h3>

    <h1 style="margin-left:100px;">

        <a href="/~s16g10/user-profile/index.php" class="btn btn-primary btn-danger btn-lg" role="button">View Your Profile</a>
    </h1>

    <br><br>
</div>

<!-- Modal to upload-->
<div id="upload-modal" class="modal fade modal-md" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">Upload Art</h3>
                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

                <div class="container">
                    <p>Use the form to upload files. It's important that every field is filled up correctly.</p>
                    <p>When ready, click the <i style="color: red" >upload button below</i> to upload your art.</p>


                    <form id="data" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <input id ="action" name ="action" type="hidden" value ="upload">

                        <div class="form-group">

                            <label for="source" class="control-label col-sm-2">Image file:</label>
                            <div class="col-sm-4">

                                <input name = "img_path" type="file" class="filestyle" data-buttonName="btn-primary"  id="fileToUpload">

                            </div>

                        </div>

                        <div class="form-group" id = "title-section">
                            <label for="title" class="control-label col-sm-2">Title:</label>
                            <div class="col-sm-4">
                                <input type="text" id="image-title" name="title" class="form-control">

                            </div>
                        </div>


                        <div class ="form-group" id = "licenses-section">
                            <label id = "image-web-price" for="price" class="control-label col-sm-2">Web (Price offer):</label>
                            <div class="col-sm-2">
                                <input type="text" name = "license_web" class="form-control" >
                            </div>
                        </div>

                        <div class ="form-group" id = "licenses-section">
                            <label id = "image-print-price" for="price" class="control-label col-sm-2">Print (Price offer):</label>
                            <div class="col-sm-2">
                                <input type="text" name = "license_print" class="form-control" >
                            </div>
                        </div>

                        <div class ="form-group" id = "licenses-section">
                            <label id = "image-unlimited-price" for="price" class="control-label col-sm-2">Unlimited (Price offer):</label>
                            <div class="col-sm-2">
                                <input type="text" id="name" name = "license_unlimited" class="form-control" >
                            </div>
                        </div>


                        <div class="form-group">


                            <label for="category" class="control-label col-sm-2">Category:</label>

                            <div class="btn-group col-sm-3">
                                <div class="btn-group">

                                    <button class="btn dropdown-toggle" name = "category" data-toggle="dropdown">
                                        Select a category
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Animal</a></li>
                                        <li><a href="#">Beauty</a></li>
                                        <li><a href="#">Flower</a></li>
                                    </ul>

                                </div>
                            </div>

                        </div>

                        <div class="form-group" id = "description-section">
                            <label for="desc" class="control-label col-sm-2">Description</label>
                            <div class="col-sm-4">
                                <textarea id="image-description" class="form-control" rows ="6" name="description" placeholder="Input something..."></textarea>
                            </div>
                        </div>

                        <div class ="form-group" id = "keyword-section">
                            <label for="tags" class="control-label col-sm-2">Seach keywords:</label>
                            <div class="col-sm-4">
                                <input id="image-keywords"  type="text" id="keywords" class="form-control" placeholder="separate each tag with spaces">
                            </div>
                        </div>

                </div>
                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                <div class="form-group" style="text-align:right;">
                    <!-- <button type ="submit" class="btn btn-primary btn-success">Create an Account</button> -->
                    <button id ="upload-button" data-loading-text="Uploading..." class="btn btn-load btn-primary btn-success btn-md" >Upload</button>
                    <button class="btn btn-default btn-danger btn-md" data-dismiss="modal">Cancel</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="container">

    <div class="row">
        <div class="container">

            <div class="col-md-12" >

                <h2 class="">Art Detail View Statistics<br>
                    <small>The data below represents how many times your art had been viewed by the users in Pikture.</small>
                    </h1>

            </div>
        </div>
    </div>
    <hr style="width: 100%; color: black; height: 1px; background-color:black;" />


    <div class="row">
        <div class="col-lg-12">

            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#graph-one" data-toggle="tab">Graph One</a>
                </li>
                <li><a href="#graph-two" data-toggle="tab">Graph Two</a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="graph-one">
                    <!-- Line chart -->
                    <div class="row">
                        <div class="container" >
                            <br>
                            <center>
                                <div id="curve_chart" style="width: 900px; height: 300px"></div>

                            </center>
                            <br>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="graph-two">
                    <div class="row">
                        <div class="container" >
                            <br>
                            <center>
                                <div id="column_chart" style="width: 900px; height: 300px;"></div>
                            </center>
                            <br>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>






    <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
    <div class="row">

        <div class="container">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-primary btn-lg btn-success pull-right text-center "  style="padding-top: 20px;" data-toggle="modal" data-target="#upload-modal" >Add Image to Gallery</button>
            </div>

        </div>

        <div class = "container" id ="art-thumbnails">
            <div class="row">
                <div id="mainwrapper">

                    <div class = "container art-thumbnails"  id ="art-thumbnails">
                        <br>
                        <div class="row">
                            <div id="mainwrapper">
                                <div id = "artist-images" class="container">
                                    <center> <h2 style = "font-size:55px;"><strong>Manage your Gallery</strong></h2></center>
                                    <br>
                                    <h3><center>Please click on an art to edit it</center></h3>
                                    <hr style="width: 100%; color: black; height: 1px; background-color:black;" />


                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div> <!-- end -->
    </div>
    <!-- /.row -->
</div>
<div id ="standard-footer">
</div>


<!-- Modal -->
<div class="modal fade" id="successfulUpload" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Success</h4>
            </div>
            <div class="modal-body">
                <p>Your image has been uploaded!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


</body>
</html>