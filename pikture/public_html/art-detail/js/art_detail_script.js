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
    $.get("/~s16g10/common/footer.html", function (data) {
        $("#standard-footer").append(data);
    });

    
    
var id = getParameterByName("id");
getArtDetails(id, artDetails);
incrementViewCount(id);

var searchString = "";
var type = 1;
populateImages(searchString, type);

$("#artist-profile-button").click(function(){
      var id = $(this).attr("data-artist-id");
        var url = "/~s16g10/user-profile/index.php" + "?artistId=" + id;
        window.location.href = url;
});

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
                
                for (i = 6; i < 15; i++) {
                    
                    if(row_counter == 0)
                    {
                        $("#more-images").append("<div class='row stylish-panel'></div>");
                        row_counter = 3;
                    }
                    
                    $("#more-images .row:last-child").append(
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
                                           " <button type='button' data-id ='" + data[i].id +"' class='btn btn-primary btn-lg center-block text-center outline view' style = 'margin-top:10px;'  data-toggle='modal' data-target='#myModal'>View</button></h4>" +
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
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)", "i"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}



//$("#view-image").append(
        //"<img src = '" + url + "' style = 'max-width: 700px;'>" );

        
});





function artDetails(data){
   console.debug(data);
   $("#image-title").text(data.title);
    $("#image-description").text(data.description);
     $("#image-id").text(data.id);
     $("#image-view-count").text(data.view_count);
     $("#image-artist").text(data.artist_id);
      $("#image-keywords").text(data.keywords);
     $("#image-web").text(data.license_web);
     $("#image-print").text(data.license_print);
     $("#image-unlimited").text(data.license_unlimited);
   $("#view-image").attr("src", data.img_path);
   
    $("#artist-profile-button").attr("data-artist-id", data.artist_id);
   
}