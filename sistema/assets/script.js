function abrirmenu( ) {
    document.getElementById('sidebar').classList.toggle('show');
    document.getElementById('escurecer').classList.toggle('show');
}

$(document).ready( function () {
    if ($('#tabela').length) {
        $('#tabela').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json',
            },
        });
    }
} );

function confirmarDelete() {
    document.getElementById('deleteBtnHide').classList.toggle('show');
    document.getElementById('escurecer').classList.toggle('show');
}

function somenteNumeros(valor) {
    return valor.replace(/\D/g, '');
}

function aplicarMascaraTelefone(campo) {
    let valor = somenteNumeros(campo.value).slice(0, 11);
    valor = valor.replace(/^(\d{2})(\d)/, '($1) $2');
    valor = valor.replace(/(\d{5})(\d{1,4})$/, '$1-$2');
    campo.value = valor;
}

function aplicarMascaraCpf(campo) {
    let valor = somenteNumeros(campo.value).slice(0, 11);
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    campo.value = valor;
}

function aplicarMascaraCnpj(campo) {
    let valor = somenteNumeros(campo.value).slice(0, 14);
    valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
    valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
    valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
    valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
    campo.value = valor;
}

function aplicarMascaraPreco(campo) {
    let valor = somenteNumeros(campo.value);
    if (!valor) {
        campo.value = '';
        return;
    }
    valor = (parseInt(valor, 10) / 100).toFixed(2);
    campo.value = 'R$ ' + valor.replace('.', ',');
}

document.querySelectorAll('.mascara-telefone').forEach((campo) => {
    campo.addEventListener('input', () => aplicarMascaraTelefone(campo));
});

document.querySelectorAll('.mascara-cpf').forEach((campo) => {
    campo.addEventListener('input', () => aplicarMascaraCpf(campo));
});

document.querySelectorAll('.mascara-cnpj').forEach((campo) => {
    campo.addEventListener('input', () => aplicarMascaraCnpj(campo));
});

document.querySelectorAll('.mascara-preco').forEach((campo) => {
    campo.addEventListener('input', () => aplicarMascaraPreco(campo));
});
