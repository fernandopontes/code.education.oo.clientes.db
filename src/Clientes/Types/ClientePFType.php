<?php

namespace Clientes\Types;

use Clientes\ClienteAbstract;

class ClientePFType extends ClienteAbstract {

    private $cpf;

    public function __construct($dados_cliente)
    {
        parent::__construct($dados_cliente);

        if(is_array($dados_cliente) && count($dados_cliente) > 0)
        {
            $this->cpf              =   $dados_cliente['cpf'];
        }
        else {
            throw new Exception('Não há clientes');
        }

        $this->tipo_cliente = 'PF';
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }
} 