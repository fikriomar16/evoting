function getToken() {
    $.ajax({
        url: '/get_token',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('meta[name="csrf-token"]').attr('content', data.token);
            $('[name="_token"]').val(data.token);
        }
    })
}