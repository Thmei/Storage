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
});



