"use strict";

$(function () {
  $('form').submit(function () {

    $(this).find(':submit').attr('disabled', 'disabled');
    $(this).find(':submit').val('処理中...');
  });
});