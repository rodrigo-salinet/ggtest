<?php
session_start();
require_once('conexao.php');

if (!@$_SESSION['logado']) {
    header('Location: login.php?msg=' . htmlspecialchars("Para entrar no sistema é necessário estar cadastrado e logado."));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Sistema de Orçamentos de Informática</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Sistema de Orçamentos de Informática</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Itens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Orçamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./sair.php">Sair</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
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
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="<?php echo "./imagens/$imagem_item"; ?>" alt="Produto 1">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nome_item; ?></h5>
                        <p class="card-text"><?php echo $descricao_item; ?></p>
                        <input type="text" id="txt_quantidade<?php echo $id_item; ?>" placeholder="Digite aqui a quantidade">
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
                                        if ($p == 0) {
                                            $destaque = 'class="fw-bold"';
                                        }
                                ?>
                                <option value="<?php echo $id_preco; ?>" <?php echo $destaque; ?>>R$<?php echo number_format($preco_item, 2, ',', '.'); ?> -> <?php echo $fornecedor_nome; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <?php if (@$_SESSION['tipo_usuario'] == 1) { ?>
                        <a href="javascript:adicionarOrcamento(this);" data-id-item="<?php echo $id_item; ?>" class="btn btn-primary">Adicionar ao orçamento</a>
                        <?php } ?>
                        <input  type="hidden" id="id_item<?php echo $id_item; ?>" value="<?php echo $id_item; ?>">
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <script src="./jquery-3.2.1.slim.min.js"></script>
    <script src="./popper.min.js"></script>
    <script src="./bootstrap-5.2.3-dist/js/bootstrap.min.js"></script>
    <script src="./funcoes.js"></script>
</body>
</html>