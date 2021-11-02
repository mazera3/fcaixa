<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEditarPatrimonio
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEditarPatrimonio
{

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function verPatrimonio($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPatrimonio = new \App\adms\Models\helper\AdmsRead();
        $verPatrimonio->fullRead("SELECT * FROM cx_patrimonio
                WHERE id_pat =:id_pat LIMIT :limit", "id_pat=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verPatrimonio->getResultado();
        return $this->Resultado;
    }

    public function altPatrimonio(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditPatrimonio();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditPatrimonio()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['usuario_id'] = (int) $_SESSION['usuario_id'];
        
        $upAltPatrimonio = new \App\adms\Models\helper\AdmsUpdate();
        $upAltPatrimonio->exeUpdate("cx_patrimonio", $this->Dados, "WHERE id_pat =:id_pat", "id_pat=" . $this->Dados['id_pat']);
        if ($upAltPatrimonio->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Patrimonio atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Patrimonio não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_imv, imovel FROM cx_imovel ORDER BY id_imv ASC");
        $registro['imv'] = $listar->getResultado();

        $this->Resultado = [
            'imv' => $registro['imv']
        ];

        return $this->Resultado;
    }
}
