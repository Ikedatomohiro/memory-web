$(function () {
    var chkboxes = $('input[type=checkbox]');
    chkboxes.filter(':checked').parent().css({
        'background-color': '#2a61fe',
        'color': '#ffffff',
    });

    var stored = $('#stored').val();
    if (stored == 'true') {
        alert('登録が完了しました。');
    }
});

$('.delete, .delete-s').on('click', function () {
    var elm = $(this).prev('.input-area, .input-other');
    var str = elm.val();
    str2 = str.replace(/.$/, '');
    elm.val(str2);
});

$('#zip_code').on('input', function () {
    var zipcode = $('#zip_code').val();
    let pattern = /^\d{3}-?\d{4}$/;
    var result = pattern.test(zipcode);
    if (result === true) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/zipcode",
            method: 'POST',
            data: {
                'zipcode': zipcode
            },
        })
            //通信が成功したとき
            .then((res) => {
                $('#address').val(res);
            })
            //通信が失敗したとき
            .fail((error) => {
                console.log(error.statusText);
            });
    }
});

$('input[type="checkbox"]').on('click', function () {
    if ($(this).prop('checked')) {
        $(this).parent('.checkbox-label').animate({
            'backgroundColor': '#2a61fe',
            'color': '#ffffff'
        }, 200);
    } else {
        $(this).parent('.checkbox-label').animate({
            'backgroundColor': 'transparent',
            'color': '#000000'
        }, 200);
    }
});

$('#back').on('click', function () {
    var password = prompt('ユーザーパスワードを入力してください');
    if (password !== null) {
        event_hash = $('input[name="event_hash"]').val();
        console.log(event_hash);
    }
});

$('.delete-button').on('click', function () {
    if (confirm('削除してもよろしいですか？')) {
        $(this).next('.execute').trigger('click');
    }
});

$('.execution-button').on('click', function () {
        $(this).next('.execute').trigger('click');
});

$('.record').on('click', function() {
    $(this).find('.execute').get(0).click();
});
