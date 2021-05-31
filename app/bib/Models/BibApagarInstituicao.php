<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarInstituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarInstituicao {

    private $DadosId;
    private $Resultado;
    private $DadosInstituicao;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarInstituicao($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verInstituicao();
        if ($this->DadosInstituicao) {
            $this->apagaInstituicao();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Instituicao não foi apagado!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaInstituicao() {

        $apagarInstituicao = new \App\adms\Models\helper\AdmsDelete();
        $apagarInstituicao->exeDelete("bib_instituicao", "WHERE id_instituicao =:id_instituicao", "id_instituicao={$this->DadosId}");
        if ($apagarInstituicao->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/instituicao/' . $this->DadosId . '/' . $this->DadosInstituicao[0]['logo_instituicao'], 'app/bib/assets/imagens/instituicao/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Instituicao apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Instituicao não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

    public function contaInstituicaoCad() {
        $contInstituicao = new \App\adms\Models\helper\AdmsRead();
        $contInstituicao->fullRead("SELECT COUNT(id_instituicao) AS num_instituicao FROM bib_instituicao");
        $this->Resultado = $contInstituicao->getResultado();
        return $this->Resultado;
    }

    private function verInstituicao() {
        $verInstituicao = new \App\adms\Models\helper\AdmsRead();
        $verInstituicao->fullRead("SELECT es.logo_instituicao FROM bib_instituicao es
                WHERE es.id_instituicao =:id_instituicao LIMIT :limit", "id_instituicao=" . $this->DadosId . "&limit=1");
        $this->DadosInstituicao = $verInstituicao->getResultado();
    }

}
