<?php

namespace App\bib\core;

/**
 * Description of ConfigView
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ConfigView
{

    private $Nome;
    private $Dados;

    public function __construct($Nome, array $Dados = null)
    {
        $this->Nome = (string) $Nome;
        $this->Dados = $Dados;
    }

    public function renderizar()
    {
        include 'app/bib/Views/include/cabecalho_bib.php';
        include 'app/adms/Views/include/header.php';
        include 'app/adms/Views/include/sidebar.php';
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        }else{
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
        include 'app/bib/Views/include/rodape_bib.php';
    }

    public function renderizarListar()
    {        
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        }else{
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }

}
