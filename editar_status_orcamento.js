function editarStatusOrcamento(obj) {
    let id_status = obj.dataset.status;
    let txt_editar_status_orcamento = document.getElementById('txt_editar_status_orcamento' + id_status);

    let hdn_editar_status_orcamento_id_status_orcamento = document.getElementById('hdn_editar_status_orcamento_id_status_orcamento');
    let hdn_editar_status_orcamento_txt_status_orcamento = document.getElementById('hdn_editar_status_orcamento_txt_status_orcamento');

    hdn_editar_status_orcamento_id_status_orcamento.value = id_status;
    hdn_editar_status_orcamento_txt_status_orcamento.value = txt_editar_status_orcamento.value;

    $('#frm_editar_status_orcamento_txt_status_orcamento').trigger("submit");
}

function excluirStatusOrcamento(obj) {
    if (!confirm("Tem certeza de que deseja excluir este Status de Orçamento? Não será possível reverter esta ação depois!")) {
        return false;
    }

    let id_status = obj.dataset.status;

    let hdn_editar_status_orcamento_excluir_id_status_orcamento = document.getElementById('hdn_editar_status_orcamento_excluir_id_status_orcamento');

    hdn_editar_status_orcamento_excluir_id_status_orcamento.value = id_status;

    $('#frm_editar_status_orcamento_id_status_orcamento').trigger("submit");
}

$(document).ready(function() {

    $('#frm_editar_status_orcamento_txt_status_orcamento').submit(function(e) {
        e.preventDefault();
        let hdn_editar_status_orcamento_id_status_orcamento = document.getElementById('hdn_editar_status_orcamento_id_status_orcamento');
        let div_sucesso_editar_status_orcamento_status = document.getElementById('div_sucesso_editar_status_orcamento_status' + hdn_editar_status_orcamento_id_status_orcamento.value);
        $.ajax({
            type: "POST",
            url: 'editar_status.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_status_orcamento_status.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_status_orcamento_status.innerHTML = jsonData.error;
                }
                div_sucesso_editar_status_orcamento_status.classList.add("show");
            }
        });
    });

    $('#frm_editar_status_orcamento_id_status_orcamento').submit(function(e) {
        e.preventDefault();
        let hdn_editar_status_orcamento_excluir_id_status_orcamento = document.getElementById('hdn_editar_status_orcamento_excluir_id_status_orcamento');
        let div_sucesso_editar_status_orcamento_id_status = document.getElementById('div_sucesso_editar_status_orcamento_id_status' + hdn_editar_status_orcamento_excluir_id_status_orcamento.value);
        let div_row_status = document.getElementById('div_row_status' + hdn_editar_status_orcamento_excluir_id_status_orcamento.value);
        $.ajax({
            type: "POST",
            url: 'excluir_id_status_orcamento.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_row_status.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_status_orcamento_id_status.innerHTML = jsonData.error;
                    div_sucesso_editar_status_orcamento_id_status.classList.add("show");
                }
            }
        });
    });

});