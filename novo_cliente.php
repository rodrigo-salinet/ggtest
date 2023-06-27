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
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-users text-warning"></i>
                        Novo Cliente
                    </h5>
                </div>
            </div>
            <form action="adicionar_cliente.php" method="post" id="frm_novo_cliente" name="frm_novo_cliente">
                <div class="row">
                    <div class="col mb-3 text-center">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="txt_nome_cliente" id="txt_nome_cliente" placeholder="Digite aqui o nome do cliente" />
                            <input type="submit" class="btn btn-outline-success" value="Criar Cliente">
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
