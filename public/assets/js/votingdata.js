const temp_count = 0;
const real_count = 0;
const set_temp_count = () => {
    $.get('/count_voter', function (data) {
        return data;
    });
}
const get_real_count = () => {
    $.get('/count_voter', function (data) {
        return data;
    });
}
function showVoteData() {
    var res='';
    $.ajax({
        url: '/get_count_vote',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $.each(data, function (i,row) {
                res+='<div class="col-lg">';
                res+='<div class="card border-0 shadow rounded-3 h-100">';
                res+='<div class="card-body text-center align-items-center">';
                res+='<p class="fw-bold fs-6">Peringkat '+(i+1)+'</p>';
                res+='<h5 class="fw-bold text-primary">'+row.nama_calon+' - '+row.nama_wakil_calon;
                res+='<p class="fw-bold text-secondary small py-1">Jumlah Pemilih : '+row.jumlah+'</p>';
                res+='</div>';
                res+='</div>';
                res+='</div>';
                res+='';
            });
            $('#dataVote').html(res);
        },
        error: function (error) {
            console.log(error);
        }
    });
}
$(document).ready(function(){
    var url = '/dashboard/get_voting_data';
    var table = $('#voteTable');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    table.DataTable({
        processing: false,
        serverSide: true,
        responsive: true,
        ajax: {url: url, type: "POST"},
        columns: [
            {data: 'DT_RowIndex', name : 'DT_RowIndex'},
            {data: 'pemilih', name : 'pemilih'},
            {data: 'kandidat', name : 'kandidat'},
            {data: 'ip', name : 'ip'},
            {data: 'os', name : 'os'},
            {data: 'browser', name : 'browser'},
            {data: 'created_at', name : 'created_at'}
        ]
    });
    function reloadTable() {
        table.DataTable().ajax.reload();
    }
    $('body').on('click', '.btn-reload-table', function () {
        reloadTable();
        showVoteData();
    });
    showVoteData();
    // set_temp_count();
    // setInterval(function () {
    //     get_real_count();
    //     if (set_temp_count() !== get_real_count()) {
    //         showVoteData();
    //         reloadTable();
    //         set_temp_count();
    //     }
    // },1000);
});