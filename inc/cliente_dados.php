<?php
/*ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);*/

define('CLASS_DIR', '../src/');
set_include_path((get_include_path().PATH_SEPARATOR.CLASS_DIR));
spl_autoload_register();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clientes Code.education</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site para code.education">
    <meta name="author" content="Fernando Pontes">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/colorbox.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="container-conteudo">
    <?php
    if(isset($_GET['id']) && $_GET['id'] != "")
    {
        require_once '../config/config.php';

        $sql = new ADO\Types\InstrucaoSelectSql();
        $sql->setTabelaDb($config['db-tabela-clientes']);
        $sql->adicionarColuna('id');
        $sql->adicionarColuna('nome');
        $sql->adicionarColuna('data_nascimento');
        $sql->adicionarColuna('email');
        $sql->adicionarColuna('cpf');
        $sql->adicionarColuna('cnpj');
        $sql->adicionarColuna('celular');
        $sql->adicionarColuna('endereco');
        $sql->adicionarColuna('numero');
        $sql->adicionarColuna('bairro');
        $sql->adicionarColuna('tipo');
        $sql->adicionarColuna('telefone');
        $sql->adicionarColuna('cidade');
        $sql->adicionarColuna('estado');
        $sql->adicionarColuna('pontuacao');

        $criterio = new ADO\Criterios();
        $criterio->adicionarExpressao(new ADO\Filtro('id', '=', $_GET['id']));

        $sql->setCriterio($criterio);

        try
        {
            $conexao = ADO\ConexaoDb::abrirConexaoDb($config);

            $resultado = $conexao->query($sql->getInstrucaoSql());

            if($resultado)
            {
                $cliente = $resultado->fetch(PDO::FETCH_ASSOC);

                if(count($cliente) > 0)
                {
                    print('<legend>Dados do cliente:</legend><br>');

                    printf('<div class="row"><div class="col-sm-6 col-md-6">
                        <fiedset><label>Nome:</label><br>%s</fiedset><br><br>
                        <fiedset><label>Email:</label><br>%s</fiedset><br><br>
                        <fiedset><label>Data de nascimento:</label><br>%s</fiedset><br><br>
                        <fiedset><label>CPF:</label><br>%s</fiedset><br><br>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <fiedset><label>Telefone:</label><br>%s</fiedset><br><br>
                        <fiedset><label>Celular:</label><br>%s</fiedset><br><br>
                        <fiedset><label>Endereço:</label><br>%s, %s - %s</fiedset><br><br>
                        <fiedset><label>Cidade/Estado:</label><br>%s/%s</fiedset>
                    </div></div>',
                        $cliente['nome'],
                        $cliente['email'],
                        $cliente['data_nascimento'],
                        ($cliente['tipo'] == 'PF') ? $cliente['cpf'] : $cliente['cnpj'],
                        $cliente['telefone'],
                        $cliente['celular'],
                        $cliente['endereco'],
                        $cliente['numero'],
                        $cliente['bairro'],
                        $cliente['cidade'],
                        $cliente['estado']);

                    /*if(count($clientes[$_GET['id']]->getEnderecoCobranca()) > 0)
                    {
                        $dados_cobranca = $clientes[$_GET['id']]->getEnderecoCobranca();

                        printf('<div class="row">
                        <strong>Endereço de cobrança:</strong><br>
                        <fiedset>%s, %s - %s<br>%s/%s</fiedset>
                        </div>',
                            $dados_cobranca['endereco'],
                            $dados_cobranca['numero'],
                            $dados_cobranca['bairro'],
                            $dados_cobranca['cidade'],
                            $dados_cobranca['estado']);
                    }*/
                }
            }
        }
        catch (PDOException $e)
        {
            printf('<p>Algo deu errado :(</p><p>%s</p>', $e->getMessage());
        }
    }
    ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>