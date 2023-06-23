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
    <title>Excluir Orçamento -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content mt-4">
        <div class="container-fluid" id="sec_excluir_orcamento">
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-money text-warning"></i>
                        Excluir Orçamento
                    </h5>
                </div>
            </div>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="excluir_orcamento.js"></script>

</body>
</html>
