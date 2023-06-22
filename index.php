<?php
session_start();
require_once('conexao.php');

if (!@$_SESSION['logado']) {
    header('Location: login.php?msg=' . htmlspecialchars("Para entrar no sistema é necessário estar cadastrado e logado."));
}
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="icon" href="./favicon.png" />
    <title>S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <nav class="nav navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container-fluid">
            <span class="navbar-brand" title="Sistema de Orçamento de Informática">S.O.I.</span>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-align-justify"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-underline navbar-nav me-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:verItens()">Itens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:verNovoOrcamento()">Novo Orçamento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:verOrcamentos()">Orçamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./sair.php">Sair</a>
                    </li>
                </ul>
                <div class="d-flex" role="search">
                    <select id="sel_orcamentos" class="form-select">
                        <option value="0" selected>Selecione aqui um orçamento</option>
                        <?php
                            $str_sql_orcamentos = "select * from `tbl_orcamentos`;";
                            $sql_orcamentos = mysqli_query($conexao, $str_sql_orcamentos);
                            $qtd_orcamentos = mysqli_num_rows($sql_orcamentos);
                            for ($o = 0; $o < $qtd_orcamentos; $o++) {
                                $orcamento = mysqli_fetch_array($sql_orcamentos);
                                $id_orcamento = $orcamento['id'];
                                $id_cliente = $orcamento['id_cliente'];
                                $str_sql_cliente = "select * from tbl_clientes where id = $id_cliente;";
                                $sql_cliente = mysqli_query($conexao, $str_sql_cliente);
                                $qtd_cliente = mysqli_num_rows($sql_cliente);
                                for ($c = 0; $c < $qtd_cliente; $c++) {
                                    $cliente = mysqli_fetch_array($sql_cliente);
                                    $nome_cliente = $cliente['nome'];
                                }
                        ?>
                        <option value="<?php echo $id_orcamento; ?>"><?php echo $id_orcamento; ?> -> <?php echo $nome_cliente; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </nav>

    <header class="content">
        <div class="container collapse show" id="sec_cabecalho">
            <div class="row">
                <div class="col-md-4 mb-3 mt-3">
                    &nbsp;
                </div>
            </div>
        </div>
    </header>

    <section class="content">
        <div class="container collapse show" id="sec_itens">
            <div class="row">
                <div class="col-md-4 mb-3 mt-3">
                    &nbsp;
                </div>
            </div>
            <?php if (isset($_GET['msg'])) { ?>
            <div class="row">
                <h1 class="h1"><?php echo $_GET['msg']; ?></h1>
            </div>
            <?php } ?>
            <div class="row">
                <?php
                    $str_sql_itens = "select * from `tbl_itens`;";
                    $sql_itens = mysqli_query($conexao, $str_sql_itens);
                    $qtd_itens = mysqli_num_rows($sql_itens);
                    for ($i = 0; $i < $qtd_itens; $i++) {
                        $item = mysqli_fetch_array($sql_itens);
                        $id_item = $item['id'];
                        $imagem_item = $item['imagem'];
                        $nome_item = $item['nome'];
                        $descricao_item = $item['descricao'];
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo "./imagens/$imagem_item"; ?>" alt="Produto 1" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $nome_item; ?></h5>
                            <p class="card-text"><?php echo $descricao_item; ?></p>
                            <div class="text-center">Quantidade</div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-warning">
                                    <button class="rounded border-0" onclick="diminuirQuantidade(this);" data-item="<?php echo $id_item; ?>">-</button>
                                </span>
                                <div class="form-control">
                                    <input type="text" class="form-control text-center border-0" maxlength="2" id="txt_quantidade<?php echo $id_item; ?>" placeholder="Quantidade" aria-label="Quantidade" value="1">
                                </div>
                                <span class="input-group-text bg-success">
                                    <button class="rounded border-0" onclick="aumentarQuantidade(this);" data-item="<?php echo $id_item; ?>">+</button>
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
                            </div>
                            <?php } ?>
                            <?php if (@$_SESSION['tipo_usuario'] == 1) { ?>
                            <button onclick="adicionarOrcamento(this)" class="btn btn-primary mx-auto d-block" data-user="<?php echo $_SESSION['id_usuario']; ?>" data-item="<?php echo $id_item; ?>">Adicionar ao orçamento</button>
                            <div class="container collapse border-0 mt-3 text-center text-success" id="div_sucesso<?php echo $id_item; ?>">.</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container collapse" id="sec_novo_orcamento">
            Seção Novo Orçamento
        </div>
    </section>

    <section class="content">
        <div class="container collapse" id="sec_orcamentos">
            Seção Orçamentos
        </div>
    </section>

    <form method="post" id="frm_temp" name="frm_temp">
        <input type="hidden" name="hdn_id_orcamento" id="hdn_id_orcamento" />
        <input type="hidden" name="hdn_id_usuario" id="hdn_id_usuario" />
        <input type="hidden" name="hdn_id_item" id="hdn_id_item" />
        <input type="hidden" name="hdn_quantidade" id="hdn_quantidade" />
        <input type="submit" value="enviar" style="display: none;" />
    </form>

    <script type="text/javascript" src="./node_modules/jquery/dist/jquery.min.js"></script>
    <!-- <script src="./node_modules/@popperjs/core/dist/umd/popper-lite.min.js"></script> -->
    <script type="text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./funcoes.js"></script>
</body>
</html>