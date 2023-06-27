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
    <title>Novo Item -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_novo_item">
        <div class="container-fluid">
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-shopping-cart text-warning"></i>
                        Novo Item
                    </h5>
                </div>
            </div>
            <form action="adicionar_item.php" method="post" id="frm_novo_item" name="frm_novo_item" enctype="multipart/form-data">
                <div class="row">
                    <div class="col mb-3 text-center">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Enviar Imagem</span>
                            <input type="file" class="form-control" name="fil_upload_imagem" id="fil_upload_imagem" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3 text-center">
                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text is-invalid">@</span>
                            <div class="form-floating is-invalid">
                                <input type="text" class="form-control is-invalid" name="txt_nome_item" id="txt_nome_item" placeholder="Digite aqui o nome do item" required />
                                <label for="txt_nome_item">Nome</label>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, digite um nome acima para poder Criar Item.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3 text-center">
                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text">@</span>
                            <div class="form-floating is-invalid">
                                <input type="text" class="form-control is-invalid" name="txt_descricao_item" id="txt_descricao_item" placeholder="Digite aqui a descrição do item" required />
                                <label for="txt_descricao_item">Descrição</label>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, digite uma descrição acima para poder Criar Item.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3 text-center">
                        <input type="submit" class="btn btn-outline-success" value="Criar item">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="novo_item.js"></script>

</body>
</html>
