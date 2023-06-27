<?php
// phpinfo(); die();
session_start();
require_once('conexao.php');

$redirect = 'novo_item.php';
$msg = "Nada aconteceu";

if (!isset($_SESSION['logado'])) {
    $redirect = 'login.php';
    $msg = "É necessário realizar o login para utilizar o sistema.";
} else if (isset($_POST['txt_nome_item']) && isset($_POST['txt_descricao_item'])) {
    $fil_upload_imagem = $_FILES['fil_upload_imagem']['name'];
    $txt_nome_item = $_POST['txt_nome_item'];
    $txt_descricao_item = $_POST['txt_descricao_item'];

    try {
        $diretorio_imagens = "./imagens/";
        $arquivo_upload = basename($fil_upload_imagem);
        $prefixo_nome_arquivo_upload = explode(".", $arquivo_upload)[0];
        $extensao_arquivo_upload = strtolower(pathinfo($arquivo_upload,PATHINFO_EXTENSION));
        $arquivo_destino = $diretorio_imagens . $prefixo_nome_arquivo_upload . '-' . md5(rand(1, 999999)) . '.' . $extensao_arquivo_upload;
        $nome_arquivo_destino = basename($arquivo_destino);

        if(!getimagesize($_FILES["fil_upload_imagem"]["tmp_name"])) {
            throw new Exception("Ops! O arquivo enviado não é uma imagem válida. Por favor volte e selecione outro arquivo de imagem válida.");
        }

        if (file_exists($arquivo_destino)) {
            throw new Exception("Ops! Já existe um arquivo com o mesmo nome. Volte e tente novamente.");
        }

        if ($_FILES["fil_upload_imagem"]["size"] > 500000) {
            throw new Exception("Ops! O arquivo enviado é muito grande. Volte e escolha outro arquivo menor que 50mb.");
        }

        if($extensao_arquivo_upload != "jpg" && $extensao_arquivo_upload != "png" && $extensao_arquivo_upload != "jpeg" && $extensao_arquivo_upload != "gif" ) {
            throw new Exception("Ops! Somente arquivos com a extensão JPG, JPEG, PNG e GIF são aceitos.");
        }

        if (!move_uploaded_file($_FILES["fil_upload_imagem"]["tmp_name"], $arquivo_destino)) {
            throw new Exception("Ops! Não foi possível enviar o arquivo. Volte e tente novamente.");
        }

        $str_sql_adicionar_item = "insert into `tbl_itens` (`imagem`,`nome`,`descricao`) values ('$nome_arquivo_destino', '$txt_nome_item', '$txt_descricao_item');";
        $sql_adicionar_item = mysqli_query($conexao, $str_sql_adicionar_item);
        $msg = 'Item adicionado com sucesso!';
    } catch (\Exception $e) {
        $msg = "Ocorreu o erro: ." . str_replace(array("\r", "\n"), '', $e);
    }
}

header('Location: ' . $redirect . '?msg=' . htmlspecialchars($msg));
?>