$('.delete').click(function() {
    var elm = $(this).prev('.input_area');
    var str = elm.val();
    str2 = str.replace(/.$/, '');
    elm.val(str2);
});