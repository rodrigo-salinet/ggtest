function quantidadeItemOrcamento(obj) {
    let id_orcamento = obj.dataset.orcamento;
    let id_item = obj.dataset.item;
    let txt_editar_orcamento_quantidade_item = document.getElementById('txt_editar_orcamento' + id_orcamento + '_quantidade_item' + id_item);

    let hdn_editar_orcamento_quantidade_item_id_orcamento = document.getElementById('hdn_editar_orcamento_quantidade_item_id_orcamento');
    let hdn_editar_orcamento_quantidade_item_id_item = document.getElementById('hdn_editar_orcamento_quantidade_item_id_item');
    let hdn_editar_orcamento_quantidade_item = document.getElementById('hdn_editar_orcamento_quantidade_item');

    hdn_editar_orcamento_quantidade_item_id_orcamento.value = id_orcamento;
    hdn_editar_orcamento_quantidade_item_id_item.value = id_item;
    hdn_editar_orcamento_quantidade_item.value = txt_editar_orcamento_quantidade_item.value;

    $('#frm_editar_orcamento_quantidade').trigger("submit");
}

function editarIdClienteOrcamento(obj) {
    let id_orcamento = obj.dataset.orcamento;
    let id_cliente = obj.value;

    let hdn_editar_orcamento_editar_cliente_id_orcamento = document.getElementById('hdn_editar_orcamento_editar_cliente_id_orcamento');
    let hdn_editar_orcamento_editar_cliente_id_cliente = document.getElementById('hdn_editar_orcamento_editar_cliente_id_cliente');

    hdn_editar_orcamento_editar_cliente_id_orcamento.value = id_orcamento;
    hdn_editar_orcamento_editar_cliente_id_cliente.value = id_cliente;

    $('#frm_editar_orcamento_id_cliente').trigger("submit");
}

function excluirItemOrcamento(obj) {
    let id_orcamento = obj.dataset.orcamento;
    let id_item = obj.dataset.item;

    let hdn_editar_orcamento_excluir_item_id_orcamento = document.getElementById('hdn_editar_orcamento_excluir_item_id_orcamento');
    let hdn_editar_orcamento_excluir_item_id_item = document.getElementById('hdn_editar_orcamento_excluir_item_id_item');

    hdn_editar_orcamento_excluir_item_id_orcamento.value = id_orcamento;
    hdn_editar_orcamento_excluir_item_id_item.value = id_item;

    $('#frm_editar_orcamento_id_item').trigger("submit");
}

function excluirOrcamento(obj) {
    if (!confirm("Tem certeza de que deseja excluir este orçamento? Não será possível reverter esta ação depois!")) {
        return false;
    }

    let id_orcamento = obj.dataset.orcamento;

    let hdn_editar_orcamento_excluir_orcamento_id_orcamento = document.getElementById('hdn_editar_orcamento_excluir_orcamento_id_orcamento');

    hdn_editar_orcamento_excluir_orcamento_id_orcamento.value = id_orcamento;

    $('#frm_editar_orcamento_id_orcamento').trigger("submit");
}

$(document).ready(function() {

    $('#frm_editar_orcamento_quantidade').submit(function(e) {
        e.preventDefault();
        let hdn_editar_orcamento_quantidade_item_id_orcamento = document.getElementById('hdn_editar_orcamento_quantidade_item_id_orcamento');
        let hdn_editar_orcamento_quantidade_item_id_item = document.getElementById('hdn_editar_orcamento_quantidade_item_id_item');
        let div_sucesso_editar_orcamento_quantidade = document.getElementById('div_sucesso_editar_orcamento' + hdn_editar_orcamento_quantidade_item_id_orcamento.value + '_quantidade_item' + hdn_editar_orcamento_quantidade_item_id_item.value);
        $.ajax({
            type: "POST",
            url: 'editar_quantidade_item_orcamento.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_orcamento_quantidade.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_orcamento_quantidade.innerHTML = jsonData.error;
                }
                div_sucesso_editar_orcamento_quantidade.classList.add("show");
            }
        });
    });

    $('#frm_editar_orcamento_id_cliente').submit(function(e) {
        e.preventDefault();
        let hdn_editar_orcamento_editar_cliente_id_orcamento = document.getElementById('hdn_editar_orcamento_editar_cliente_id_orcamento');
        let div_sucesso_editar_orcamento_id_cliente = document.getElementById('div_sucesso_editar_orcamento_id_cliente' + hdn_editar_orcamento_editar_cliente_id_orcamento.value);
        $.ajax({
            type: "POST",
            url: 'editar_id_cliente_orcamento.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_orcamento_id_cliente.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_orcamento_id_cliente.innerHTML = jsonData.error;
                }
                div_sucesso_editar_orcamento_id_cliente.classList.add("show");
            }
        });
    });

    $('#frm_editar_orcamento_id_item').submit(function(e) {
        e.preventDefault();
        let hdn_editar_orcamento_excluir_item_id_orcamento = document.getElementById('hdn_editar_orcamento_excluir_item_id_orcamento');
        let hdn_editar_orcamento_excluir_item_id_item = document.getElementById('hdn_editar_orcamento_excluir_item_id_item');
        let ig_editar_orcamento_nome_item = document.getElementById('ig_editar_orcamento' + hdn_editar_orcamento_excluir_item_id_orcamento.value + '_nome_item' + hdn_editar_orcamento_excluir_item_id_item.value);
        let ig_editar_orcamento_quantidade_item = document.getElementById('ig_editar_orcamento' + hdn_editar_orcamento_excluir_item_id_orcamento.value + '_quantidade_item' + hdn_editar_orcamento_excluir_item_id_item.value);
        let div_sucesso_editar_orcamento_id_item = document.getElementById('div_sucesso_editar_orcamento' + hdn_editar_orcamento_excluir_item_id_orcamento.value + '_id_item' + hdn_editar_orcamento_excluir_item_id_item.value);
        let div_sucesso_editar_orcamento_quantidade_item = document.getElementById('div_sucesso_editar_orcamento' + hdn_editar_orcamento_excluir_item_id_orcamento.value + '_quantidade_item' + hdn_editar_orcamento_excluir_item_id_item.value);
        $.ajax({
            type: "POST",
            url: 'excluir_id_item_orcamento.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_orcamento_id_item.innerHTML = jsonData.message;
                    div_sucesso_editar_orcamento_quantidade_item.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_orcamento_id_item.innerHTML = jsonData.error;
                    div_sucesso_editar_orcamento_quantidade_item.innerHTML = jsonData.error;
                }
                ig_editar_orcamento_nome_item.innerHTML = '';
                ig_editar_orcamento_quantidade_item.innerHTML = '';
                div_sucesso_editar_orcamento_id_item.classList.add("show");
                div_sucesso_editar_orcamento_quantidade_item.classList.add("show");
            }
        });
    });

    $('#frm_editar_orcamento_id_orcamento').submit(function(e) {
        e.preventDefault();
        let hdn_editar_orcamento_excluir_orcamento_id_orcamento = document.getElementById('hdn_editar_orcamento_excluir_orcamento_id_orcamento');
        let div_sucesso_editar_orcamento_id_orcamento = document.getElementById('div_sucesso_editar_orcamento_id_orcamento' + hdn_editar_orcamento_excluir_orcamento_id_orcamento.value);
        let div_row_orcamento = document.getElementById('div_row_orcamento' + hdn_editar_orcamento_excluir_orcamento_id_orcamento.value);
        $.ajax({
            type: "POST",
            url: 'excluir_id_orcamento.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_row_orcamento.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_orcamento_id_orcamento.innerHTML = jsonData.error;
                    div_sucesso_editar_orcamento_id_orcamento.classList.add("show");
                }
            }
        });
    });

});