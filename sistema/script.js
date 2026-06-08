function abrirmenu( ) {
    document.getElementById('sidebar').classList.toggle('show');
    document.getElementById('escurecer').classList.toggle('show');
}

$(document).ready( function () {
    $('#tabela').DataTable();
} );

var table = new DataTable('#tabela', {
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json',
    },
});

function confirmarDelete() {
    document.getElementById('deleteBtnHide').classList.toggle('show');
    document.getElementById('escurecer').classList.toggle('show');
}