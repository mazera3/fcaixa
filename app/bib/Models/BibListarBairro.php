<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarBairro
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarBairro {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarBairro($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'bairros/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(br_id) AS num_result FROM bib_bairro");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBairro = new \App\adms\Models\helper\AdmsRead();
        $listarBairro->fullRead("SELECT br.*, mun.municipio FROM bib_bairro br
                INNER JOIN bib_municipio mun ON mun.mun_id=br.id_mun
                ORDER BY br.br_id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBairro->getResultado();
        return $this->Resultado;
    }

}
