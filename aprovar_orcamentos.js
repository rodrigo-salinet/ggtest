function alterarPreco(obj) {
    let id_orcamento = obj.dataset.orcamento;
    let id_item = obj.dataset.item;
    let id_preco = obj.value;

    let hdn_aprovar_orcamentos_preco_item_id_orcamento = document.getElementById('hdn_aprovar_orcamentos_preco_item_id_orcamento');
    let hdn_aprovar_orcamentos_preco_id_item = document.getElementById('hdn_aprovar_orcamentos_preco_id_item');
    let hdn_aprovar_orcamentos_preco_id_preco = document.getElementById('hdn_aprovar_orcamentos_preco_id_preco');

    hdn_aprovar_orcamentos_preco_item_id_orcamento.value = id_orcamento;
    hdn_aprovar_orcamentos_preco_id_item.value = id_item;
    hdn_aprovar_orcamentos_preco_id_preco.value = id_preco;

    $('#frm_aprovar_orcamentos_preco').trigger("submit");
}

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

    $('#frm_aprovar_orcamentos_preco').submit(function(e) {
        e.preventDefault();
        let hdn_aprovar_orcamentos_preco_item_id_orcamento = document.getElementById('hdn_aprovar_orcamentos_preco_item_id_orcamento');
        let hdn_aprovar_orcamentos_preco_id_item = document.getElementById('hdn_aprovar_orcamentos_preco_id_item');
        let div_sucesso_aprovar_orcamento_id_item = document.getElementById('div_sucesso_aprovar_orcamento' + hdn_aprovar_orcamentos_preco_item_id_orcamento.value + '_id_item' + hdn_aprovar_orcamentos_preco_id_item.value);
        $.ajax({
            type: "POST",
            url: 'alterar_preco_orcamento.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_aprovar_orcamento_id_item.innerHTML = jsonData.message;
                    $("#sel_aprovar_orcamento_status" + hdn_aprovar_orcamentos_preco_item_id_orcamento.value).val("7").trigger("change");
                } else {
                    div_sucesso_aprovar_orcamento_id_item.innerHTML = jsonData.error;
                }
                div_sucesso_aprovar_orcamento_id_item.classList.add("show");
            }
        });
    });

});