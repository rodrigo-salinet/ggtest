<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

// phpinfo();

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_item_imagem_id_item']) && isset($_FILES['fil_editar_item_imagem'])) {
    $data['message'] = 'Começou, mas não terminou';
    $hdn_editar_item_imagem_id_item = $_POST['hdn_editar_item_imagem_id_item'];
    $nome_arquivo_destino = '';

    try {
        if (isset($_FILES['fil_editar_item_imagem'])) {
            $fil_editar_item_imagem = $_FILES['fil_editar_item_imagem']['name'];
            if($fil_editar_item_imagem != '') {
                $diretorio_imagens = "./imagens/";
                $arquivo_upload = basename($fil_editar_item_imagem);
                $prefixo_nome_arquivo_upload = explode(".", $arquivo_upload)[0];
                $extensao_arquivo_upload = strtolower(pathinfo($arquivo_upload,PATHINFO_EXTENSION));
                $arquivo_destino = $diretorio_imagens . $prefixo_nome_arquivo_upload . '-' . md5(rand(1, 999999)) . '.' . $extensao_arquivo_upload;
                $nome_arquivo_destino = basename($arquivo_destino);

                if(!getimagesize($_FILES["fil_editar_item_imagem"]["tmp_name"])) {
                    throw new Exception("Ops! O arquivo enviado não é uma imagem válida. Por favor volte e selecione outro arquivo de imagem válida.");
                }

                if (file_exists($arquivo_destino)) {
                    throw new Exception("Ops! Já existe um arquivo com o mesmo nome. Volte e tente novamente.");
                }

                if ($_FILES["fil_editar_item_imagem"]["size"] > 500000) {
                    throw new Exception("Ops! O arquivo enviado é muito grande. Volte e escolha outro arquivo menor que 50mb.");
                }

                if($extensao_arquivo_upload != "jpg" && $extensao_arquivo_upload != "png" && $extensao_arquivo_upload != "jpeg" && $extensao_arquivo_upload != "gif" ) {
                    throw new Exception("Ops! Somente arquivos com a extensão JPG, JPEG, PNG e GIF são aceitos.");
                }

                if (!move_uploaded_file($_FILES["fil_editar_item_imagem"]["tmp_name"], $arquivo_destino)) {
                    throw new Exception("Ops! Não foi possível enviar o arquivo. Volte e tente novamente.");
                }
            }
        }

        $str_sql_editar_imagem_item = "update `tbl_itens` set `imagem` = '$nome_arquivo_destino' where `id` = $hdn_editar_item_imagem_id_item;";
        $sql_editar_imagem_item = mysqli_query($conexao, $str_sql_editar_imagem_item);
        $data['message'] = '<i class="fa fa-check-circle-o text-success" id="icone_sucesso_editar_item_imagem" data-arquivo="' . $nome_arquivo_destino . '"></i> Imagem alterada com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = "Não foi possível alterar a imagem! Mensagem: $e";
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>