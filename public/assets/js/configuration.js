$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#btn-up-conf').click(function () {
        var dateStart = $('[name="date_start"').val();
        var dateEnd = $('[name="date_end"').val();
        var timeStart = $('[name="time_start"').val();
        var timeEnd = $('[name="time_end"').val();
        var formConfig = $('#formUpdateConfig');
        var url_action = formConfig.attr('action');
        if (dateStart <= dateEnd) {
            if (timeStart < timeEnd) {
                getToken();
                $.ajax({
                    url: url_action,
                    type: 'put',
                    data: formConfig.serialize(),
                    success: function (res) {
                        $('#errorConfig').html('');
                        if (res.success) {
                            miniNotif('success',res.success);
                        }
                        if (res.status === 'error') {
                            miniNotif(res.status,res.message);
                        }
                    },
                    error: function (err) {
                        var errors = err.responseJSON.errors;
                        var msg = '';
                        msg+='<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        msg+='<ul>';
                        $.each(errors, function(i) {
                            msg+='<li>'+errors[i][0]+'</li>';
                        });
                        msg+='</ul>';
                        msg+='<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        $('#errorConfig').html(msg);
                    }
                });
            } else {
                regNotif('Ooopsss','Waktu Mulai tidak boleh kurang dari Waktu Berakhir','error');
            }
        } else {
            regNotif('Ooopsss','Tanggal Mulai tidak boleh kurang dari Tanggal Berakhir','error');
        }
    });
    $('#btn-up-ann').click(function () {
        var formAnnouncement = $('#formUpdateAnnouncement');
        var url_action = formAnnouncement.attr('action');
        getToken();
        $.ajax({
            url: url_action,
            type: 'put',
            data: formAnnouncement.serialize(),
            success: function (res) {
                $('#errorAnnoun').html('');
                if (res.success) {
                    miniNotif('success',res.success);
                }
            },
            error: function (err) {
                var errors = err.responseJSON.errors;
                var msg = '';
                msg+='<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                msg+='<ul>';
                $.each(errors, function(i) {
                    msg+='<li>'+errors[i][0]+'</li>';
                });
                msg+='</ul>';
                msg+='<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                $('#errorConerrorAnnounfig').html(msg);
            }
        });
    });
    $('.btn-reset-user').click(function () {
        Swal.fire({
            title: 'Apakah anda yakin akan mereset data pemilih ?',
            text: 'Proses reset data tidak bisa dibatalkan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                getToken();
                $.ajax({
                    url: $(this).data('url'),
                    type: 'post',
                    success: function (data) {
                        if (data.success) {
                            miniNotif('success',data.success);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        });
    });
    $('.btn-reset-candidate').click(function () {
        Swal.fire({
            title: 'Apakah anda yakin akan mereset data kandidat ?',
            text: 'Proses reset data tidak bisa dibatalkan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                getToken();
                $.ajax({
                    url: $(this).data('url'),
                    type: 'post',
                    success: function (data) {
                        if (data.success) {
                            miniNotif('success',data.success);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        });
    });
    $('.btn-reset-vote').click(function () {
        Swal.fire({
            title: 'Apakah anda yakin akan mereset data voting ?',
            text: 'Proses reset data tidak bisa dibatalkan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                getToken();
                $.ajax({
                    url: $(this).data('url'),
                    type: 'post',
                    success: function (data) {
                        if (data.success) {
                            miniNotif('success',data.success);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        });
    });
});