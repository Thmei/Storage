$(document).ready(function(){
    
    
    var id = getParameterByName("id");
    getArtDetails(id,populateArtFields);

    //standard-nav
    $.get("/~s16g10/common/header.php", function (data) {
        $("#standard-nav").append(data);
    });

    //standard-footer
    $.get("/~s16g10/common/footer.html", function (data) {
        $("#standard-footer").append(data);
    });

    
    //Saving 
    $('#save').click(function()
    {
        saveSettings();
    });
    //delete
    $("#delete").click(function ()
    {
        deleteArt();
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
    
    function deleteArt()
    {
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: "POST",
            dataType: "json",//json
            data: {'action': 'delete', 'artist_id' : 123},
            success: function(data){
                
            },
            error: function(data){
                
            }
        });
    }
    
    function saveSettings()
    {
        //storing form information into variables 
        var title = $('#title').val();
        var desc = $('#description').val();
        var keywords = $('#keywords').val();
        var category = $('#category').val();
        var unlimited = $('#unlimited').val();
        var web = $('#web').val();
        var print = $('#print').val();
        
        //function updateArtItemDetail(artId, artItemDetails)
    }
    
    var artId = getParameterByName("id");
    
    getArtDetails(artId,populateArtFields);
    
    
    function getParameterByName(name, url) 
    {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)", "i"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    
    
    
    
    
});

function populateArtFields(data){
    console.debug(data);
        $("#title").val(data.title);
        $("#title").attr("placeholder", "");
        
        $("#description").val(data.description);
        $("#description").attr("placeholder", "");
        
        $("#unlimited-price").val(data.license_unlimited);
        $("#unlimited-price").attr("placeholder", "");
        
        $("#web-price").val(data.license_web);
        $("#web-price").attr("placeholder", "");
        
        $("#print-price").val(data.license_print);
        $("#print-price").attr("placeholder", "");
        
        
        $("#view-image").attr("src", data.img_path);
        //$("#view-image").attr("src", test.jpg);
       
}





