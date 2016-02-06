"use strict";

$(function() {
	var qtotal = nowCookie('CakeCookie[q_count]');
	$("#q_count").append(qindex + '問目 / 全' + qtotal + '問');
	if (Number(qindex) >= Number(qtotal)) {
		$("#result_link").css("display", "block");
	} else {
		$("#next_link").css("display", "block");
	}
});



