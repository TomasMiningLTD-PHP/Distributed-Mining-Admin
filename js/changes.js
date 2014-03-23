/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    fillpool();
});
function fillpool(){
    $.ajax({
            url: 'changes/getChanges',
            type: 'post',
            dataType: 'json',
            success: function(data) {
                $.each(data,function(key,value){
                    $("#fillpool").append("<option name=" + value +">" + value + "</option>");
                });
            },
            error: function(result) {
                var msg = $.parseJSON(result);
                alert("error " + msg);
            }
     });
}