"use strict";

//クッキー保存期間
var cookieExpires = 1;
var scoreKey = "q_score";

//現在クッキー確認関数

function nowCookie(key) {
    return $.cookie(key);
}

//クッキー設定関数

function cookieSet(cookieKey, param) {
    $.cookie(cookieKey, param, {
        path: "/",
        expires: cookieExpires
    });
}
