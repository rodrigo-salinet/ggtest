function editarNomeCliente(obj) {
    let id_cliente = obj.dataset.cliente;
    let txt_editar_nome_cliente = document.getElementById('txt_editar_nome_cliente' + id_cliente);

    let hdn_editar_cliente_id_cliente = document.getElementById('hdn_editar_cliente_id_cliente');
    let hdn_editar_cliente_txt_cliente = document.getElementById('hdn_editar_cliente_txt_cliente');

    hdn_editar_cliente_id_cliente.value = id_cliente;
    hdn_editar_cliente_txt_cliente.value = txt_editar_nome_cliente.value;

    $('#frm_editar_cliente_txt_cliente').trigger("submit");
}

function excluirCliente(obj) {
    if (!confirm("Tem certeza de que deseja excluir este cliente? Não será possível reverter esta ação depois!")) {
        return false;
    }

    let id_cliente = obj.dataset.cliente;

    let hdn_editar_cliente_excluir_id_cliente = document.getElementById('hdn_editar_cliente_excluir_id_cliente');

    hdn_editar_cliente_excluir_id_cliente.value = id_cliente;

    $('#frm_editar_cliente_id_cliente').trigger("submit");
}

$(document).ready(function() {

    $('#frm_editar_cliente_txt_cliente').submit(function(e) {
        e.preventDefault();
        let hdn_editar_cliente_id_cliente = document.getElementById('hdn_editar_cliente_id_cliente');
        // console.log(hdn_editar_cliente_id_cliente);
        let div_sucesso_editar_cliente_nome_cliente = document.getElementById('div_sucesso_editar_cliente_nome_cliente' + hdn_editar_cliente_id_cliente.value);
        console.log(div_sucesso_editar_cliente_nome_cliente);
        $.ajax({
            type: "POST",
            url: 'editar_nome_cliente.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_cliente_nome_cliente.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_cliente_nome_cliente.innerHTML = jsonData.error;
                }
                div_sucesso_editar_cliente_nome_cliente.classList.add("show");
            }
        });
    });

    $('#frm_editar_cliente_id_cliente').submit(function(e) {
        e.preventDefault();
        let hdn_editar_cliente_excluir_id_cliente = document.getElementById('hdn_editar_cliente_excluir_id_cliente');
        let div_sucesso_editar_cliente_id_cliente = document.getElementById('div_sucesso_editar_cliente_id_cliente' + hdn_editar_cliente_excluir_id_cliente.value);
        let div_row_cliente = document.getElementById('div_row_cliente' + hdn_editar_cliente_excluir_id_cliente.value);
        $.ajax({
            type: "POST",
            url: 'excluir_id_cliente.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_row_cliente.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_cliente_id_cliente.innerHTML = jsonData.error;
                    div_sucesso_editar_cliente_id_cliente.classList.add("show");
                }
            }
        });
    });

});