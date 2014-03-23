/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
     $.ajax({
            url: 'overview/getOverview',
            type: 'post',
            dataType: 'json',
            success: function(data) {
                fillTable(data);
            },
            error: function(result) {
                var msg = $.parseJSON(result);
                alert("error " + msg);
            }
        });
        
        
});
function fillTable(data) {
    tmp = 1;
    $.each(data, function(key, value) {
        
        $("#main_wrapper").append('<div class="info_wrapper"><div class="info_header" value="'+ tmp+'"><div class="float_none"></div></div><div class="float_none"></div><div class="info_body" value="'+ tmp+'"></div>');
        $.each(value, function(key, value) {
            if(key === "temp"){
                var counter = 1;
                $.each(value, function(key, value){
                   $(".info_body[value="+tmp+"]").append('<div class="info_body_element"><h4>GPU '+ counter +': </h4><span>'+ value +'c</span></div>'); 
                   counter++; 
                });
            }
            else if(key === "time"){
                
            }
            else{
                $(".info_header[value="+tmp+"]").append('<div class="info_header_element"><h4>' + key +'</h4><p>' + value + '</p></div>');
            }
        });
        $("#main_wrapper").append('<div class="float_none"></div>');
        tmp++;
    });
}