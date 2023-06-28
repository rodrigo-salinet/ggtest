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
    <title>Editar Fornecedor -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_editar_fornecedor">
        <div class="container-fluid">
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-users text-warning"></i>
                        Editar/Excluir Fornecedor
                    </h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col text-center">
                    ID
                </div>
                <div class="col text-center">
                    Nome
                </div>
            </div>
            <?php
                $str_sql_fornecedores = "select * from `tbl_fornecedores`;";
                $sql_fornecedores = mysqli_query($conexao, $str_sql_fornecedores);
                $qtd_fornecedores = mysqli_num_rows($sql_fornecedores);

                for ($o = 0; $o < $qtd_fornecedores; $o++) {
                    $fornecedores = mysqli_fetch_array($sql_fornecedores);
                    $id_fornecedor = $fornecedores['id'];
                    $nome_fornecedor = $fornecedores['nome'];
            ?>
            <div class="row mb-3" id="div_row_fornecedor<?php echo $id_fornecedor; ?>">
                <div class="col text-center">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_editar_id_fornecedor<?php echo $id_fornecedor; ?>" value="<?php echo $id_fornecedor; ?>" disabled />
                        <a href="#" onclick="excluirFornecedor(this)" class="input-group-text" data-fornecedor="<?php echo $id_fornecedor; ?>"><i class="text-danger fa fa-trash" title="Excluir Fornecedor"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_fornecedor_id_fornecedor<?php echo $id_item; ?>"></div>
                </div>
                <div class="col text-center">
                    <div class="input-group">
                        <input class="form-control" id="txt_editar_nome_fornecedor<?php echo $id_fornecedor; ?>" data-fornecedor="<?php echo $id_fornecedor; ?>" value="<?php echo $nome_fornecedor; ?>" />
                        <a href="#" onclick="editarNomeFornecedor(this)" class="input-group-text" data-fornecedor="<?php echo $id_fornecedor; ?>"><i class="text-warning fa fa-eraser" title="Alterar Nome do Fornecedor"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_fornecedor_nome_fornecedor<?php echo $id_fornecedor; ?>">
                        .
                    </div>
                </div>
            </div>
            <?php } ?>
            <form id="frm_editar_fornecedor_txt_fornecedor" name="frm_editar_fornecedor_txt_fornecedor">
                <input type="hidden" name="hdn_editar_fornecedor_id_fornecedor" id="hdn_editar_fornecedor_id_fornecedor" />
                <input type="hidden" name="hdn_editar_fornecedor_txt_fornecedor" id="hdn_editar_fornecedor_txt_fornecedor" />
            </form>
            <form id="frm_editar_fornecedor_id_fornecedor" name="frm_editar_fornecedor_id_fornecedor">
                <input type="hidden" name="hdn_editar_fornecedor_excluir_id_fornecedor" id="hdn_editar_fornecedor_excluir_id_fornecedor" />
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="editar_fornecedor.js"></script>

</body>
</html>
