/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    //standard-nav
    $.get("/~s16g10/common/header.php", function (data) {
        $("#standard-nav").append(data);
    });

    //standard-footer
    $.get("/~s16g10//common/footer.html", function (data) {
        $("#standard-footer").append(data);
    });
    
    $("#art-thumbnails img").click(function(){
//    var curr_url = document.URL.substr(0,document.URL.lastIndexOf('/'));  
    
    var img_url;
    img_url = $(this).attr('src');
    img_url = img_url.replace('../img/sm_', '../img/');
    

    window.location.href ="/~s16g10/art-detail/index.html" + "?imgUrl=" + img_url ;
});

//Preloader

$(window).load(function() { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.

    $('body').delay(350).css({'overflow':'visible'});

});


var id = getParameterByName("artistId");
getUserData(id,populateArtistFields);


//artist-thumbnails

$('.artist-thumbnails img').click(function (e) {
        
        
//        var curr_url = document.URL.substr(0,document.URL.lastIndexOf('/'));  
        var search_string = $('#searchInput').val();
        
        window.location.href = "/~s16g10/artist-account/index.html" ;

       
    });

    $('#search-button').click(function (e) {
        
        
//        var curr_url = document.URL.substr(0,document.URL.lastIndexOf('/'));  
        var search_string = $('#searchInput').val();
        
        window.location.href =  "/~s16g10/browse/index.html" + "?searchString=" + search_string ;

       
    });
    
        $(document).keypress(function(e) {
    if(e.which == 13) {
//        var curr_url = document.URL.substr(0,document.URL.lastIndexOf('/'));  
        var search_string = $('#searchInput').val();
        
        window.location.href = "/~s16g10/browse/index.html" + "?searchString=" + search_string ;


    }
});

    var searchString = "";
    var type = 1;
    
    populateImages(searchString, type);
    
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
                
                for (i = 0; i < 11; i++) {
                    
                    if(row_counter == 0)
                    {
                        $("#your-images").append("<div class='row stylish-panel'></div>");
                        row_counter = 3;
                    }
                    
                    $("#your-images .row:last-child").append(
                     "<div class='col-md-4 col-sm-6 col-xs-12' style = 'padding: 10px;'>"+
                                    "<div style = 'background: white; border:10px solid white;'>"+
                                        "<div class='box'>"+
                                            "<span id='pointer-icon' class='thumbnail' style = 'border:1px solid white !important;'>" +
                                               " <img src='" + data[i].img_path_medium + "' id='image' data-id ='" + data[i].id + "' data-title ='" + data[i].title + "' data-description ='" + data[i].description + "' data-artist-id ='" + data[i].artist_id + "' class='img-detail image-float img-responsive img-rounded img-thumbnail'>" +
                                                "<span class='img-detail caption scale-caption' data-id ='" + data[i].id +"'>" +
                                                 "   <h3><strong>Click to <br>view more details</strong></h3>" +
                                               " </span>" +
                                            "</span>" +
                                        "</div>" +
                                       " <div class='caption' style='padding-left:15px; padding-right:15px;'>" +
                                           " <h4>" + data[i].title + "<br> " +
                                           " <button type='button' id='view' data-id ='" + data[i].id +"' class='btn btn-primary btn-lg center-block text-center outline view ' style = 'margin-top:10px;'>View</button></h4>" +
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
                $(".view").click(function(){
                    console.log("here");
                    //var e = GetElementInsideContainer("div1", "edit1");
                    var id = $(this).attr("data-id");
                 window.location.href = "/~s16g10/art-detail/index.html" + "?id=" + id;
                });
          
            },
            error: function (xhr, resp, text) {
                console.log(xhr, resp, text);

            }
        });
}


    
   function getParameterByName(name, url) {
        if (!url)
            url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)", "i"),
                results = regex.exec(url);
        if (!results)
            return null;
        if (!results[2])
            return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    } 
});






function populateArtistFields(data){
console.debug(data);

    $("#artist-name").text(data.first_name + " " + data.last_name);
    $("#about").text(data.about);
    $("#email").text(data.email);
    $("#profile-image").attr("src", data.profile_img);
}
