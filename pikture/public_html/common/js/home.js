/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    getUserData(187);
    
    $(".img-detail").click(function(){
       alert();
    });
    
    
    $(".user").click(function(){
        var id = $(this).attr("data-artist-id");
        var url = "/~s16g10/user-profile/index.php" + "?artistId=" + id;
        window.location.href = url;
    });
    
    var searchString = "";
    var type = 1;
    
    populateCarousel(searchString, type);
    
    var searchString = "";
    var type = 1;
    
    populateImages(searchString, type);
        
    //standard-nav
    $.get("/~s16g10/common/header.php", function (data) {
        $("#standard-nav").append(data);
    });

    //standard-footer
    $.get("/~s16g10/common/footer.html", function (data) {
        $("#standard-footer").append(data);
    });
    
//Preloader

$(window).load(function() { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.

    $('body').delay(350).css({'overflow':'visible'});

});
    
function populateCarousel(searchString, type){
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ImageSearch.php",
            type: "POST",
            dataType: "json", // data type
            data: {"searchValue": searchString,
                "searchDescription": type},
          
            success: function (data) {
                
                console.debug(data);
                
                    $("#carousel-images").append("<div class='item active'>" +
                       " <img src='"+ data[1].img_path + "' alt='"+ data[1].description +"'>" +
                        "<div class='carousel-caption'>" +
                            "<h2>See more by this artist by clicking <a href='/~s16g10/user-profile/index.php'><strong>here</strong></a></h2>" +
                       " </div>" +
                    "</div>");
                    
  
                
                //loop through the rest of results and add as items to the carousel inner
                for (i = 1; i < 3; i++) {
                    

                    $("#carousel-images").append("<div class='item'>" +
                       " <img src='"+ data[i].img_path  + "' alt='"+ data[i].description +"'>" +
                        "<div class='carousel-caption'>" +
                            "<h2>See more by this artist by clicking  <a href='/~s16g10/user-profile/index.php'><strong>here</strong></a></h2>" +
                       " </div>" +
                    "</div>");
                    
                    
                }
          
          
            },
            error: function (xhr, resp, text) {
                console.log(xhr, resp, text);

            }
        });
}


    
    
    
    
    function populateImages(searchString, type){

        $.ajax({
            url: "/~s16g10/pikture_data_engine/ImageSearch.php",
            type: "POST",
            dataType: "json", // data type
            data: {"searchValue": searchString,
                "searchDescription": type},
          
            success: function (data) {
                
                console.debug(data);
                
                var row_counter = 3;
                
                for (i = 0; i < 9; i++) {
                    
                    if(row_counter == 0)
                    {
                        $("#popular-images").append("<div class='row stylish-panel'></div>");
                        row_counter = 3;
                    }
                    
                    $("#popular-images .row:last-child").append(
                     "<div class='col-md-4 col-sm-6 col-xs-12' style = 'padding: 10px;'>"+
                                    "<div style = 'background: white; border:10px solid white;'>"+
                                        "<div class='box'>"+
                                            "<span id='pointer-icon' class='thumbnail' style = 'border:1px solid white !important;'>" +
                                               " <img src='" + data[i].img_path_medium + "' data-id ='" + data[i].id + "' data-title ='" + data[i].title + "' data-description ='" + data[i].description + "' data-artist-id ='" + data[i].artist_id + "' class='img-detail image-float img-responsive img-rounded img-thumbnail'>" +
                                                "<span class='img-detail caption scale-caption' data-id ='" + data[i].id +"'>" +
                                                 "   <h3><strong>Click to <br>view more details</strong></h3>" +
                                               " </span>" +
                                            "</span>" +
                                        "</div>" +
                                       " <div class='caption' style='padding-left:15px; padding-right:15px;'>" +
                                           " <h4>" + data[i].title + "<br> " +
                                           " <button type='button' class='btn btn-primary btn-lg center-block text-center outline' style = 'margin-top:10px;'  data-toggle='modal' data-target='#myModal'>BUY</button></h4>" +
                                       " </div>" +
                                    "</div>" +
                                "</div>" 
                    );
                    row_counter--;
                    
                }
          
                $(".img-detail").click(function () {
                  var id = $(this).attr("data-id");
                 window.location.href = "/~s16g10/art-detail/index.html" + "?id=" + id;
                    });
          
            },
            error: function (xhr, resp, text) {
                console.log(xhr, resp, text);

            }
        });
}
    
});



  