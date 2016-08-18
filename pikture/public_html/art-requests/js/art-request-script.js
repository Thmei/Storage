/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    getArtRequests(artRequests);
    
});


function artRequests(data){
    
   console.log(data[0]);
   
   $("#request-accordion").append(
    "<div class='panel panel-default'>" +
    "  <div class='panel-heading'>" +
      "  <a data-toggle='collapse' data-parent='#request-accordion' href='#collapse1'><h4 class='panel-title'>" +
        "  <span class = 'art-item-title'>" +data[0].title +"</span><span class='glyphicon glyphicon-chevron-down pull-right'></span>" +
       " </h4></a>" +
    "  </div>" +
    "  <div id='collapse1' class='panel-collapse collapse in'>" +
        "  <div class='panel-body'>" +
                  "        <h4 >Description:<span class = 'art-item-description'>" +data[0].description +" </span> </h4>" +
                            "        <h4>Price offer: $<span class = 'art-item-price'> "+data[0].price_offer +" </span> </h4>" +
                                  "  <h4 >Customer: <span class = 'art-item-customer'>" +data[0].customer_id +" </span> </h4>" +
                                  "  <center>" +
                                   "     <button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>Accept Request</button>" +
                                   " </center>" +
        "  </div>" +
      "</div>" +
  "  </div>");


  for(i = 1; i < data.length ; i++){

   $("#request-accordion").append(
    "<div class='panel panel-default'>" +
    "  <div class='panel-heading'>" +
      "  <a data-toggle='collapse' data-parent='#request-accordion' href='#collapse"+ (i+1)+ "'><h4 class='panel-title'>" +
        "  <span class = 'art-item-title'>" +data[i].title +"</span><span class='glyphicon glyphicon-chevron-down pull-right'></span>" +
       " </h4></a>" +
    "  </div>" +
    "  <div id='collapse" + (i+1)+ "' class='panel-collapse collapse'>" +
        "  <div class='panel-body'>" +
                          "        <h4 >Description:<span class = 'art-item-description'>" +data[i].description +" </span> </h4>" +
                        "   <h4 >Category:<span class = 'art-item-category'>" +data[i].category +" </span> </h4>" +
                            "        <h4>Price offer: $<span class = 'art-item-price'>" +data[i].price_offer +" </span> </h4>" +
                                  "  <h4 >Customer: <span class = 'art-item-customer'>" +data[i].customer_id +" </span> </h4>" +
                                  "  <center>" +
                                   "     <button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>Accept Request</button>" +
                                   " </center>" +
        "  </div>" +
      "</div>" +
  "  </div>" 
           
                );
  }
  
  
  
   
}