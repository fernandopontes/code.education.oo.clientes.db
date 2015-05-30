<?php

namespace ADO;


class ConexaoDb
{
    private function __construct() {}

    public static function abrirConexaoDb($config)
    {
        $usuario    =   $config['db-usuario'];
        $senha      =   $config['db-senha'];
        $nome       =   $config['db-nome'];
        $host       =   $config['db-host'];
        $tipo       =   $config['db-tipo'];

        switch($tipo)
        {
            case 'mysql':
                try
                {
                    $conexao =  new \PDO("mysql:host={$host};dbname={$nome};charset=utf8", $usuario, $senha);
                }
                catch (\PDOException $e)
                {
                    printf('Conexão falhou: %s', $e->getMessage());
                }

            break;
        }

        $conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $conexao;
    }
} 