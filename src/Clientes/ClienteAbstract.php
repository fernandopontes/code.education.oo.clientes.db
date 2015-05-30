<?php

namespace Clientes;


use Clientes\Interfaces\ClassificacaoInterface;
use Clientes\Interfaces\EnderecoCobranca;

abstract class ClienteAbstract implements
    EnderecoCobranca,
    ClassificacaoInterface
    {
    private $nome;
    private $data_nascimento;
    private $email;
    private $telefone;
    private $celular;
    private $endereco;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $endereco_cobranca;
    private $pontuacao;
    protected $tipo_cliente;

    function __construct($dados_cliente)
    {
        if(is_array($dados_cliente) && count($dados_cliente) > 0)
        {
            $this->nome             =   $dados_cliente['nome'];
            $this->data_nascimento  =   $dados_cliente['data_nascimento'];
            $this->email            =   $dados_cliente['email'];
            $this->telefone         =   $dados_cliente['telefone'];
            $this->celular          =   $dados_cliente['celular'];
            $this->endereco         =   $dados_cliente['endereco'];
            $this->numero           =   $dados_cliente['numero'];
            $this->bairro           =   $dados_cliente['bairro'];
            $this->cidade           =   $dados_cliente['cidade'];
            $this->estado           =   $dados_cliente['estado'];
            $this->pontuacao        =   $dados_cliente['pontuacao'];
            $this->endereco_cobranca  =   $dados_cliente['endereco_cobranca'];
        }
        else {
            throw new Exception('Não há clientes');
        }

    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @param mixed $data_nascimento
     */
    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @param mixed $pontuacao
     */
    public function setPontuacao($pontuacao)
    {
        $this->pontuacao = $pontuacao;
    }

    /**
     * @param mixed $endere_cobranca
     */
    public function setEnderecoCobranca($endereco_cobranca)
    {
        $this->endereco_cobranca = $endereco_cobranca;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @return mixed
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @return mixed
     */
    public function getPontuacao()
    {
        return $this->pontuacao;
    }

    /**
     * @return mixed
     */
    public function getTipoCliente()
    {
        return $this->tipo_cliente;
    }

    /**
     * @return mixed
     */
    public function getEnderecoCobranca()
    {
        return $this->endereco_cobranca;
    }
}