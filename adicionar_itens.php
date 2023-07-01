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
            <div class="row align-items-center">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-shopping-cart text-warning"></i>
                        Adicionar Itens a um Orçamento
                    </h5>
                </div>
            </div>
            <?php if (!isset($_GET['id_orcamento']))  { ?>
            <div class="row align-items-center">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-ban text-danger"></i>
                        Selecione um orçamento no canto superior <i class="fa fa-arrow-up text-success"></i> direito <i class="fa fa-arrow-right text-success"></i> para continuar
                    </h5>
                </div>
            </div>
            <?php } else { ?>
            <div class="row align-items-center">
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
                            <div class="input-group">
                                <span class="input-group-text">
                                    <button class="rounded border-0" onclick="diminuirQuantidade(this);" data-item="<?php echo $id_item; ?>" title="Diminuir Quantidade"><i class="fa fa-minus text-danger"></i></button>
                                </span>
                                <div class="form-floating">
                                    <input type="text" class="form-control text-center border-0" maxlength="2" data-item="<?php echo $id_item; ?>" id="txt_quantidade<?php echo $id_item; ?>" value="<?php echo $quantidade_item_orcamento; ?>" disabled>
                                    <label class="text-center" for="txt_quantidade<?php echo $id_item; ?>">Quantidade</label>
                                </div>
                                <span class="input-group-text">
                                    <button class="rounded border-0" onclick="aumentarQuantidade(this);" data-item="<?php echo $id_item; ?>" title="Aumentar Quantidade"><i class="fa fa-plus text-success"></i></button>
                                </span>
                            </div>
                            <div class="container collapse border-0 mt-3 text-center" id="div_sucesso<?php echo $id_item; ?>">.</div>
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
