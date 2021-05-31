<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Backup
 *
 * @copyright (c) year, Édio Mazera
 */
class Backup {

    private $Dados;

    public function backup() {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['Restaurar'])) {
            $this->Dados['file'] = ($_FILES['file'] ? $_FILES['file'] : null);
        }
        // fazer backup de arquivos e diretorios
        if (!empty($this->Dados['BkArquivos'])) {
            unset($this->Dados['BkArquivos']);
            // var_dump($this->Dados);
            $bkArquivos = new \App\bib\Models\BibBackup();
            $bkArquivos->bkArquivos();
        }
        // fazer backp de banco de dados
        if (!empty($this->Dados['Backup'])) {
            unset($this->Dados['Backup']);
            $backup = new \App\bib\Models\BibBackup();
            $backup->geraBackup();
        }

        if (!empty($this->Dados['file'])) {
           $restaurar = new \App\bib\Models\BibBackup();
           $restaurar->restaurarBackup($this->Dados['file']);
           $_SESSION['msg'] = "<div class='alert alert-success'>Base de dados restaurada com sucesso!</div>";
        }

        $this->DadosBk = filter_input(INPUT_GET, "bk", FILTER_SANITIZE_STRING);
        if (is_file($this->DadosBk)) {
            if (isset($this->DadosBk) AND!empty($this->DadosBk)) {
                unlink($this->DadosBk);
                $_SESSION['msg'] = "<div class='alert alert-success'>Arquivo excluído com sucesso!</div>";
            }
        }

        $botao = ['del_backup' => ['menu_controller' => 'backup', 'menu_metodo' => 'backup']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/backup/backup", $this->Dados);
        $carregarView->renderizar();
    }

}
