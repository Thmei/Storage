

$(document).ready(function () {

    getTopViews(12, searchResults);
    
   // var searchInput = getParameterByName("searchString");

    $("#sidebar-nav .nav-item").first().addClass('active');
   // searchString("flower", searchType, searchResults);

    $("#search-alert").hide();
    $('#searchInput').val(getParameterByName("searchString"));
 
    //standard-nav
    $.get("/~s16g10/common/header.php", function (data) {
        $("#standard-nav").append(data);
    }); 

    //standard-footer
    $.get("/~s16g10/common/footer.html", function (data) {
        $("#standard-footer").append(data);
    });


    //when user clicks on category
    //type is 0
    $('.nav-item .nav-link').click(function (e) {

        var search_value = $(this).text();

        $('#searchInput').val(search_value);

        searchString(search_value, "", searchResults);

        e.preventDefault();

    });


    //when user searches in the search box   
    //type is 1
    $('#search-button').click(function (e) {
      
        searchString($('#searchInput').val(), "", searchResults);
        e.preventDefault();

    });

    $(document).keypress(function (e) {
        if (e.which == 13) {
                   searchString($('#searchInput').val(), "", searchResults);


            e.preventDefault();
        }
    });


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


function searchResults(data) {
    
    $("#search-results").empty();

    console.debug(data);

    var row_counter = 3;

    $("#search-results").append("<div class='row stylish-panel'></div>");

    for (i = 0; i < data.length; i++) {

        if (row_counter == 0)
        {
            $("#search-results").append("<div class='row stylish-panel'></div>");
            row_counter = 3;
        }

        $("#search-results .row:last-child").append(
                "<div class='col-md-4 col-sm-6 col-xs-12' style = 'padding: 10px;'>" +
                "<div style = 'background: white; border:10px solid white;'>" +
                "<div class='box'>" +
                "<span id='pointer-icon' class='thumbnail' style = 'border:1px solid white !important;'>" +
                " <img src='" + data[i].img_path_medium + "' data-id ='" + data[i].id + "' data-title ='" + data[i].title + "' data-description ='" + data[i].description + "' data-artist-id ='" + data[i].artist_id + "' class='img-detail image-float img-responsive img-rounded img-thumbnail'>" +
                "<span class='img-detail caption scale-caption' data-id ='" + data[i].id + "'>" +
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

               
           $("#search-alert").show();
           $("#search-alert span").html("<strong>" + data.length + "</strong>" + " search result(s) found.");

}







