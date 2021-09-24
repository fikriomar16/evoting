$(document).ready(function(){
    var adminTable = $('#adminTable');
    var url_action = $('#formDataAdmin').attr('action');
    var url = url_action+"/get-admin";
    var form = $('#formDataAdmin');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    adminTable.DataTable({
        processing: false,
        serverSide: true,
        responsive: true,
        ajax: {url: url, type: "post"},
        columns: [
            {data: 'DT_RowIndex', name : 'DT_RowIndex'},
            {data: 'name', name : 'name'},
            {data: 'username', name : 'username'},
            {data: 'created_at', name : 'created_at'},
            {data: 'updated_at', name : 'updated_at'},
            {data: 'action', name : 'action', orderable: false, searchable: false},
        ]
    });
    function reloadAdminTable() {
        adminTable.DataTable().ajax.reload();
    }
    $('body').on('click', '.btn-reload-table', function () {
        reloadAdminTable();
    });
    $('.btn-open-modal').click(function () {
        form[0].reset();getToken();
        $('.btn-simpan-edit').addClass('d-none');
        $('.btn-simpan').removeClass('d-none');
        $('#errorMessage').html('');
    });
    $('.btn-simpan').click(function () {
        $.ajax({
            url: url_action,
            type: 'post',
            data: form.serialize(),
            success: function (data){
                reloadAdminTable();
                $('#modalDataAdmin').modal('hide');
                $('#errorMessage').html('');
                if (data.success) {
                    miniNotif('success',data.success);
                }
            },
            error: function(data){
                var err = data.responseJSON.errors;
                validateDataAdmin(err);
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
                $('#modalDataAdmin').modal('show');
                $('.btn-simpan-edit').removeClass('d-none');
                $('.btn-simpan').addClass('d-none');
                $('[name="username"]').val(data.username);
                $('[name="name"]').val(data.name);
                $('.btn-simpan-edit').data('username', data.username);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    $('.btn-simpan-edit').click(function () {
        $.ajax({
            url: url_action+'/'+$('.btn-simpan-edit').data('username'),
            type: 'put',
            data: form.serialize(),
            success: function (data) {
                reloadAdminTable();
                $('#modalDataAdmin').modal('hide');
                $('.btn-simpan-edit').data('username', '');
                $('#errorMessage').html('');
                if (data.success) {
                    miniNotif('success',data.success);
                }
            },
            error: function (error) {
                var err = error.responseJSON.errors;
                validateDataAdmin(err);
            }
        });
    });
    function validateDataAdmin(err) {
        var msg='';
        if (err) {
            msg+='<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            msg+='<ul>';
            $.each(err, function(i) {
                msg+='<li>'+err[i][0]+'</li>';
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
                        reloadAdminTable();
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