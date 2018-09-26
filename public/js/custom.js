
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

    $('body').on('click', '.ordering .fa', function () {

      var task =  $(this).closest('.task');
        var target_id = task.find('input[name=task_id]').val();
        var target_order = task.find('input[name=order]').val();
        var direction = $(this).hasClass('fa-angle-up');
        var replacement = direction ? task.prev() : task.next();
        var replacement_id = replacement.find('input[name=task_id]').val();
        var replacement_order = replacement.find('input[name=order]').val();
        $('input[name=target_id]').val(target_id);
        $('input[name=replacement_id]').val(replacement_id);
        $(this).siblings("form").submit();
        console.log($(this).siblings("form"));
        // if (replacement_id) {
        //     $.post({
        //         url: '/tasks/order',
        //         data: {
        //             target_id: target_id,
        //             replacement_id: replacement_id
        //         },
        //         success(response) {
        //           window.location.href = '/projects'
        //         }
        //     });
        // }
    });
    $(document).ready(function(){
        var ml=$(".navbar").outerWidth();
        ml /= 3;
        $(".navbar-brand").css({"margin-left":ml});
    });
});
