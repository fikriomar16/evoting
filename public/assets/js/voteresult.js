function showVoteData() {
    var res='';
    getToken();
    $('.btn-loading').removeClass('d-none');
    $('.btn-reload').addClass('d-none');
    $.ajax({
        url: '/get_count_vote',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $.each(data, function (i,row) {
                res+='<div class="col-lg">';
                res+='<div class="card border-0 shadow-sm mb-3 h-100">';
                res+='<div class="row g-0">';
                res+='<div class="col-md-4 text-center">';
                res+='<img src="'+$('#dataVote').data('asset')+row.foto+'" class="img-fluid rounded-start" alt="'+row.foto+'">';
                res+='</div>';
                res+='<div class="col-md-8">';
                res+='<div class="card-body">';
                res+='<p class="fw-bold fs-4 text-center">Peringkat '+(i+1)+'</p>';
                res+='<p class="fw-bold fs-3 text-primary">'+row.nama_calon+'</p>';
                res+='<p class="fw-bold fs-3 text-primary">'+row.nama_wakil_calon+'</p>';
                res+='<p class="fw-bold text-secondary fst-italic text-center">Jumlah Suara : '+row.jumlah+'</p>';
                res+='</div>';
                res+='</div>';
                res+='</div>';
                res+='</div>';
                res+='</div>';
            });
            $('#dataVote').html(res);
            $('.btn-loading').addClass('d-none');
            $('.btn-reload').removeClass('d-none');
        },
        error: function (error) {
            console.log(error);
        }
    });
}
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.btn-reload').click(function () {
        showVoteData();
    });
    showVoteData();
});