<?php

namespace App\cx\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEmailUnico
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEmailUnico
{
    private $Email;
    private $Resultado;
    private $EditarUnico;
    private $DadoId;
            
    function getResultado()
    {
        return $this->Resultado;
    }
        
    public function valEmailUnico($Email, $EditarUnico = null, $DadoId = null)
    {
        $this->Email = (string) $Email;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valEmailUnico = new \App\adms\Models\helper\AdmsRead();
        if(!empty($this->EditarUnico) AND ($this->EditarUnico == true)){
            $valEmailUnico->fullRead("SELECT leitor_id FROM bib_leitor WHERE email=:email AND leitor_id <>:leitor_id LIMIT :limit", "email={$this->Email}&limit=1&leitor_id={$this->DadoId}");
        }else{
            $valEmailUnico->fullRead("SELECT leitor_id FROM bib_leitor WHERE email=:email LIMIT :limit", "email={$this->Email}&limit=1");
        }        
        $this->Resultado = $valEmailUnico->getResultado();
        if (!empty($this->Resultado)) {            
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este e-mail já está cadastrado!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }
}
