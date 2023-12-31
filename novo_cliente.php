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
    <title>Novo Cliente -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_novo_cliente">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-users text-warning"></i>
                        Novo Cliente
                    </h5>
                </div>
            </div>
            <form action="adicionar_cliente.php" method="post" id="frm_novo_cliente" name="frm_novo_cliente">
                <div class="row align-items-center">
                    <div class="col mb-3">
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="txt_nome_cliente" id="txt_nome_cliente" placeholder="Digite aqui o nome do cliente" />
                                <label for="txt_nome_cliente">Digite aqui o nome do cliente</label>
                            </div>
                            <input type="submit" class="btn btn-outline-success" value="Criar Cliente">
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="chk_redirect" id="chk_redirect" checked />
                            <label class="form-check-label" for="chk_redirect">Depois disso criar novo orçamento</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="novo_cliente.js"></script>

</body>
</html>
