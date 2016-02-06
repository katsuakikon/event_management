"use strict";

$(function() {
	var qtotal = nowCookie('CakeCookie[q_count]');
	$("#result").append('全' + qtotal + '問中  ' + nowCookie(scoreKey) + '問正解');
});



