<?php

namespace App\cx\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEmail
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEmail
{
    private $Resultado;
    private $Dados;
    private $Formato;
    
    function getResultado()
    {
        return $this->Resultado;
    }

        
    public function valEmail($Email)
    {
        $this->Dados = (string) $Email;
        $this->Formato = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';
        
        if(preg_match($this->Formato, $this->Dados)){
            $this->Resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: E-mail inválido!</div>";
            $this->Resultado = false;
        }
    }
}
