function editarNomeFornecedor(obj) {
    let id_fornecedor = obj.dataset.fornecedor;
    let txt_editar_nome_fornecedor = document.getElementById('txt_editar_nome_fornecedor' + id_fornecedor);

    let hdn_editar_fornecedor_id_fornecedor = document.getElementById('hdn_editar_fornecedor_id_fornecedor');
    let hdn_editar_fornecedor_txt_fornecedor = document.getElementById('hdn_editar_fornecedor_txt_fornecedor');

    hdn_editar_fornecedor_id_fornecedor.value = id_fornecedor;
    hdn_editar_fornecedor_txt_fornecedor.value = txt_editar_nome_fornecedor.value;

    $('#frm_editar_fornecedor_txt_fornecedor').trigger("submit");
}

function excluirFornecedor(obj) {
    if (!confirm("Tem certeza de que deseja excluir este Fornecedor? Não será possível reverter esta ação depois!")) {
        return false;
    }

    let id_fornecedor = obj.dataset.fornecedor;

    let hdn_editar_fornecedor_excluir_id_fornecedor = document.getElementById('hdn_editar_fornecedor_excluir_id_fornecedor');

    hdn_editar_fornecedor_excluir_id_fornecedor.value = id_fornecedor;

    $('#frm_editar_fornecedor_id_fornecedor').trigger("submit");
}

$(document).ready(function() {

    $('#frm_editar_fornecedor_txt_fornecedor').submit(function(e) {
        e.preventDefault();
        let hdn_editar_fornecedor_id_fornecedor = document.getElementById('hdn_editar_fornecedor_id_fornecedor');
        let div_sucesso_editar_fornecedor_nome_fornecedor = document.getElementById('div_sucesso_editar_fornecedor_nome_fornecedor' + hdn_editar_fornecedor_id_fornecedor.value);
        $.ajax({
            type: "POST",
            url: 'editar_nome_fornecedor.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_fornecedor_nome_fornecedor.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_fornecedor_nome_fornecedor.innerHTML = jsonData.error;
                }
                div_sucesso_editar_fornecedor_nome_fornecedor.classList.add("show");
            }
        });
    });

    $('#frm_editar_fornecedor_id_fornecedor').submit(function(e) {
        e.preventDefault();
        let hdn_editar_fornecedor_excluir_id_fornecedor = document.getElementById('hdn_editar_fornecedor_excluir_id_fornecedor');
        let div_sucesso_editar_fornecedor_id_fornecedor = document.getElementById('div_sucesso_editar_fornecedor_id_fornecedor' + hdn_editar_fornecedor_excluir_id_fornecedor.value);
        let div_row_fornecedor = document.getElementById('div_row_fornecedor' + hdn_editar_fornecedor_excluir_id_fornecedor.value);
        $.ajax({
            type: "POST",
            url: 'excluir_id_fornecedor.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_row_fornecedor.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_fornecedor_id_fornecedor.innerHTML = jsonData.error;
                    div_sucesso_editar_fornecedor_id_fornecedor.classList.add("show");
                }
            }
        });
    });

});