$(function () {
    $('.button').click(function () {
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
                                sendMesseg("Вы авторизовались", "");
                                setTimeout(function () {
                                    location.reload();
                                }, 500);
                                pr = true;
                                break;
                            case 'no':
                                console.log("no");
                                sendMesseg(event.mess);
                                pr = false;
                                break;
                            default:
                                sendMesseg("Ошибка", "");
                                break;
                        }
                    } catch (e) {
                        sendMesseg("Ошибка", "");
                    }
                }
            });
        }
    });
}); 