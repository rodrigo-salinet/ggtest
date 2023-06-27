function adicionarOrcamento(obj) {
    let id_usuario = obj.dataset.user;
    let id_item = obj.dataset.item;
    let txt_quantidade = document.getElementById('txt_quantidade' + id_item);
    let sel_orcamentos = document.getElementById('sel_orcamentos');

    let hdn_id_orcamento = document.getElementById('hdn_id_orcamento');
    let hdn_id_usuario = document.getElementById('hdn_id_usuario');
    let hdn_id_item = document.getElementById('hdn_id_item');
    let hdn_quantidade = document.getElementById('hdn_quantidade');

    if (sel_orcamentos.value == '0') {
        alert("Por favor, selecione um orçamento antes de prosseguir");
        return sel_orcamentos.focus();
    }

    hdn_id_orcamento.value = sel_orcamentos.value;
    hdn_id_usuario.value = id_usuario;
    hdn_id_item.value = id_item;
    hdn_quantidade.value = txt_quantidade.value;

    $('#frm_add_item').trigger("submit");
}

function selecionarOrcamento(obj) {
    window.location = './adicionar_itens.php?id_orcamento=' + obj.value;
}

function diminuirQuantidade(obj) {
    let txt_quantidade = document.getElementById('txt_quantidade' + obj.dataset.item);
    let quantidade = parseInt(txt_quantidade.value);
    if (quantidade > 0) {
        quantidade -= 1;
        txt_quantidade.value = quantidade;
        atualizarQuantidade(txt_quantidade);
    }
}

function aumentarQuantidade(obj) {
    let txt_quantidade = document.getElementById('txt_quantidade' + obj.dataset.item);
    let quantidade = parseInt(txt_quantidade.value);
    if (quantidade < 99) {
        quantidade += 1;
    }
    txt_quantidade.value = quantidade;
    atualizarQuantidade(txt_quantidade);
}

function atualizarQuantidade(obj) {
    let id_usuario = obj.dataset.user;
    let id_item = obj.dataset.item;
    let sel_orcamentos = document.getElementById('sel_orcamentos');

    let hdn_atualizar_quantidade_id_orcamento = document.getElementById('hdn_atualizar_quantidade_id_orcamento');
    let hdn_atualizar_quantidade_id_usuario = document.getElementById('hdn_atualizar_quantidade_id_usuario');
    let hdn_atualizar_quantidade_id_item = document.getElementById('hdn_atualizar_quantidade_id_item');
    let hdn_atualizar_quantidade_txt_quantidade = document.getElementById('hdn_atualizar_quantidade_txt_quantidade');

    if (sel_orcamentos.value == '0') {
        alert("Por favor, selecione um orçamento antes de prosseguir");
        return sel_orcamentos.focus();
    }

    hdn_atualizar_quantidade_id_orcamento.value = sel_orcamentos.value;
    hdn_atualizar_quantidade_id_usuario.value = id_usuario;
    hdn_atualizar_quantidade_id_item.value = id_item;
    hdn_atualizar_quantidade_txt_quantidade.value = obj.value;

    $('#frm_atualizar_quantidade').trigger("submit");    
}

$(document).ready(function() {

    $('#frm_add_item').submit(function(e) {
        e.preventDefault();
        let hdn_id_item = document.getElementById('hdn_id_item');
        let div_sucesso = document.getElementById('div_sucesso' + hdn_id_item.value);
        $.ajax({
            type: "POST",
            url: 'adicionar_item.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso.innerHTML = jsonData.message;
                } else {
                    div_sucesso.innerHTML = jsonData.error;
                }
                div_sucesso.classList.add("show");
            }
        });
    });

    $('#frm_atualizar_quantidade').submit(function(e) {
        e.preventDefault();
        let hdn_atualizar_quantidade_id_item = document.getElementById('hdn_atualizar_quantidade_id_item');
        let div_sucesso = document.getElementById('div_sucesso' + hdn_atualizar_quantidade_id_item.value);
        $.ajax({
            type: "POST",
            url: 'atualizar_item.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso.innerHTML = jsonData.message;
                } else {
                    div_sucesso.innerHTML = jsonData.error;
                }
                div_sucesso.classList.add("show");
            }
        });
    });

});
