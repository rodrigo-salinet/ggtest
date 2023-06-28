function alterarStatus(obj) {
    let id_orcamento = obj.dataset.orcamento;
    let id_status = obj.value;

    let hdn_aprovar_orcamentos_status_item_id_orcamento = document.getElementById('hdn_aprovar_orcamentos_status_item_id_orcamento');
    let hdn_aprovar_orcamentos_status_id_status = document.getElementById('hdn_aprovar_orcamentos_status_id_status');

    hdn_aprovar_orcamentos_status_item_id_orcamento.value = id_orcamento;
    hdn_aprovar_orcamentos_status_id_status.value = id_status;

    $('#frm_aprovar_orcamentos_status').trigger("submit");
}

function selecionarUsuario(obj) {
    window.location = './aprovar_orcamentos.php?id_usuario=' + obj.value;
}

$(document).ready(function() {

    $('#frm_aprovar_orcamentos_status').submit(function(e) {
        e.preventDefault();
        let hdn_aprovar_orcamentos_status_item_id_orcamento = document.getElementById('hdn_aprovar_orcamentos_status_item_id_orcamento');
        let div_sucesso_aprovar_orcamentos_id_orcamento = document.getElementById('div_sucesso_aprovar_orcamentos_id_orcamento' + hdn_aprovar_orcamentos_status_item_id_orcamento.value);
        $.ajax({
            type: "POST",
            url: 'alterar_status_orcamento.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_aprovar_orcamentos_id_orcamento.innerHTML = jsonData.message;
                } else {
                    div_sucesso_aprovar_orcamentos_id_orcamento.innerHTML = jsonData.error;
                }
                div_sucesso_aprovar_orcamentos_id_orcamento.classList.add("show");
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