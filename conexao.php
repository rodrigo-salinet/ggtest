<?php
// carregamento da interface do sistema
require_once('interface.php');

/**
 * conexão com o servidor MySQL e Banco de Dados "ggtest"
 * @servidor string
 * @usuario string
 * @senha_usuario string
 * @banco string
 * @conexao object
 * @arquivo object
 * @mensagem string
 */

// local do servidor
$servidor = "127.0.0.1";

// nome do usuario
$usuario = "root";

// senha
$senha_usuario = "magento";

// nome do banco de dados
$banco = "ggtest";

// método de tentativa de conexão ao servidor do banco de dados
try {
    // variável estática global de conexão
    $conexao = @mysqli_connect(
        $servidor,
        $usuario,
        $senha_usuario,
        $banco
    );
} catch (\Exception $e) {
    // nome do arquivo
    $arquivo_nome = "falha conexao mysql $ano $mes $dia $hora $minuto $segundo $milesimo.txt";

    // diretório destino
    $diretorio_nome = './logs/';

    // criando arquivo
    $arquivo = fopen($diretorio_nome . $arquivo_nome,'w');

    // mensagem de erro do arquivo
    $erro_arquivo = "Não foi possível criar o arquivo $arquivo_nome no diretório $diretorio_nome.";

    // verificando arquivo
    if ($arquivo == false) echo($erro_arquivo);

    // escrevendo no arquivo
    fwrite($arquivo, __FILE__ . " \r\n $e");

    // fechamento do arquivo
    fclose($arquivo);

    // mensagem para o usuário
    $mensagem = "
        Ops! A conexão com o servidor de banco de dados não está respondendo. Tente novamente mais tarde.
        <br/>
        Pedimos desculpas pelo transtorno e informamos que este inconveniente já está sendo resolvido pela nossa equipe de analistas.
        <br/>
        Se quiser mais informações sobre o ocorrido, nossa central de suporte está pronta para lhe atender em horário comercial (das 8h às 18h) através do fone (43) 9 0000-0000 (whatsapp) ou email suporte@sistemadeorcamentosonline.com.br, pois seu contato é muito importante para nós.
        <br/>
        Venha conhecer nossa loja física, das 8h às 18h, na Av. dos Orçamentos n. 123, Jardim dos Pedidos, Cidade do Comprador, Estado do Gerente.
    ";

    // exibição da mensagem para o cliente
    die($mensagem);
}

?>