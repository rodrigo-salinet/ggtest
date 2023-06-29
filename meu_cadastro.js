function alterarNomeUsuario(obj) {
    let id_usuario = obj.dataset.usuario;
    let txt_editar_usuario_nome = document.getElementById('txt_editar_usuario_nome');

    let hdn_editar_usuario_nome_id_usuario = document.getElementById('hdn_editar_usuario_nome_id_usuario');
    let hdn_editar_usuario_nome_usuario = document.getElementById('hdn_editar_usuario_nome_usuario');

    hdn_editar_usuario_nome_id_usuario.value = id_usuario;
    hdn_editar_usuario_nome_usuario.value = txt_editar_usuario_nome.value;

    $('#frm_editar_usuario_nome').trigger("submit");
}

function alterarLoginUsuario(obj) {
    let id_usuario = obj.dataset.usuario;
    let txt_editar_usuario_login = document.getElementById('txt_editar_usuario_login');

    let hdn_editar_usuario_login_id_usuario = document.getElementById('hdn_editar_usuario_login_id_usuario');
    let hdn_editar_usuario_login_usuario = document.getElementById('hdn_editar_usuario_login_usuario');

    hdn_editar_usuario_login_id_usuario.value = id_usuario;
    hdn_editar_usuario_login_usuario.value = txt_editar_usuario_login.value;

    $('#frm_editar_usuario_login').trigger("submit");
}

function alterarSenhaUsuario(obj) {
    if (!confirm("Tem certeza de que deseja alterar esta senha? Não será possível reverter esta ação depois!")) {
        return false;
    }

    let id_usuario = obj.dataset.usuario;
    let txt_editar_usuario_senha = document.getElementById('txt_editar_usuario_senha');

    let hdn_editar_usuario_senha_id_usuario = document.getElementById('hdn_editar_usuario_senha_id_usuario');
    let hdn_editar_usuario_senha_usuario = document.getElementById('hdn_editar_usuario_senha_usuario');

    hdn_editar_usuario_senha_id_usuario.value = id_usuario;
    hdn_editar_usuario_senha_usuario.value = txt_editar_usuario_senha.value;

    $('#frm_editar_usuario_senha').trigger("submit");
}

$(document).ready(function() {

    $('#frm_editar_usuario_nome').submit(function(e) {
        e.preventDefault();
        let div_sucesso_editar_usuario_nome = document.getElementById('div_sucesso_editar_usuario_nome');
        let nome_usuario = document.getElementById('nome_usuario');
        let txt_editar_usuario_nome = document.getElementById('txt_editar_usuario_nome');
        $.ajax({
            type: "POST",
            url: 'editar_nome_usuario.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_usuario_nome.innerHTML = jsonData.message;
                    nome_usuario.innerText = txt_editar_usuario_nome.value;
                } else {
                    div_sucesso_editar_usuario_nome.innerHTML = jsonData.error;
                }
                div_sucesso_editar_usuario_nome.classList.add("show");
            }
        });
    });

    $('#frm_editar_usuario_login').submit(function(e) {
        e.preventDefault();
        let div_sucesso_editar_usuario_login = document.getElementById('div_sucesso_editar_usuario_login');
        $.ajax({
            type: "POST",
            url: 'editar_login_usuario.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_usuario_login.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_usuario_login.innerHTML = jsonData.error;
                }
                div_sucesso_editar_usuario_login.classList.add("show");
            }
        });
    });

    $('#frm_editar_usuario_senha').submit(function(e) {
        e.preventDefault();
        let div_sucesso_editar_usuario_senha = document.getElementById('div_sucesso_editar_usuario_senha');
        $.ajax({
            type: "POST",
            url: 'editar_senha_usuario.php',
            data: $(this).serialize(),
            success: function(response) {
                let jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    div_sucesso_editar_usuario_senha.innerHTML = jsonData.message;
                } else {
                    div_sucesso_editar_usuario_senha.innerHTML = jsonData.error;
                }
                div_sucesso_editar_usuario_senha.classList.add("show");
            }
        });
    });

});