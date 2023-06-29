function excluirImagem(obj) {
    if (!confirm("Tem certeza de que deseja excluir esta imagem? Não será possível reverter esta ação depois!")) {
        return false;
    }

    let id_item = obj.dataset.item;

    let hdn_editar_item_excluir_imagem = document.getElementById('hdn_editar_item_excluir_imagem');
    hdn_editar_item_excluir_imagem.value = id_item;

    $('#frm_editar_item_excluir_imagem').trigger("submit");
}

function excluirItem(obj) {
    if (!confirm("Tem certeza de que deseja excluir este item? Não será possível reverter esta ação depois!")) {
        return false;
    }

    let id_item = obj.dataset.item;
    let txt_editar_id_item = document.getElementById('txt_editar_id_item' + id_item);

    let hdn_editar_item_excluir_item_id_item = document.getElementById('hdn_editar_item_excluir_item_id_item');
    hdn_editar_item_excluir_item_id_item.value = id_item;

    $('#frm_editar_item_id_item').trigger("submit");
}

function alterarImagemItem(obj) {
    let id_item = obj.dataset.item;
    let fil_upload_imagem = document.getElementById('fil_upload_imagem' + id_item);

    let hdn_editar_item_imagem_id_item = document.getElementById('hdn_editar_item_imagem_id_item');
    let fil_editar_item_imagem = document.getElementById('fil_editar_item_imagem');

    hdn_editar_item_imagem_id_item.value = id_item;
    let input_file_original = $('#fil_upload_imagem' + id_item);

    let input_file_clone = input_file_original.clone();
    input_file_clone.attr("id", "fil_editar_item_imagem");
    input_file_clone.attr("name", "fil_editar_item_imagem");
    input_file_clone.attr("style", "display: none;");

    if (fil_editar_item_imagem !== null) {
        fil_editar_item_imagem.parentNode.removeChild(fil_editar_item_imagem);
    }
    input_file_clone.insertAfter(hdn_editar_item_imagem_id_item);

    $('#frm_editar_item_imagem').trigger("submit");
}

function alterarNomeItem(obj) {
    let id_orcamento = obj.dataset.orcamento;
    let id_cliente = obj.value;

    let hdn_editar_orcamento_editar_cliente_id_orcamento = document.getElementById('hdn_editar_orcamento_editar_cliente_id_orcamento');
    let hdn_editar_orcamento_editar_cliente_id_cliente = document.getElementById('hdn_editar_orcamento_editar_cliente_id_cliente');

    hdn_editar_orcamento_editar_cliente_id_orcamento.value = id_orcamento;
    hdn_editar_orcamento_editar_cliente_id_cliente.value = id_cliente;

    $('#frm_editar_orcamento_id_cliente').trigger("submit");
}

function alterarDescricaoItem(obj) {
    let id_orcamento = obj.dataset.orcamento;
    let id_cliente = obj.value;

    let hdn_editar_orcamento_editar_cliente_id_orcamento = document.getElementById('hdn_editar_orcamento_editar_cliente_id_orcamento');
    let hdn_editar_orcamento_editar_cliente_id_cliente = document.getElementById('hdn_editar_orcamento_editar_cliente_id_cliente');

    hdn_editar_orcamento_editar_cliente_id_orcamento.value = id_orcamento;
    hdn_editar_orcamento_editar_cliente_id_cliente.value = id_cliente;

    $('#frm_editar_orcamento_id_cliente').trigger("submit");
}

$(document).ready(function() {

    $('#frm_editar_item_excluir_imagem').submit(function(e) {
        e.preventDefault();
        let hdn_editar_item_excluir_imagem = document.getElementById('hdn_editar_item_excluir_imagem');
        let div_sucesso_editar_item_excluir_imagem = document.getElementById('div_sucesso_editar_item_excluir_imagem' + hdn_editar_item_excluir_imagem.value);
        $.ajax({
            type: "POST",
            url: 'excluir_imagem_item.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    $('#img_editar_item' + hdn_editar_item_excluir_imagem.value).attr('src', './imagens/sem-foto.jpg');
                    $('#lnk_excluir_imagem' + hdn_editar_item_excluir_imagem.value).attr('style', 'display: none;');
                    div_sucesso_editar_item_excluir_imagem.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_item_excluir_imagem.innerHTML = jsonData.error;
                }
                div_sucesso_editar_item_excluir_imagem.classList.add("show");
            }
        });
    });

    $('#frm_editar_item_id_item').submit(function(e) {
        e.preventDefault();
        let hdn_editar_item_excluir_item_id_item = document.getElementById('hdn_editar_item_excluir_item_id_item');
        let div_sucesso_editar_item_id_item = document.getElementById('div_sucesso_editar_item_id_item' + hdn_editar_item_excluir_item_id_item.value);
        $.ajax({
            type: "POST",
            url: 'excluir_id_item.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    $('.item' + hdn_editar_item_excluir_item_id_item.value).html('');
                    $('#div_id_item' + hdn_editar_item_excluir_item_id_item.value).html(jsonData.message);
                } else {
                    div_sucesso_editar_item_id_item.innerHTML = jsonData.error;
                    div_sucesso_editar_item_id_item.classList.add("show");
                }
            }
        });
    });

    $('#frm_editar_item_imagem').submit(function(e) {
        e.preventDefault();
        let hdn_editar_item_imagem_id_item = document.getElementById('hdn_editar_item_imagem_id_item');
        let div_sucesso_editar_item_imagem = document.getElementById('div_sucesso_editar_item_imagem' + hdn_editar_item_imagem_id_item.value);
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: 'editar_item_imagem.php',
            data: formData,
            success: function(data) {
                let jsonData = JSON.parse(data);
                if (jsonData.success == "1") {
                    div_sucesso_editar_item_imagem.innerHTML = '';
                    div_sucesso_editar_item_imagem.innerHTML = jsonData.message;
                    let icone_sucesso_editar_item_imagem = document.getElementById('icone_sucesso_editar_item_imagem');
                    $('#img_editar_item' + hdn_editar_item_imagem_id_item.value).attr('src', './imagens/' + icone_sucesso_editar_item_imagem.dataset.arquivo);
                    $('#lnk_excluir_imagem' + hdn_editar_item_imagem_id_item.value).attr('style', 'display: flex;');
                } else {
                    div_sucesso_editar_item_imagem.innerHTML = jsonData.error;
                }
                div_sucesso_editar_item_imagem.classList.add("show");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#frm_editar_orcamento_id_item').submit(function(e) {
        e.preventDefault();
        let hdn_editar_orcamento_excluir_item_id_item = document.getElementById('hdn_editar_orcamento_excluir_item_id_item');
        let div_sucesso_editar_orcamento_id_item = document.getElementById('div_sucesso_editar_orcamento_id_item' + hdn_editar_orcamento_excluir_item_id_item.value);
        $.ajax({
            type: "POST",
            url: 'excluir_id_item_orcamento.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_orcamento_id_item.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_orcamento_id_item.innerHTML = jsonData.error;
                }
                div_sucesso_editar_orcamento_id_item.classList.add("show");
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