$(document).ready(function () {

    
    //standard-nav
    $.get("/~s16g10/common/header.php", function (data) {
        $("#standard-nav").append(data);
    });

    //standard-footer
    $.get("/~s16g10/common/footer.html", function (data) {
        $("#standard-footer").append(data);
    });


    $("#art-thumbnails img").click(function () {
//        var curr_url = document.URL.substr(0, document.URL.lastIndexOf('/'));
        window.location.href = "/~s16g10/art-settings/art_settings.html" + "?imgUrl=test.jpg";
    });


    //$(".btn-group>.btn:first-child").text()
    $(".dropdown-menu li a").click(function (event) {
        event.preventDefault();

        var selText = $(this).text();
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');

    });

     $("#upload-button").click(function (e) {

     $(".btn-load").button('loading').delay(2000).queue(function () {
                    $(".btn-load").button('reset');
                    $(".btn-load").dequeue();
     
      
        });

     });

    $("form#data").submit(function () {
     
      $(".btn-load").button('loading').delay(2000).queue(function () {
                    $(".btn-load").button('reset');
                    $(".btn-load").dequeue();
                    $('#upload-modal').modal('hide');
      
        });

        var formData = new FormData($(this)[0]);
        
        console.debug(formData);
        
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
         
             showModal();
   
            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });


    var searchString = "";
    var type = 1;

    populateImages(searchString, type);

    function populateImages(searchString, type) {
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ImageSearch.php",
            type: "POST",
            dataType: "json", // data type
            data: {"searchValue": searchString,
                "searchDescription": type},
            success: function (data) {

                console.debug(data);

                var row_counter = 3;

                for (i = 0; i < data.length; i++) {

                    if (row_counter == 0)
                    {
                        $("#artist-images").append("<div class='row stylish-panel'></div>");
                        row_counter = 3;
                    }

                    $("#artist-images .row:last-child").append(
                        "<div class='col-md-4 col-sm-6 col-xs-12' style = 'padding: 10px;'>" +
                        "<div style = 'background: white; border:10px solid white;'>" +
                        "<div class='box'>" +
                        "<span id='pointer-icon' class='thumbnail' style = 'border:1px solid white !important;'>" +
                        " <img src='" + data[i].img_path_medium + "' data-id ='" + data[i].id + "' data-title ='" + data[i].title + "' data-description ='" + data[i].description + "' data-artist-id ='" + data[i].artist_id + "' class='img-detail image-float img-responsive img-rounded img-thumbnail'>" +
                        "<span class='img-detail caption scale-caption' data-id ='" + data[i].id + "'>" +
                        "   <h3><strong>Click to edit art</strong></h3>" +
                        " </span>" +
                        "</span>" +
                        "</div>" +
                        " <div class='caption' style='padding-left:15px; padding-right:15px;'>" +
                        " <h4>" + data[i].title + "<br> " +
                        //" <button type='button' class='btn btn-primary btn-lg center-block text-center outline' style = 'margin-top:10px;'  data-toggle='modal' data-target='#myModal'>Edit</button></h4>" +
                        " </div>" +
                        "</div>" +
                        "</div>"
                    );
                    row_counter--;

                }

                $(".img-detail").click(function () {
                    var id = $(this).attr("data-id");
                    window.location.href = "/~s16g10/art-settings/art_settings.html" + "?id=" + id;
                });

            },
            error: function (xhr, resp, text) {
                console.log(xhr, resp, text);

            }
        });
    }



});




function submitArtItem() {

    /*
     if(validateTitle() &&
     validatePath() &&
     validateLicense() &&
     validateDescription() &&
     validateCategory() &&
     validateKeywords()){
     uploadArt(showModal);
     }
     */
    var artist_id
    var path = $("#image-path").val();
    var title = $("#image-title").val();
    var description = $("#image-description").val();
    var web = $("#image-web-price").val();
    var print = $("#image-print-price").val();
    var unlimited = $("#image-unlimited-price").val();






}

function validateTitle() {

    if ($("#image-title").val() == "") {
        $("#title-section").addClass("has-error has-feedback");
        return false;
    } else
        return true;
}

function validatePath() {
    if ($("#image-path").val() == "") {
        $("#image-section").addClass("has-error has-feedback");
        return false;

    } else
        return true;
}

function validateLicense() {
    if ($("#image-description-price").val() == "" && $("#image-web-price").val() == "" && $("#image-unlimited-price").val() == "") {
        $("#licenses-section").addClass("has-error has-feedback");
        return false
    } else
        return true;
}

function validateDescription() {
    if ($("#image-description").val() == "") {
        $("#description-section").addClass("has-error has-feedback");
        return false;

    } else
        return true;
}

function validateCategory() {
    if ($(".btn-group>.btn:first-child").text() == "") {
        $("#description-section").addClass("has-error has-feedback");
        return false;

    } else
        return true;
}

function validateKeywords() {
    if ($("#image-keywords").val() == "") {
        $("#keyword-section").addClass("has-error has-feedback");
        return false;

    } else
        return true;
}


function showModal() {

    $('#successfulUpload').modal('show');

}