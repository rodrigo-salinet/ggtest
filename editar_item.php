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
    <title>Editar Itens -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_editar_item">
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-shopping-cart text-warning"></i>
                        Editar Item
                    </h5>
                </div>
            </div>
            <?php
                $str_sql_itens = "select * from `tbl_itens`;";
                $sql_itens = mysqli_query($conexao, $str_sql_itens);
                $qtd_itens = mysqli_num_rows($sql_itens);

                for($i = 0; $i < $qtd_itens; $i++) {
                    $item = mysqli_fetch_array($sql_itens);
                    $id_item = $item['id'];
                    $imagem_item = $item['imagem'];
                    if ($imagem_item == "") {
                        $imagem_item = "sem-foto.jpg";
                    }
                $nome_item = $item['nome'];
                    $descricao_item = $item['descricao'];
            ?>
            <div class="row border-bottom border-5 border-dark mb-3 item<?php echo $id_item; ?>">
                <div class="col text-center">
                    &nbsp;
                </div>
            </div>
            <div class="row mb-3 text-center item<?php echo $id_item; ?>" id="div_id_item<?php echo $id_item; ?>">
                <div class="col text-center">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="txt_editar_id_item<?php echo $id_item; ?>" id="txt_editar_id_item<?php echo $id_item; ?>" value="<?php echo $id_item; ?>" disabled />
                            <label for="txt_editar_id_item<?php echo $id_item; ?>">ID</label>
                        </div>
                        <a href="#" onclick="excluirItem(this)" data-item="<?php echo $id_item; ?>" class="input-group-text" title="Excluir Item"><i class="fa fa-trash text-danger"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_item_id_item<?php echo $id_item; ?>">
                        .
                    </div>
                </div>
            </div>
            <div class="row mb-3 item<?php echo $id_item; ?>">
                <div class="col text-center">
                    <img src="./imagens/<?php echo $imagem_item; ?>" loading="lazy" class="img-item mb-3" id="img_editar_item<?php echo $id_item; ?>">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="file" class="form-control" id="fil_upload_imagem<?php echo $id_item; ?>" />
                            <label for="fil_upload_imagem<?php echo $id_item; ?>" class="bg-transparent">Editar Imagem</label>
                        </div>
                        <a href="#" onclick="alterarImagemItem(this)" data-item="<?php echo $id_item; ?>" class="input-group-text" title="Alterar Imagem do Item"><i class="fa fa-eraser text-warning"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_item_imagem<?php echo $id_item; ?>">
                        .
                    </div>
                </div>
            </div>
            <div class="row mb-3 item<?php echo $id_item; ?>">
                <div class="col text-center">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="txt_nome_item<?php echo $id_item; ?>" id="txt_nome_item<?php echo $id_item; ?>" placeholder="Digite aqui o nome do item" value="<?php echo $nome_item; ?>" />
                            <label for="txt_nome_item<?php echo $id_item; ?>">Nome</label>
                        </div>
                        <a href="#" onclick="alterarNomeItem(this)" data-item="<?php echo $id_item; ?>" class="input-group-text" title="Alterar Nome do Item"><i class="fa fa-eraser text-warning"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mb-3 item<?php echo $id_item; ?>">
                <div class="col text-center">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="txt_descricao_item<?php echo $id_item; ?>" id="txt_descricao_item<?php echo $id_item; ?>" placeholder="Digite aqui a descrição do item" value="<?php echo $descricao_item; ?>" />
                            <label for="txt_descricao_item<?php echo $id_item; ?>">Descrição</label>
                        </div>
                        <a href="#" onclick="alterarDescricaoItem(this)" data-item="<?php echo $id_item; ?>" class="input-group-text" title="Alterar Descrição do Item"><i class="fa fa-eraser text-warning"></i></a>
                    </div>
                </div>
            </div>
            <?php } ?>
            <form method="post" id="frm_editar_item_id_item" name="frm_editar_item_id_item" enctype="multipart/form-data">
                <input type="hidden" name="hdn_editar_item_excluir_item_id_item" id="hdn_editar_item_excluir_item_id_item" />
            </form>
            <form method="post" id="frm_editar_item_imagem" name="frm_editar_item_imagem" enctype="multipart/form-data">
                <input type="hidden" name="hdn_editar_item_imagem_id_item" id="hdn_editar_item_imagem_id_item" />
            </form>
            <form method="post" id="frm_editar_item_nome" name="frm_editar_item_nome">
                <input type="hidden" name="hdn_editar_item_nome_id_item" id="hdn_editar_item_nome_id_item" />
                <input type="hidden" name="hdn_editar_item_nome" id="hdn_editar_item_nome" />
            </form>
            <form method="post" id="frm_editar_item_descricao" name="frm_editar_item_descricao">
                <input type="hidden" name="hdn_editar_item_descricao_id_item" id="hdn_editar_item_descricao_id_item" />
                <input type="hidden" name="hdn_editar_item_descricao" id="hdn_editar_item_descricao" />
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="editar_item.js"></script>
    <script type="text/javascript">

    </script>

</body>
</html>
