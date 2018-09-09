
$(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });

    $('body').on('click', '.remove-project', function () {
      $(this).siblings('form').submit();
    });

    $("body").on("click", ".remove-task", function () {
            $(this).siblings("form").submit();
        });

        $('.task_checkbox').click(function () {
            var url = "/tasks/change_status/" + $(this).siblings('input[name="task_id"]').val();
            $.post({
                url: url
            })
        });
});
