"use strict";

function checkAnswer() {
    var flg = true;
    var displayAns = [];
    var score = nowCookie(scoreKey);
    if (score == null) {
        score = 0;
    } else {
        score = Number(score);
    }

    for (var i = 0; i < $(".checkbox").children("input").size(); i++) {
        if ($(".checkbox").children("input").eq(i).prop("checked") != answerArray[i]) {
            flg = false;
        }
        if (answerArray[i]) {
            displayAns.push(i+1);
        }
    }
    
    if (flg) {
        score += 1;
        $("#displayAns").append('<span class="ok">正解</span>');
    } else {
        $("#displayAns").append('<span class="miss">不正解 ： 正解は' + displayAns + '番です</span>');
    }
    $("#description").css("display", "block");

    cookieSet(scoreKey, score);
}

$("#answerBtn").bind("click", function() {
    checkAnswer();
    $("#answerBtn").attr('disabled', true);
});
