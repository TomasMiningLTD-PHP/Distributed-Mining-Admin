/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-10px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","30px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-10px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","30px");
	});
});