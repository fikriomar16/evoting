$(document).ready(function(){
    var userTable = $('#userTable');
    var url_action = $('#formDataUser').attr('action');
    var url = url_action+"/get-user";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    userTable.DataTable({
        processing: false,
        serverSide: true,
        responsive: true,
        buttons: ['pdf'],
        ajax: {url: url, type: "POST"},
        columns: [
            {data: 'DT_RowIndex', name : 'DT_RowIndex'},
            {data: 'username', name : 'username'},
            {data: 'name', name : 'name'},
            {data: 'active', name : 'active'},
            {data: 'birth_date', name : 'birth_date'},
            {data: 'created_at', name : 'created_at'},
            {data: 'updated_at', name : 'updated_at'},
            {data: 'action', name : 'action', orderable: false, searchable: false},
        ]
    });
    function reloadUserTable() {
        userTable.DataTable().ajax.reload();
    }
    $('body').on('click', '.btn-reload-table', function () {
        reloadUserTable();
    });
    function check_active() {
        if ($('#is_active').is(":checked")) {
            $('#label_is_active').text('Aktif');
        } else {
            $('#label_is_active').text('Nonaktif');
        }
    }
    $('#is_active').change(function () {
        check_active();
    });
    $('.btn-open-modal').click(function () {
        $('#formDataUser')[0].reset();getToken();
        $('.btn-simpan-edit').addClass('d-none');
        $('#errorMessage').html('');
        $('.btn-simpan').removeClass('d-none');
        $('#is_active').prop('checked', false);
        check_active();
    });
    $('.btn-simpan').click(function () {
        $.ajax({
            url: url_action,
            type: 'post',
            data: $('#formDataUser').serialize(),
            success: function (data){
                reloadUserTable();
                $('#modalDataUser').modal('hide');
                $('#errorMessage').html('');
                if (data.success) {
                    miniNotif('success',data.success);
                }
            },
            error: function(data){
                var err = data.responseJSON.errors;
                validateDataUser(err);
            }
        });
    });
    $('body').on('click', '.btn-edit', function () {
        getToken();
        $.ajax({
            url: url_action+'/'+$(this).data('username'),
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $('#errorMessage').html('');
                $('#modalDataUser').modal('show');
                $('.btn-simpan-edit').removeClass('d-none');
                $('.btn-simpan').addClass('d-none');
                $('[name="username"]').val(data.username);
                $('[name="name"]').val(data.name);
                $('[name="birth_date"]').val(data.birth_date);
                $('.btn-simpan-edit').data('username', data.username);
                if (data.active == 1) {
                    $('#is_active').prop('checked', true);
                } else {
                    $('#is_active').prop('checked', false);
                }
                check_active();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    $('body').on('click', '.btn-simpan-edit', function () {
        $.ajax({
            url: url_action+'/'+$('.btn-simpan-edit').data('username'),
            type: 'put',
            data: $('#formDataUser').serialize(),
            success: function (data) {
                reloadUserTable();
                $('#modalDataUser').modal('hide');
                $('.btn-simpan-edit').data('username', '');
                $('#errorMessage').html('');
                if (data.success) {
                    miniNotif('success',data.success);
                }
            },
            error: function (error) {
                var err = error.responseJSON.errors;
                validateDataUser(err);
            }
        });
    });
    function validateDataUser(err) {
        var msg='';
        if (err) {
            msg+='<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            msg+='<ul>';
            $.each(err, function(i) {
                if (err[i][0] === "The username has already been taken.") {
                    msg+='<li> NIK sudah digunakan </li>';
                } else {
                    msg+='<li>'+err[i][0]+'</li>';
                }
            });
            msg+='</ul>';
            msg+='<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            $('#errorMessage').html(msg);
        }
    }
    $('body').on('click', '.btn-delete', function () {
        Swal.fire({
            title: 'Apakah anda yakin akan menghapus data ini?',
            text: $(this).data('username')+' - '+$(this).data('name'),
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
                    url: url_action+'/'+$(this).data('username'),
                    type: 'delete',
                    data: {id:$(this).data('username')},
                    success: function (data) {
                        reloadUserTable();
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
    $('.btn-active').click(function () {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Semua akun pemilih akan diaktifkan secara massal',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Aktifkan Semua!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                getToken();
                $.ajax({
                    url: url_action+'/'+'active-all',
                    type: 'post',
                    data: {active:1},
                    success: function (data) {
                        reloadUserTable();
                        if (data.success) {
                            miniNotif('success',data.success);
                        }
                    },
                    error: function (err) {
                        console.log(err.responseJSON);
                    }
                });
            }
        });
    });
    $('.btn-inactive').click(function () {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Semua akun pemilih akan dinonaktifkan secara massal',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Nonaktifkan Semua!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                getToken();
                $.ajax({
                    url: url_action+'/'+'inactive-all',
                    type: 'post',
                    data: {active:0},
                    success: function (data) {
                        reloadUserTable();
                        if (data.success) {
                            miniNotif('success',data.success);
                        }
                    },
                    error: function (err) {
                        console.log(err.responseJSON);
                    }
                });
            }
        });
    });
});