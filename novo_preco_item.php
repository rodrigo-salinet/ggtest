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
    <title>Novo Preço de Item -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_novo_preco_item">
        <div class="container-fluid">
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-shopping-cart text-warning"></i>
                        Novo Preço de Item
                    </h5>
                </div>
            </div>
            <form action="adicionar_preco_item.php" method="post" id="frm_novo_preco_item" name="frm_novo_preco_item">
                <div class="row">
                    <div class="col mb-3 text-center">
                        <div class="form-floating">
                            <select class="form-select" name="sel_id_item" id="sel_id_item">
                                <option value="0" selected disabled>Selecione aqui o Item</option>
                                <?php
                                    $str_sql_itens = "select * from `tbl_itens`";
                                    $sql_itens = mysqli_query($conexao, $str_sql_itens);
                                    $qtd_itens = mysqli_num_rows($sql_itens);

                                    for ($i = 0; $i < $qtd_itens; $i++) {
                                        $itens = mysqli_fetch_array($sql_itens);
                                        $id_item = $itens['id'];
                                        $nome_item = $itens['nome'];
                                ?>
                                <option value="<?php echo $id_item; ?>"><?php echo $nome_item; ?></option>
                                <?php } ?>
                            </select>
                            <label for="sel_id_item">Itens</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3 text-center">
                        <div class="form-floating">
                            <select class="form-select" name="sel_id_fornecedor" id="sel_id_fornecedor">
                                <option value="0" selected disabled>Selecione aqui o Fornecedor</option>
                                <?php
                                    $str_sql_fornecedores = "select * from `tbl_fornecedores`";
                                    $sql_fornecedores = mysqli_query($conexao, $str_sql_fornecedores);
                                    $qtd_fornecedores = mysqli_num_rows($sql_fornecedores);

                                    for ($i = 0; $i < $qtd_fornecedores; $i++) {
                                        $fornecedores = mysqli_fetch_array($sql_fornecedores);
                                        $id_fornecedor = $fornecedores['id'];
                                        $nome_fornecedor = $fornecedores['nome'];
                                ?>
                                <option value="<?php echo $id_fornecedor; ?>"><?php echo $nome_fornecedor; ?></option>
                                <?php } ?>
                            </select>
                            <label for="sel_id_fornecedor">Fornecedores</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3 text-center">
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="txt_preco_item" id="txt_preco_item" onkeyup="formatarReal(this)" maxlength="10" />
                                <label for="txt_preco_item">Preço do Item (em Reais max. XXX.XXX,XX)</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3 text-center">
                        <input type="submit" class="btn btn-outline-success" value="Criar Preço de Item">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="novo_preco_item.js"></script>

</body>
</html>
