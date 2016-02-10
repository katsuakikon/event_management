"use strict";

$(function(){ 
  $('#check_group').on('change', function() { 
    $('.' + this.id).prop('checked', this.checked); 
  }); 
}); 


$(function () {
  $('form').submit(function () {
  	var check_count = $('.check_group:checked').length;
    if (check_count == 0 ){
        alert('出力対象が選択されていません。');
        return false;
    }

    $(this).find(':submit').attr('disabled', 'disabled');
    $(this).find(':submit').val('処理中...');
  });
});