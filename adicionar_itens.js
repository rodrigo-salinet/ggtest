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
});
