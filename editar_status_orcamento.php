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
    <title>Editar Status de Orçamento -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_editar_cliente">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-users text-warning"></i>
                        Editar/Excluir Status de Orçamento
                    </h5>
                </div>
            </div>
            <div class="row align-items-center mb-3">
                <div class="col text-center">
                    ID
                </div>
                <div class="col text-center">
                    Status
                </div>
            </div>
            <?php
                $str_sql_status_orcamento = "select * from `tbl_status_orcamento`;";
                $sql_status_orcamento = mysqli_query($conexao, $str_sql_status_orcamento);
                $qtd_status_orcamento = mysqli_num_rows($sql_status_orcamento);

                for ($o = 0; $o < $qtd_status_orcamento; $o++) {
                    $status_orcamento = mysqli_fetch_array($sql_status_orcamento);
                    $id_status_orcamento = $status_orcamento['id'];
                    $status = $status_orcamento['status'];
            ?>
            <div class="row align-items-center mb-3" id="div_row_status<?php echo $id_status_orcamento; ?>">
                <div class="col text-center">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_editar_id_status_orcamento<?php echo $id_status_orcamento; ?>" value="<?php echo $id_status_orcamento; ?>" disabled />
                        <a href="#stay" onclick="excluirStatusOrcamento(this)" class="input-group-text" data-status="<?php echo $id_status_orcamento; ?>"><i class="text-danger fa fa-trash" title="Excluir Status de Orçamento"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_status_orcamento_id_status<?php echo $id_status_orcamento; ?>"></div>
                </div>
                <div class="col text-center">
                    <div class="input-group">
                        <input class="form-control" id="txt_editar_status_orcamento<?php echo $id_status_orcamento; ?>" data-status="<?php echo $id_status_orcamento; ?>" value="<?php echo $status; ?>" />
                        <a href="#stay" onclick="editarStatusOrcamento(this)" class="input-group-text" data-status="<?php echo $id_status_orcamento; ?>"><i class="text-warning fa fa-eraser" title="Alterar Status de Orcamento"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_status_orcamento_status<?php echo $id_status_orcamento; ?>"></div>
                </div>
            </div>
            <?php } ?>
            <form id="frm_editar_status_orcamento_txt_status_orcamento" name="frm_editar_status_orcamento_txt_status_orcamento">
                <input type="hidden" name="hdn_editar_status_orcamento_id_status_orcamento" id="hdn_editar_status_orcamento_id_status_orcamento" />
                <input type="hidden" name="hdn_editar_status_orcamento_txt_status_orcamento" id="hdn_editar_status_orcamento_txt_status_orcamento" />
            </form>
            <form id="frm_editar_status_orcamento_id_status_orcamento" name="frm_editar_status_orcamento_id_status_orcamento">
                <input type="hidden" name="hdn_editar_status_orcamento_excluir_id_status_orcamento" id="hdn_editar_status_orcamento_excluir_id_status_orcamento" />
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="editar_status_orcamento.js"></script>

</body>
</html>
