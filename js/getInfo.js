/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
     $.ajax({
            url: '../app/controllers/overview/getOverview.php',
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
    $.each(data, function(key, value) {
        $("#puzzletable tbody").append("<tr>");
        $.each(value, function(key, value) {
            $("#puzzletable tbody").append("<td>" + value + "</td>")
        })
        $("#puzzletable tbody").append("</tr>");
    });
}