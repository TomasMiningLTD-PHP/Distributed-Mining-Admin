/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
   $('[name="passwordre"]').blur(function(){
       if($(this).val() === $(this).parent().children('[name="password"]').val() && $(this).val() !== ""){
           $(this).css('border','1px solid #0C3');
       }
       else
          $(this).css('border','1px solid #900');
   });
   $('[name="ip"]').blur(function(){
       if(isServerAddr($(this).val())){
           $(this).css('border','1px solid #0C3');
       }
       else
          $(this).css('border','1px solid #900');
   });
   $('.input').blur(function(){
       if($(this).attr('name') !== "passwordre" && $(this).attr('name') !== "ip"){
           if($(this).val() !== "")
              $(this).css('border','1px solid #0C3');
           else
              $(this).css('border','1px solid #900');
      } 
   }); 
   $('.select').blur(function(){
       if($(this).attr('name') !== "passwordre")
        $(this).css('border','1px solid #0C3');
   }); 
});
function isServerAddr(addr) {
	var regex = new RegExp(/^(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))\.(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))\.(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))\.(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))$/);
	return regex.test(addr);
} 