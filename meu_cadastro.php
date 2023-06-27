<?php
session_start();
require_once('conexao.php');

if (!isset($_SESSION['logado'])) {
    header('Location: login.php?msg=' . htmlspecialchars("Para entrar no sistema é necessário estar cadastrado e logado."));
}

$id_usuario = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <?php require_once('scripts_header.php'); ?>
    <title>Meu Cadastro -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_meu_cadastro">
        <div class="container-fluid">
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-vcard text-warning"></i>
                        Meu Cadastro
                    </h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col text-center">
                    ID Usuário
                </div>
                <div class="col text-center">
                    Nome
                </div>
                <div class="col text-center">
                    login
                </div>
                <div class="col text-center">
                    Senha
                </div>
            </div>
            <?php
                $str_sql_usuario = "select * from `tbl_usuarios` where `id` = $id_usuario;";
                $sql_usuario = mysqli_query($conexao, $str_sql_usuario);
                $qtd_usuario = mysqli_num_rows($sql_usuario);

                for ($u = 0; $u < $qtd_usuario; $u++) {
                    $usuario = mysqli_fetch_array($sql_usuario);
                    $id_usuario = $usuario['id'];
                    $nome_usuario = $usuario['nome'];
                    $login_usuario = $usuario['login'];
            ?>
            <div class="row" id="div_row_usuario">
                <div class="col text-center">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_editar_id_usuario" value="<?php echo $id_usuario; ?>" disabled />
                    </div>
                </div>
                <div class="col text-center">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_editar_usuario_nome" value="<?php echo $nome_usuario; ?>">
                        <a href="#" onclick="alterarNomeUsuario(this)" class="input-group-text" data-usuario="<?php echo $id_usuario; ?>"><i class="text-warning fa fa-eraser" title="Alterar este Nome do Usuário"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_usuario_nome">
                        .
                    </div>
                </div>
                <div class="col text-center">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_editar_usuario_login" value="<?php echo $login_usuario; ?>">
                        <a href="#" onclick="alterarLoginUsuario(this)" class="input-group-text" data-usuario="<?php echo $id_usuario; ?>"><i class="text-warning fa fa-eraser" title="Alterar este Login"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_usuario_login">
                        .
                    </div>
                </div>
                <div class="col text-center">
                    <div class="input-group">
                        <input type="password" class="form-control" id="txt_editar_usuario_senha" />
                        <a href="#" onclick="alterarSenhaUsuario(this)" class="input-group-text" data-usuario="<?php echo $id_usuario; ?>"><i class="text-warning fa fa-eraser" title="Alterar a Senha atual"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_usuario_senha">
                        .
                    </div>
                </div>
            </div>
            <?php } ?>
            <form method="post" id="frm_editar_usuario_nome" name="frm_editar_usuario_nome">
                <input type="hidden" name="hdn_editar_usuario_nome_id_usuario" id="hdn_editar_usuario_nome_id_usuario" />
                <input type="hidden" name="hdn_editar_usuario_nome_usuario" id="hdn_editar_usuario_nome_usuario" />
            </form>
            <form id="frm_editar_usuario_login" name="frm_editar_usuario_login">
                <input type="hidden" name="hdn_editar_usuario_login_id_usuario" id="hdn_editar_usuario_login_id_usuario" />
                <input type="hidden" name="hdn_editar_usuario_login_usuario" id="hdn_editar_usuario_login_usuario" />
            </form>
            <form id="frm_editar_usuario_senha" name="frm_editar_usuario_senha">
                <input type="hidden" name="hdn_editar_usuario_senha_id_usuario" id="hdn_editar_usuario_senha_id_usuario" />
                <input type="hidden" name="hdn_editar_usuario_senha_usuario" id="hdn_editar_usuario_senha_usuario" />
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="meu_cadastro.js"></script>

</body>
</html>
