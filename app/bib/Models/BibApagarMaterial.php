<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarMaterial
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarMaterial {

    private $DadosId;
    private $Resultado;
    private $DadosMaterial;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarMaterial($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verBiblioCad();
        if ($this->Resultado) {
            $this->verMaterial();
            if ($this->DadosMaterial) {
                $this->apagaMaterial();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este Material não foi apagado!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Material não pode ser apagado, há bibliografias cadastradas com este material!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaMaterial() {
        $apagarMaterial = new \App\adms\Models\helper\AdmsDelete();
        $apagarMaterial->exeDelete("bib_tipo_material", "WHERE cod_id =:cod_id", "cod_id={$this->DadosId}");
        if ($apagarMaterial->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/material/' . $this->DadosId . '/' . $this->DadosMaterial[0]['arq_imagem'], 'app/bib/assets/imagens/material/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Material apagado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Material não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }

    private function verBiblioCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT mat.cod_id FROM bib_tipo_material mat
                INNER JOIN bib_biblio bib ON bib.tipo_material_id=mat.cod_id
                WHERE bib.tipo_material_id =:tipo_material_id
                LIMIT :limit", "tipo_material_id=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O material não pode ser apagado, há bibliografias cadastradas com este material!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verMaterial() {
        $verMaterial = new \App\adms\Models\helper\AdmsRead();
        $verMaterial->fullRead("SELECT mat.arq_imagem FROM bib_tipo_material mat
                WHERE mat.cod_id =:cod_id LIMIT :limit", "cod_id=" . $this->DadosId . "&limit=1");
        $this->DadosMaterial = $verMaterial->getResultado();
    }

}
