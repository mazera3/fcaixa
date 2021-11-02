<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxCadastrarCatImovel
 *
 * @copyright (c) year, Édio Mazera
 */
class CxCadastrarCatImovel
{

    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadImovel(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->verImovelCad();
            if ($this->Resultado) {
                $this->inserirImovel();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirImovel()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");

        $cadImovel = new \App\adms\Models\helper\AdmsCreate;
        $cadImovel->exeCreate("cx_imovel", $this->Dados);
        //var_dump($this->Dados);
        if ($cadImovel->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Imovel cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Imovel não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    private function verImovelCad()
    {
        $listarImovel = new \App\adms\Models\helper\AdmsRead();
        $listarImovel->fullRead("SELECT * FROM cx_imovel
        WHERE imovel=:imovel
        LIMIT :limit", "limit=1&imovel={$this->Dados['imovel']}");
        if ($listarImovel->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Imovel {$this->Dados['imovel']} Já existe!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }
}
