function formatarReal(obj) {
    let txt_preco = obj.value;
    let txt_preco_final = txt_preco.replace(/\D/g, "");

    if (isNaN(parseInt(txt_preco_final))) {
        txt_preco_final = '0';
    }

    txt_preco_final = String(parseInt(txt_preco_final));

    if (txt_preco_final == '0') {
        txt_preco_final = '';
    }

    switch (txt_preco_final.length) {
        case 0:
            obj.value = '';
            break;
        case 1:
            obj.value = '0,0' + txt_preco_final;
            break;
        case 2:
            obj.value = '0,' + txt_preco_final;
            break;
        case 3:
            obj.value = txt_preco_final.charAt(0) + ',' + txt_preco_final.charAt(1) + txt_preco_final.charAt(2);
            break;
        case 4:
            obj.value = txt_preco_final.charAt(0) + txt_preco_final.charAt(1) + ',' + txt_preco_final.charAt(2) + txt_preco_final.charAt(3);
            break;
        case 5:
            obj.value = txt_preco_final.charAt(0) + txt_preco_final.charAt(1) + txt_preco_final.charAt(2) + ',' + txt_preco_final.charAt(3) + txt_preco_final.charAt(4);
            break;
        case 6:
            obj.value = txt_preco_final.charAt(0) + '.' + txt_preco_final.charAt(1) + txt_preco_final.charAt(2) + txt_preco_final.charAt(3) + ',' + txt_preco_final.charAt(4) + txt_preco_final.charAt(5);
            break;
        case 7:
            obj.value = txt_preco_final.charAt(0) + txt_preco_final.charAt(1) + '.' + txt_preco_final.charAt(2) + txt_preco_final.charAt(3) + txt_preco_final.charAt(4) + ',' + txt_preco_final.charAt(5) + txt_preco_final.charAt(6);
            break;
        case 8:
            obj.value = txt_preco_final.charAt(0) + txt_preco_final.charAt(1) + txt_preco_final.charAt(2) + '.' + txt_preco_final.charAt(3) + txt_preco_final.charAt(4) + txt_preco_final.charAt(5) + ',' + txt_preco_final.charAt(6) + txt_preco_final.charAt(7);
            break;
        default:
            obj.value = '';
    }
}

function excluirPrecoItem(obj) {
    let id_preco = obj.dataset.preco;

    let hdn_editar_preco_item_excluir_id_preco_item = document.getElementById('hdn_editar_preco_item_excluir_id_preco_item');

    hdn_editar_preco_item_excluir_id_preco_item.value = id_preco;

    $('#frm_editar_preco_item_excluir_id_preco_item').trigger("submit");
}

function editarItem(obj) {
    let id_preco = obj.dataset.preco;

    let hdn_editar_preco_item_id_preco_item = document.getElementById('hdn_editar_preco_item_id_preco_item');
    let hdn_editar_preco_item_id_item = document.getElementById('hdn_editar_preco_item_id_item');
    let sel_id_item = document.getElementById('sel_id_item' + id_preco);

    hdn_editar_preco_item_id_preco_item.value = id_preco;
    hdn_editar_preco_item_id_item.value = sel_id_item.value;

    $('#frm_editar_preco_item_id_item').trigger("submit");
}

function editarFornecedor(obj) {
    let id_preco = obj.dataset.preco;

    let hdn_editar_preco_item_fornecedor_id_preco_item = document.getElementById('hdn_editar_preco_item_fornecedor_id_preco_item');
    let hdn_editar_preco_item_fornecedor_id_fornecedor = document.getElementById('hdn_editar_preco_item_fornecedor_id_fornecedor');
    let sel_id_fornecedor = document.getElementById('sel_id_fornecedor' + id_preco);

    hdn_editar_preco_item_fornecedor_id_preco_item.value = id_preco;
    hdn_editar_preco_item_fornecedor_id_fornecedor.value = sel_id_fornecedor.value;

    $('#frm_editar_preco_item_id_fornecedor').trigger("submit");
}

function editarPreco(obj) {
    let id_preco = obj.dataset.preco;

    let hdn_editar_preco_item_preco_id_preco_item = document.getElementById('hdn_editar_preco_item_preco_id_preco_item');
    let hdn_editar_preco_item_preco = document.getElementById('hdn_editar_preco_item_preco');
    let txt_preco_item = document.getElementById('txt_preco_item' + id_preco);

    hdn_editar_preco_item_preco_id_preco_item.value = id_preco;
    hdn_editar_preco_item_preco.value = txt_preco_item.value;

    $('#frm_editar_preco_item_preco').trigger("submit");
}

$(document).ready(function() {

    $('#frm_editar_preco_item_excluir_id_preco_item').submit(function(e) {
        e.preventDefault();
        let hdn_editar_preco_item_excluir_id_preco_item = document.getElementById('hdn_editar_preco_item_excluir_id_preco_item');

        let div_id_preco_item = document.getElementById('div_id_preco_item' + hdn_editar_preco_item_excluir_id_preco_item.value);
        let div_id_item = document.getElementById('div_id_item' + hdn_editar_preco_item_excluir_id_preco_item.value);
        let div_id_fornecedor = document.getElementById('div_id_fornecedor' + hdn_editar_preco_item_excluir_id_preco_item.value);
        let div_preco = document.getElementById('div_preco' + hdn_editar_preco_item_excluir_id_preco_item.value);

        let div_sucesso_excluir_id_preco_item = document.getElementById('div_sucesso_excluir_id_preco_item' + hdn_editar_preco_item_excluir_id_preco_item.value);
        $.ajax({
            type: "POST",
            url: 'excluir_id_preco_item.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_id_preco_item.innerHTML = jsonData.message;
                    div_id_item.innerHTML = '';
                    div_id_fornecedor.innerHTML = '';
                    div_preco.innerHTML = '';
                } else {
                    div_sucesso_excluir_id_preco_item.innerHTML = jsonData.error;
                    div_sucesso_excluir_id_preco_item.classList.add("show");
                }
            }
        });
    });

    $('#frm_editar_preco_item_id_item').submit(function(e) {
        e.preventDefault();
        let hdn_editar_preco_item_id_preco_item = document.getElementById('hdn_editar_preco_item_id_preco_item');

        let div_sucesso_editar_id_item = document.getElementById('div_sucesso_editar_id_item' + hdn_editar_preco_item_id_preco_item.value);
        $.ajax({
            type: "POST",
            url: 'editar_id_item_preco_item.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_id_item.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_id_item.innerHTML = jsonData.error;
                }
                div_sucesso_editar_id_item.classList.add("show");
            }
        });
    }); 

    $('#frm_editar_preco_item_id_fornecedor').submit(function(e) {
        e.preventDefault();
        let hdn_editar_preco_item_fornecedor_id_preco_item = document.getElementById('hdn_editar_preco_item_fornecedor_id_preco_item');

        let div_sucesso_editar_id_fornecedor = document.getElementById('div_sucesso_editar_id_fornecedor' + hdn_editar_preco_item_fornecedor_id_preco_item.value);
        $.ajax({
            type: "POST",
            url: 'editar_id_fornecedor_preco_item.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_id_fornecedor.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_id_fornecedor.innerHTML = jsonData.error;
                }
                div_sucesso_editar_id_fornecedor.classList.add("show");
            }
        });
    }); 

    $('#frm_editar_preco_item_preco').submit(function(e) {
        e.preventDefault();
        let hdn_editar_preco_item_preco_id_preco_item = document.getElementById('hdn_editar_preco_item_preco_id_preco_item');

        let div_sucesso_editar_preco = document.getElementById('div_sucesso_editar_preco' + hdn_editar_preco_item_preco_id_preco_item.value);
        $.ajax({
            type: "POST",
            url: 'editar_preco_preco_item.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_preco.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_preco.innerHTML = jsonData.error;
                }
                div_sucesso_editar_preco.classList.add("show");
            }
        });
    }); 

});