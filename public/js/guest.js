$('.delete').on('click', function () {
    var elm = $(this).prev('.input-area');
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
if ($('input[type="checkbox"]').prop('checked')) {
    $('input[type="checkbox"]').parent().css('background-color', 'red');
    console.log('red');
} else {
    $('input[type="checkbox"]').parent().css('background-color', '');
}

$('input[type="checkbox"]').on('click', function() {
    if ($(this).prop('checked')) {
        $(this).parent().animate({
            'backgroundColor' : '#2a61fe',
            'color': '#ffffff'
          }, 200);
    } else {
        $(this).parent().animate({
            'backgroundColor' : 'transparent',
            'color': '#000000'
          }, 200);
    }
});

$('#regist-btn').on('click', function() {
    $('#regist').trigger("click");
});