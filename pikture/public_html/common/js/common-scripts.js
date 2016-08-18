/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('#user_name').keypress(function(e){
      if(e.keyCode==13)
      $('#sign-in-submit').click();
    });
    
    $('#password').keypress(function(e){
      if(e.keyCode==13)
      $('#sign-in-submit').click();
    });
    
    
    
    
});

/*
 * action:getUserId
 * 
 */
    function getUserId()
    {
        //TODO
        //Returns the user id
                
        $.ajax({
            url: "/~s16g10/pikture_data_engine/User.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "getUserId"},
            success: function (data) {
                return data;
            }
        
        });
    
    };
    
 /*
  * action: getUserTopArt
  * id: userId
  * max_results: maxResults
  */
 
    function getUserTopArt(userId, maxResults){
        
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "getUserTopArt",
                   "id": userId,
                   "max_results": maxResults},
            success: function (data) {
                return data;
            }
         
        });
    };
    
    


    

/*
 * action: getArt
 * artist_id: artistId
 */
 
    function getArt(artistId, callBack)
    {
        //TODO
        //returns the path of the art of the specified artist given from art  
        
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "getByArtistID",
                   "artist_id": artistId},
            success: function (data) {
                callBack(data);
            }
         
        });
    };

/*
 * action: getPopularArt
 * max_results: maxResults
 */
    function getMostPopularArt(maxResults)
    {
        //TODO
        //returns the most popular art from the database
        
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "getPopularArt",
                   "max_results": maxResults},
            success: function (data) {
                return data;
            }
         
        });
    };

/*
  * action: incrementViewCount
  * id: artId
  * 
  */
    function incrementViewCount(artId){
        
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "incrementViewCount",
                "id": artId},
            success: function(data){
                console.debug(data);
                callBack(data);
            },
            error: function (xhr, resp, text) {
                console.log(xhr, resp, text);

            }
         
        });
    };
/*
 * action:getTopViews
 * max_results: maxResults
 */

    function getTopViews(maxResults,callBack)

    {
        //TODO
        //Returns the user id
        
                
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "getTopViews",
                    "max_results": maxResults},
            success: function (data) {

                callBack(data);

                console.debug(data);
                callBack(data);
            },
            error: function (xhr, resp, text) {
                console.log(xhr, resp, text);

            }
        
        });
    
    };


/*
 * action:updateArtDetail
 * id: artId
 * art_details: artItemDetails
 * 
 */
    function updateArtItemDetail(artId, artItemDetails)
    {   
        //TODO
        //Updates the database with the values inputed in the paramater for specific art item
        
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "updateArtDetail",
                    "id" : artId,
                   "art_details": artItemDetails},
            success: function (data) {
                return data;
            }
         
        });
    };

/*
 * action:uploadArtRequest
 * art_request_details: artRequestDetails
 * 
 */

    function uploadArtRequest(artRequestDetails)
    {
        //TODO
        //upload the art request
        
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtRequest.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "upload_art_request",
                   "art_request_details": artRequestDetails},
            success: function (data) {
                return data;
            }
         
        });
    };

/*
 * action: getUserInfo
 * id: userId
 */
    function getUserData(userId,callBack)
    {
      //TODO
      //returns requested data of the given user
              
   $.ajax({
            url: "/~s16g10/pikture_data_engine/User.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "get_user_info",
                   "id": userId},
            success: function (data) {
                callBack(data);
                console.debug(data);
            }
         
        });
    };


    function signUp(arrayOfThingsInSignUpForm)
    {
      //TODO
      //checks database if the username is already in use, if not then 
      //insert
    };
    
    
    function logIn(username, password)
    {
      //TODO
      //Check if the username and password matches with a row and then log the
      //user in and start a new seesion with that user
    };

  


/*
 * action: getArtDetails
 * id: ArtId
 */
    function getArtDetails(artId,callBack)
    {
        //TODO
        //return a json object with details for the passed in artid
        
        $.ajax({
            //url: "artDetailResponseTest.json",
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "getArtDetails",
                   "id": artId},
            success: function(data){
                console.debug(data);
                callBack(data);
            },
               error: function (xhr, resp, text) {
                console.log(xhr, resp, text);

            }
         
        });
        
        
    };
/*
 * action: deleteArt
 * id: ArtId
 * }
 */ 
    function deleteArt(artId, callBack)
    {
        //TODO
        //deletes the row of the image in the database
        
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItemHandler.php",
            type: "",
            dataType: "json", // data type
            data: {"action": "deleteArt",
                   "id": artId},
            success: function(data){
                callBack(data);
            },
               error: function (xhr, resp, text) {
                console.log(xhr, resp, text);

            }
         
        });
        
        
    };
 

/*
 * action: getArtRequests
 */

    function getArtRequests(callBack){
        //TODO
        //returns all of the submitted art requests
                
        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtRequest.php",
            //url: "artRequestResponseTest.json",
            type: "POST",
            dataType: "json", // data type
            data: {"action": "getArtRequest"},
            success: function(data){
 
                callBack(data);
               // console.log(data);
            },
               error: function (xhr, resp, text) {
                console.log(xhr, resp, text);

            }
         
        });

    };
    
/*
 * action: getByArtistID
 * 
 */

function getByArtistID(artId,callBack){
    $.ajax({
        url: "/~s16g10/pikture_data_engine/ArtItem.php",
        type: "POST",
        dataType: "json",
        data: { "action": "getByArtistID",
                "id": artID},
        success: function(data){
            callBack(data);
        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp, text);
        }
    });
    
};
   
   
 
    
    //action upload
    //title
    //decription
    //category
    //
    

function uploadArt(artist_id, title, description, category, keywords, path, web, print, unlimited){
  //if(web||print||unlimited){
    //verify all other parameters, no need to be fancy
    //assign the form values to an array of "param_name"=>"value"
    $.ajax({
        url: "/~s16g10/pikture_data_engine/ArtItem.php",
        type: "POST",
        dataType: "json",
        data: { "action": "upload",
                "artist_id": artist_id,
                "title": title,
                "description" : description,
                "category" : category,
                "keywords" : keywords,
                "img_path" : path ,
                "web" : web,
                "print" : print,
                "unlimited" : unlimited
 
            },
        success: function(data){
            callBack(data);
        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp, text);
        }
    });

  //}
  //else{
    //notify the user that they need to select a license
 // }
};


function searchString(searchString, searchType, callBack){


        $.ajax({
            url: "/~s16g10/pikture_data_engine/ArtItem.php",
            type: "POST",
            dataType: "json", // data type
            data: {"action" : "search",
                "title": "",
                "description": searchString,
          "category": ""},
        success: function(data){
            callBack(data);
            console.debug(data);
        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp, text);
        }
    });
    
}