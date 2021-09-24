
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.btnDetailCandidate').click(function(){
        getVisiMisi($(this).data('id'));
    });
    function getVisiMisi(id) {
        $.ajax({
            url: "/fetch-candidate/"+id,
            type: "GET",
            dataType: "json",
            success: function (result) {
                Swal.fire({
                    imageUrl: '/assets/img/candidate/'+result.foto,
                    imageHeight: 100,
                    width: 780,
                    padding: '1em',
                    confirmButtonText: 'Tutup',
                    html: 
                    '<div class="fw-bold fs-3">'+result.nama_calon+' <br> '+result.nama_wakil_calon+'</div>'+
                    '<hr>'+
                    '<div class="row">'+
                    '<div class="col-lg">'+
                    '<p class="fw-bold fs-5">Visi</p>'+
                    '<div class="text-start">'+result.visi+'</div>'+
                    '</div>'+
                    '<div class="col-lg">'+
                    '<p class="fw-bold fs-5">Misi</p>'+
                    '<div class="text-start">'+result.misi+'</div>'+
                    '</div>'+
                    '</div>'
                });
            },
            error: function (result) {
                console.log(result);
            }
        })
    }
    $('.btnSelectCandidate').click(function(){
        var id = $(this).data('id');
        var calon = $(this).data('calon');
        var wakil = $(this).data('wakil');
        var kandidat = $(this).data('kandidat');
        var url = $(this).data('url');
        getToken();
        Swal.fire({
            title: 'Ingin Memilih '+kandidat+' ?',
            text: calon+' - '+wakil,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Pilih!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {candidate_id:id},
                    success: function (res) {
                        if(res.status === 'success'){
                            miniNotif(res.status,res.message);
                            $('.btnSelectCandidate').addClass('d-none');
                        }
                        if (res.status === 'error') {
                            regNotif('Oooops',res.message,res.status);
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