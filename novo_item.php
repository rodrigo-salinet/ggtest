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
            <div class="row align-items-center">
                <div class="col text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-shopping-cart text-warning"></i>
                        Novo Item
                    </h5>
                </div>
            </div>
            <form action="adicionar_item.php" method="post" id="frm_novo_item" name="frm_novo_item" enctype="multipart/form-data">
                <div class="row align-items-center mb-3">
                    <div class="col text-center">
                        <div class="form-floating">
                            <input type="file" class="form-control" name="fil_upload_imagem" id="fil_upload_imagem" />
                            <label for="fil_upload_imagem">Enviar Imagem</label>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col text-center">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="txt_nome_item" id="txt_nome_item" />
                            <label for="txt_nome_item">Nome</label>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col text-center">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="txt_descricao_item" id="txt_descricao_item" />
                            <label for="txt_descricao_item">Descrição</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="chk_redirect" id="chk_redirect" checked />
                            <label class="form-check-label" for="chk_redirect">Depois disso criar novo cliente</label>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col text-center">
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
