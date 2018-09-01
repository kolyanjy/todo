$(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });

    $('body').on('click', '.remove-project', function () {
      $(this).siblings('form').submit();
    });



});
