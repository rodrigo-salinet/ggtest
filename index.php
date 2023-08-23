<?php
session_start();
require_once('conexao.php');
// teste

if (!@$_SESSION['logado']) {
    header('Location: login.php?msg=' . htmlspecialchars("Para entrar no sistema é necessário estar cadastrado e logado."));
}

$id_usuario = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <?php require_once('scripts_header.php'); ?>
    <title>S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_novo_item">
        <div class="container">
            <div class="row align-items-center">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-shopping-cart text-warning"></i>
                            Seja bem vindo ao S.O.I. -> Sistema de Orçamentos de Informática!
                    </h5>
                    <h3>
                        Utilize o menu no topo para navegar nas opções do sistema.
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="index.js"></script>

</body>
</html>
