<?php
date_default_timezone_set('America/Recife');

use Clientes\ClienteAbstract;
use ADO\Types\InstrucaoInsertSql;

define('CLASS_DIR', 'src/');
set_include_path((get_include_path().PATH_SEPARATOR.CLASS_DIR));
spl_autoload_register();

class Fixture
{
    private $conexao;
    private $clientes;
    private $tabela_db;

    public function __construct($config)
    {
        $this->conexao = ADO\ConexaoDb::abrirConexaoDb($config);
        $this->tabela_db = $config['db-tabela-clientes'];
        $this->criarTabelas();
    }

    private function criarTabelas()
    {
        try
        {
            $this->conexao->query("
                                    CREATE TABLE IF NOT EXISTS clientes (
                                      id int(10) unsigned NOT NULL AUTO_INCREMENT,
                                      nome varchar(150) NOT NULL,
                                      data_nascimento date NOT NULL,
                                      email varchar(150) NOT NULL,
                                      cpf varchar(20) DEFAULT NULL,
                                      cnpj varchar(20) DEFAULT NULL,
                                      telefone varchar(20) DEFAULT NULL,
                                      celular varchar(20) DEFAULT NULL,
                                      endereco varchar(50) NOT NULL,
                                      numero varchar(5) NOT NULL,
                                      bairro varchar(50) NOT NULL,
                                      cidade varchar(50) NOT NULL,
                                      estado varchar(2) NOT NULL,
                                      pontuacao int(11) NOT NULL,
                                      tipo enum('PJ','PF') NOT NULL,
                                      data_cad date NOT NULL,
                                      PRIMARY KEY (id)
                                    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
            ");
        }
        catch (PDOException $e)
        {
            printf('<p>%s</p>', $e->getMessage());
        }
    }

    public function persist(ClienteAbstract $cliente)
    {
        $this->clientes[] = $cliente;
    }

    public function flush()
    {
        $msg_erro = "";
        $sql = new InstrucaoInsertSql();
        $sql->setTabelaDb($this->tabela_db);

        foreach($this->clientes as $item)
        {
            $sql->setLinhaDados('nome', $item->getNome());
            $sql->setLinhaDados('data_nascimento', $item->getDataNascimento());
            $sql->setLinhaDados('email', $item->getEmail());

            if($item->getTipoCliente() == 'PF')
            {
                $sql->setLinhaDados('cpf', $item->getCpf());
                $sql->setLinhaDados('cnpj', NULL);
            }
            else {
                $sql->setLinhaDados('cpf', NULL);
                $sql->setLinhaDados('cnpj', $item->getCnpj());
            }

            $sql->setLinhaDados('telefone', $item->getTelefone());
            $sql->setLinhaDados('celular', $item->getCelular());
            $sql->setLinhaDados('endereco', $item->getEndereco());
            $sql->setLinhaDados('numero', $item->getNumero());
            $sql->setLinhaDados('bairro', $item->getBairro());
            $sql->setLinhaDados('cidade', $item->getCidade());
            $sql->setLinhaDados('estado', $item->getEstado());
            $sql->setLinhaDados('pontuacao', $item->getPontuacao());
            $sql->setLinhaDados('tipo', $item->getTipoCliente());
            $sql->setLinhaDados('data_cad', date('Y-m-d'));

            try
            {
                $this->conexao->query($sql->getInstrucaoSql());
            }
            catch (PDOException $e)
            {
                $msg_erro .= sprintf('<p>%s</p>', $e->getMessage());
            }
        }

        if($msg_erro == "")
        {
            print('<p>Dados importados para o banco de dados com sucesso!</p>');
        }
        else {
            printf('<p>Algo deu errado :(</p>%', $msg_erro);
        }

        $this->conexao = null;
    }
}

require_once 'config/config.php';
require_once 'inc/cliente_lista.php';

$fixture = new Fixture($config);

foreach($clientes as $item)
{
    $fixture->persist($item);
}

$fixture->flush();