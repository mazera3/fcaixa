<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEditarCatImovel
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEditarCatImovel
{

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function verCatImovel($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verCatImovel = new \App\adms\Models\helper\AdmsRead();
        $verCatImovel->fullRead("SELECT * FROM cx_imovel
                WHERE id_imv =:id_imv LIMIT :limit", "id_imv=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verCatImovel->getResultado();
        return $this->Resultado;
    }

    public function altCatImovel(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditCatImovel();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditCatImovel()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltCatImovel = new \App\adms\Models\helper\AdmsUpdate();
        $upAltCatImovel->exeUpdate("cx_imovel", $this->Dados, "WHERE id_imv =:id_imv", "id_imv=" . $this->Dados['id_imv']);
        if ($upAltCatImovel->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>CatImovel atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A CatImovel não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }
}
