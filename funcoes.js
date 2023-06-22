function fecharSecoes() {
    let sec_itens = document.getElementById('sec_itens');
    let sec_novo_orcamento = document.getElementById('sec_novo_orcamento');
    let sec_orcamentos = document.getElementById('sec_orcamentos');

    sec_itens.classList.remove('show');
    sec_novo_orcamento.classList.remove('show');
    sec_orcamentos.classList.remove('show');
}

function verNovoOrcamento() {
    fecharSecoes();

    let sec_novo_orcamento = document.getElementById('sec_novo_orcamento');
    sec_novo_orcamento.classList.add('show');
}

function verOrcamentos() {
    fecharSecoes();

    let sec_orcamentos = document.getElementById('sec_orcamentos');
    sec_orcamentos.classList.add('show');
}

function verItens() {
    fecharSecoes();

    let sec_itens = document.getElementById('sec_itens');
    sec_itens.classList.add('show');
}

function adicionarOrcamento(obj) {
    let id_usuario = obj.dataset.user;
    let id_item = obj.dataset.item;
    let txt_quantidade = document.getElementById('txt_quantidade' + id_item);
    let sel_orcamentos = document.getElementById('sel_orcamentos');

    let frm_add_item = document.getElementById('frm_add_item');
    let hdn_id_orcamento = document.getElementById('hdn_id_orcamento');
    let hdn_id_usuario = document.getElementById('hdn_id_usuario');
    let hdn_id_item = document.getElementById('hdn_id_item');
    let hdn_quantidade = document.getElementById('hdn_quantidade');

    // return alert(sel_orcamentos.value);
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

function diminuirQuantidade(obj) {
    let txt_quantidade = document.getElementById('txt_quantidade' + obj.dataset.item);
    let quantidade = parseInt(txt_quantidade.value);
    if (quantidade > 1) {
        quantidade -= 1;
    }
    txt_quantidade.value = quantidade;
}

function aumentarQuantidade(obj) {
    let txt_quantidade = document.getElementById('txt_quantidade' + obj.dataset.item);
    let quantidade = parseInt(txt_quantidade.value);
    if (quantidade < 99) {
        quantidade += 1;
    }
    txt_quantidade.value = quantidade;
}

$(document).ready(function() {
    $('#frm_add_item').submit(function(e) {
        let hdn_id_item = document.getElementById('hdn_id_item');
        let div_sucesso = document.getElementById('div_sucesso' + hdn_id_item.value);
        e.preventDefault();
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
});
