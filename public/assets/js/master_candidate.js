$(document).ready(function(){
    var candidateTable = $('#candidateTable');
    var url_action = $('#formDataCandidate').attr('action');
    var url = url_action+"/get-candidate";
    var form = $('#formDataCandidate')[0];
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    candidateTable.DataTable({
        processing: false,
        serverSide: true,
        responsive: true,
        ajax: {url: url, type: "POST"},
        columns: [
            {data: 'DT_RowIndex', name : 'DT_RowIndex'},
            {data: 'identity', name : 'identity'},
            {data: 'candidate', name : 'candidate'},
            {data: 'foto', name : 'foto', orderable: false, searchable: false},
            {data: 'created_at', name : 'created_at'},
            {data: 'updated_at', name : 'updated_at'},
            {data: 'action', name : 'action', orderable: false, searchable: false},
        ]
    });
    function reloadCandidateTable() {
        candidateTable.DataTable().ajax.reload();
    }
    $('body').on('click', '.btn-reload-table', function () {
        reloadUserTable();
    });
    $('.btn-open-modal').click(function () {
        $('#errorMessage').html('');
        $('#formDataCandidate')[0].reset();getToken();
        $('.btn-simpan-edit').addClass('d-none');
        $('.btn-simpan').removeClass('d-none');
        $('#image-preview').attr('src','');
        $('#image-preview').removeAttr('src');
    });
    $('.btn-simpan').click(function () {
        if ($('[name="id_calon"]').val() !== $('[name="id_wakil_calon"]').val()) {
            $.ajax({
                url: url_action,
                type: 'post',
                data: new FormData(form),
                processData: false,
                contentType: false,
                cache: false,
                success: function (data){
                    reloadCandidateTable();
                    $('#modalDataCandidate').modal('hide');
                    $('.btn-simpan-edit').data('id', '');
                    $('#errorMessage').html('');
                    if (data.success) {
                        miniNotif('success',data.success);
                    }
                },
                error: function(data){
                    var err = data.responseJSON.errors;
                    validateDataCandidate(err);
                }
            });
        } else {
            regNotif('Terdapat Kesalahan', 'No. Identitas Calon dan Wakil Calon Tidak Boleh Sama','error');
        }
    });
    $('body').on('click', '.btn-edit', function () {
        getToken();
        $.ajax({
            url: url_action+'/'+$(this).data('id'),
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $('#errorMessage').html('');
                $('#modalDataCandidate').modal('show');
                $('.btn-simpan-edit').removeClass('d-none');
                $('.btn-simpan').addClass('d-none');
                $('.btn-simpan-edit').data('id', data.id);
                $('[name="id_calon"]').val(data.id_calon);
                $('[name="id_wakil_calon"]').val(data.id_wakil_calon);
                $('[name="nama_calon"]').val(data.nama_calon);
                $('[name="nama_wakil_calon"]').val(data.nama_wakil_calon);
                $('[name="visi"]').val(data.visi);
                $('trix-editor[input="visi"]').html(data.visi);
                $('[name="misi"]').val(data.misi);
                $('trix-editor[input="misi"]').html(data.misi);
                $('#image-preview').attr('src',$('#foto').data('src')+data.foto);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    $('.btn-simpan-edit').click(function () {
        var formdata = new FormData(form);
        if ($('[name="id_calon"]').val() !== $('[name="id_wakil_calon"]').val()) {
            $.ajax({
                url: url_action+'/edit/'+$('.btn-simpan-edit').data('id'),
                type: 'post',
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data){
                    reloadCandidateTable();
                    $('#errorMessage').html('');
                    $('#modalDataCandidate').modal('hide');
                    if (data.success) {
                        miniNotif('success',data.success);
                    }
                },
                error: function(data){
                    var err = data.responseJSON.errors;
                    validateDataCandidate(err);
                }
            });
        } else {
            regNotif('Terdapat Kesalahan', 'No. Identitas Calon dan Wakil Calon Tidak Boleh Sama','error');
        }
    });
    $('#foto').change(function () {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("foto").files[0]);
        
        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
        };
    });
    $('body').on('click', '.btn-delete', function () {
        Swal.fire({
            title: 'Apakah anda yakin akan menghapus data ini?',
            text: $(this).data('calon')+' - '+$(this).data('wakil'),
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
                    url: url_action+'/'+$(this).data('id'),
                    type: 'delete',
                    data: {id:$(this).data('id')},
                    success: function (data) {
                        reloadCandidateTable();
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
    function validateDataCandidate(err) {
        var msg='';
        if (err) {
            msg+='<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            msg+='<ul>';
            $.each(err, function(i) {
                if (err[i][0] === "The id calon has already been taken." || err[i][0] === "The id wakil calon has already been taken.") {
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
});