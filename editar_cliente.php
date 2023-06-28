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
    <title>Editar Cliente -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_editar_cliente">
        <div class="container-fluid">
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-users text-warning"></i>
                        Editar/Excluir Cliente
                    </h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col text-center">
                    ID Cliente
                </div>
                <div class="col text-center">
                    Nome
                </div>
            </div>
            <?php
                $str_sql_clientes = "select * from `tbl_clientes`;";
                $sql_clientes = mysqli_query($conexao, $str_sql_clientes);
                $qtd_clientes = mysqli_num_rows($sql_clientes);

                for ($o = 0; $o < $qtd_clientes; $o++) {
                    $clientes = mysqli_fetch_array($sql_clientes);
                    $id_cliente = $clientes['id'];
                    $nome_cliente = $clientes['nome'];
            ?>
            <div class="row mb-3" id="div_row_cliente<?php echo $id_cliente; ?>">
                <div class="col text-center">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_editar_id_cliente<?php echo $id_cliente; ?>" value="<?php echo $id_cliente; ?>" disabled />
                        <a href="#" onclick="excluirCliente(this)" class="input-group-text" data-cliente="<?php echo $id_cliente; ?>"><i class="text-danger fa fa-trash" title="Excluir Cliente"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_cliente_id_cliente<?php echo $id_item; ?>"></div>
                </div>
                <div class="col text-center">
                    <div class="input-group">
                        <input class="form-control" id="txt_editar_nome_cliente<?php echo $id_cliente; ?>" data-cliente="<?php echo $id_cliente; ?>" value="<?php echo $nome_cliente; ?>" />
                        <a href="#" onclick="editarNomeCliente(this)" class="input-group-text" data-cliente="<?php echo $id_cliente; ?>"><i class="text-warning fa fa-eraser" title="Alterar Nome do Cliente"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_cliente_nome_cliente<?php echo $id_cliente; ?>">
                        .
                    </div>
                </div>
            </div>
            <?php } ?>
            <form id="frm_editar_cliente_txt_cliente" name="frm_editar_cliente_txt_cliente">
                <input type="hidden" name="hdn_editar_cliente_id_cliente" id="hdn_editar_cliente_id_cliente" />
                <input type="hidden" name="hdn_editar_cliente_txt_cliente" id="hdn_editar_cliente_txt_cliente" />
            </form>
            <form id="frm_editar_cliente_id_cliente" name="frm_editar_cliente_id_cliente">
                <input type="hidden" name="hdn_editar_cliente_excluir_id_cliente" id="hdn_editar_cliente_excluir_id_cliente" />
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="editar_cliente.js"></script>

</body>
</html>
