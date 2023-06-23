function excluirOrcamento(obj) {
    let id_orcamento = obj.dataset.orcamento;

    let hdn_editar_orcamento_excluir_orcamento_id_orcamento = document.getElementById('hdn_editar_orcamento_excluir_orcamento_id_orcamento');

    hdn_editar_orcamento_excluir_orcamento_id_orcamento.value = id_orcamento;

    $('#frm_editar_orcamento_id_orcamento').trigger("submit");
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

function editarIdClienteOrcamento(obj) {
    let id_orcamento = obj.dataset.orcamento;
    let id_cliente = obj.value;

    let hdn_editar_orcamento_editar_cliente_id_orcamento = document.getElementById('hdn_editar_orcamento_editar_cliente_id_orcamento');
    let hdn_editar_orcamento_editar_cliente_id_cliente = document.getElementById('hdn_editar_orcamento_editar_cliente_id_cliente');

    hdn_editar_orcamento_editar_cliente_id_orcamento.value = id_orcamento;
    hdn_editar_orcamento_editar_cliente_id_cliente.value = id_cliente;

    $('#frm_editar_orcamento_id_cliente').trigger("submit");
}

function verSecao(secao) {
    let secoes = [
        'sec_adicionar_itens',
        'sec_novo_item',
        'sec_editar_item',
        'sec_excluir_item',
        'sec_novo_orcamento',
        'sec_editar_orcamento',
        'sec_excluir_orcamento',
        'sec_novo_cliente',
        'sec_editar_cliente',
        'sec_excluir_cliente',
        'sec_novo_usuario',
        'sec_editar_usuario',
        'sec_excluir_usuario',
        'sec_meu_cadastro'
    ];

    for (let i = 0; i < secoes.length; i++) {
        document.getElementById(secoes[i]).classList.remove('show');
    }

    document.getElementById(secao).classList.add('show');
}

function novoOrcamento() {
    fecharSecoes();

    let sec_novo_orcamento = document.getElementById('sec_novo_orcamento');
    sec_novo_orcamento.classList.add('show');
}

function novoOrcamento() {
    fecharSecoes();

    let sec_novo_orcamento = document.getElementById('sec_novo_orcamento');
    sec_novo_orcamento.classList.add('show');
}

function adicionarItens() {
    fecharSecoes();

    let sec_adicionar_itens = document.getElementById('sec_adicionar_itens');
    sec_adicionar_itens.classList.add('show');
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
