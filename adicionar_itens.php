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
    <title>Adicionar Itens -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_adicionar_itens">
        <div class="container-fluid">
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-shopping-cart text-warning"></i>
                        Adicionar Itens a um Orçamento
                    </h5>
                </div>
            </div>
            <?php if (!isset($_GET['id_orcamento']))  { ?>
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-ban text-danger"></i>
                        Selecione um orçamento no canto superior <i class="fa fa-arrow-up text-success"></i> direito <i class="fa fa-arrow-right text-success"></i> para continuar
                    </h5>
                </div>
            </div>
            <?php } else { ?>
            <div class="row">
                <?php
                    $id_orcamento_get = $_GET['id_orcamento'];
                    $str_sql_itens = "select * from `tbl_itens`;";
                    $sql_itens = mysqli_query($conexao, $str_sql_itens);
                    $qtd_itens = mysqli_num_rows($sql_itens);
                    for ($i = 0; $i < $qtd_itens; $i++) {
                        $item = mysqli_fetch_array($sql_itens);
                        $id_item = $item['id'];
                        $imagem_item = $item['imagem'];
                        if ($imagem_item == "") {
                            $imagem_item = "sem-foto.jpg";
                        }
                        $nome_item = $item['nome'];
                        $descricao_item = $item['descricao'];

                        $str_sql_itens_orcamentos = "select * from `tbl_itens_orcamentos`where `id_item` = $id_item and `id_orcamento` = $id_orcamento_get;";
                        $sql_itens_orcamentos = mysqli_query($conexao, $str_sql_itens_orcamentos);
                        $qtd_itens_orcamentos = mysqli_num_rows($sql_itens_orcamentos);

                        $quantidade_item_orcamento = 0;
                        for ($io = 0; $io < $qtd_itens_orcamentos; $io++) {
                            $itens_orcamentos = mysqli_fetch_array($sql_itens_orcamentos);
                            $quantidade_item_orcamento = $itens_orcamentos['quantidade'];
                        }
                ?>
                <div class="col-auto mb-3">
                    <div class="card text-center" style="width: 18rem;">
                        <img class="card-img-top img-item" src="<?php echo "./imagens/$imagem_item"; ?>" alt="Produto 1" loading="lazy" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $nome_item; ?></h5>
                            <p class="card-text"><?php echo $descricao_item; ?></p>
                            <p class="card-text">ID: <?php echo $id_item; ?></p>
                            <div class="text-center">Quantidade</div>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <button class="rounded border-0" onclick="diminuirQuantidade(this);" data-item="<?php echo $id_item; ?>"><i class="fa fa-minus text-danger"></i></button>
                                </span>
                                <input type="text" class="form-control text-center border-0" maxlength="2" data-item="<?php echo $id_item; ?>" id="txt_quantidade<?php echo $id_item; ?>" value="<?php echo $quantidade_item_orcamento; ?>" disabled>
                                <span class="input-group-text">
                                    <button class="rounded border-0" onclick="aumentarQuantidade(this);" data-item="<?php echo $id_item; ?>"><i class="fa fa-plus text-success"></i></button>
                                </span>
                            </div>
                            <?php if (@$_SESSION['tipo_usuario'] == 2) { ?>
                            <div class="col-auto">
                                <select class="form-select" id="precos_item<?php echo $id_item; ?>">
                                    <option selected disable>Clique aqui para selecionar o preço do fornecedor</option>
                                    <?php
                                        $str_sql_precos_item = "select * from `tbl_precos_itens` where `id_item` = '$id_item' order by `preco` asc;";
                                        $sql_precos_item = mysqli_query($conexao, $str_sql_precos_item);
                                        $qtd_precos_item = mysqli_num_rows($sql_precos_item);
                                        if ($qtd_precos_item > 3) { $qtd_precos_item = 3; }
                                        for ($p = 0; $p < $qtd_precos_item; $p++) {
                                            $precos_item = mysqli_fetch_array($sql_precos_item);
                                            $id_preco = $precos_item['id'];
                                            $id_fornecedor = $precos_item['id_fornecedor'];
                                            $preco_item = $precos_item['preco'];
                                            $str_sql_fornecedor = "select * from `tbl_fornecedores` where `id` = $id_fornecedor;";
                                            $sql_fornecedor = mysqli_query($conexao, $str_sql_fornecedor);
                                            $qtd_fornecedor = mysqli_num_rows($sql_fornecedor);
                                            for ($f = 0; $f < $qtd_fornecedor; $f++) {
                                                $fornecedor = mysqli_fetch_array($sql_fornecedor);
                                                $fornecedor_nome = $fornecedor['nome'];
                                            }
                                            $destaque = "";
                                            $txt_destaque = "";
                                            if ($p == 0) {
                                                $destaque = 'class="fw-bold"';
                                                $txt_destaque = " -> Melhor preço!";
                                            }
                                    ?>
                                    <option value="<?php echo $id_preco; ?>" <?php echo $destaque; ?>>R$<?php echo number_format($preco_item, 2, ',', '.'); ?> -> <?php echo $fornecedor_nome; ?><?php echo $txt_destaque; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <?php } ?>
                            <?php if (@$_SESSION['tipo_usuario'] == 1) { ?>
                            <!-- <button onclick="adicionarOrcamento(this)" class="btn btn-primary mx-auto d-block" data-user="<?php echo $_SESSION['id_usuario']; ?>" data-item="<?php echo $id_item; ?>">Adicionar</button> -->
                            <div class="container collapse border-0 mt-3 text-center" id="div_sucesso<?php echo $id_item; ?>">.</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
            <?php } ?>
        </div>
        <form method="post" id="frm_add_item" name="frm_add_item">
            <input type="hidden" name="hdn_id_orcamento" id="hdn_id_orcamento" />
            <input type="hidden" name="hdn_id_usuario" id="hdn_id_usuario" />
            <input type="hidden" name="hdn_id_item" id="hdn_id_item" />
            <input type="hidden" name="hdn_quantidade" id="hdn_quantidade" />
        </form>
        <form method="post" id="frm_atualizar_quantidade" name="frm_atualizar_quantidade">
            <input type="hidden" name="hdn_atualizar_quantidade_id_orcamento" id="hdn_atualizar_quantidade_id_orcamento" />
            <input type="hidden" name="hdn_atualizar_quantidade_id_usuario" id="hdn_atualizar_quantidade_id_usuario" />
            <input type="hidden" name="hdn_atualizar_quantidade_id_item" id="hdn_atualizar_quantidade_id_item" />
            <input type="hidden" name="hdn_atualizar_quantidade_txt_quantidade" id="hdn_atualizar_quantidade_txt_quantidade" />
        </form>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="adicionar_itens.js"></script>
</body>
</html>
