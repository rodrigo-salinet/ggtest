

$(document).ready(function() {

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
        let opt_orcamento = document.getElementById('opt_orcamento' + hdn_editar_orcamento_excluir_orcamento_id_orcamento.value);
        $.ajax({
            type: "POST",
            url: 'excluir_id_orcamento.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_row_orcamento.innerHTML = jsonData.message;
                    opt_orcamento.style.display = "none";
                } else {
                    div_sucesso_editar_orcamento_id_orcamento.innerHTML = jsonData.error;
                    div_sucesso_editar_orcamento_id_orcamento.classList.add("show");
                }
            }
        });
    });

});