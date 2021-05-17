<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarMaterial
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarMaterial
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 20;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listarMaterial($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'material/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cod_id) AS num_result FROM bib_tipo_material");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarMaterial = new \App\adms\Models\helper\AdmsRead();
        $listarMaterial->fullRead("SELECT mat.* FROM bib_tipo_material mat ORDER BY cod_id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarMaterial->getResultado();
        return $this->Resultado;
    }

}
