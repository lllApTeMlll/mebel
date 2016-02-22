$(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        if (valid(form)) {
            var data = form.serializeArray();
            console.log(data);
            $.ajax({
                type: 'POST', data: data, url: '/fasadm/avtoris/', dataType: 'text',
                success: function (data) {
                    console.log(data);
                    try {
                        var event = JSON.parse(data);
                        console.log(event.result);
                        switch (event.result) {
                            case 'ok':
                                console.log("ok");
                                $.growl.notice({ message: "Вы авторизовались" });
                                setTimeout(function () {
                                    location.reload();
                                }, 500);
                                pr = true;
                                break;
                            case 'no':
                                console.log("no");
                                $.growl.error({ message: event.mess });
                                form.find(".form-group").addClass("has-error");
                                pr = false;
                                break;
                            default:
                                $.growl.error({ message: "Ошибка" });
                                break;
                        }
                    } catch (e1) {
                        $.growl.error({ message: e1 });
                        console.log(e1);
                    }
                }
            });
        }
    });
}); 