$('.delete').on('click', function () {
    var elm = $(this).prev('.input_area');
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
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            url: "/zipcode",
            method: 'POST',
            data: {
            'zipcode': zipcode
            },
        })
        //通信が成功したとき
        .then((res) => {
            console.log(res);
            $('#address').val(res);
        })
        //通信が失敗したとき
        .fail((error) => {
            console.log(error.statusText);
        });
    }
});

