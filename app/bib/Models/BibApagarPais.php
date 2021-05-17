<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarPais
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarPais {

    private $DadosId;
    private $Resultado;
    private $DadosPais;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarPais($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verUfCad();
        if ($this->Resultado) {
            $this->verPais();
            if ($this->DadosPais) {
                $this->apagaPais();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Pais não foi apagado!</div>";
                $this->Resultado = false;
            }
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Pais não pode ser apagado, há itens cadastrados com este país!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaPais() {
        $apagarPais = new \App\adms\Models\helper\AdmsDelete();
        $apagarPais->exeDelete("bib_pais", "WHERE pais_id =:pais_id", "pais_id={$this->DadosId}");
        if ($apagarPais->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/pais/' . $this->DadosId . '/' . $this->DadosPais[0]['bandeira'], 'app/bib/assets/imagens/pais/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Pais apagado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Pais não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }
// verifica se há estados cadastrados com esse país
    private function verUfCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT p.pais_id FROM bib_pais p
                INNER JOIN bib_uf uf ON uf.id_pais=p.pais_id
                WHERE uf.id_pais =:id_pais
                LIMIT :limit", "id_pais=" . $this->DadosId . "&limit=1");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O País não pode ser apagado, há <b>estados</b> cadastrados com este País!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
            $this->verEditoraCad();
        }
    }
    // verifica se há editoras cadastradas com esse país
    private function verEditoraCad() {
        $verEditora = new \App\adms\Models\helper\AdmsRead();
        $verEditora->fullRead("SELECT p.pais_id FROM bib_pais p
                INNER JOIN bib_editora ed ON ed.id_pais=p.pais_id
                WHERE ed.id_pais =:id_pais
                LIMIT :limit", "id_pais=" . $this->DadosId . "&limit=2");
        if ($verEditora->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O país não pode ser apagado, há <b>editoras</b> cadastradas com este país!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verPais() {
        $verPais = new \App\adms\Models\helper\AdmsRead();
        $verPais->fullRead("SELECT p.bandeira FROM bib_pais p
                WHERE p.pais_id =:pais_id LIMIT :limit", "pais_id=" . $this->DadosId . "&limit=1");
        $this->DadosPais = $verPais->getResultado();
    }

}
