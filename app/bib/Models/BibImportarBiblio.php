<?php

namespace App\bib\Models;

use DOMDocument;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Description of BibImportarBiblio
 *
 * @copyright (c) year, Édio Mazera
 */
class BibImportarBiblio {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function importarXml($Dados = null) {
        $this->Dados['xml'] = $Dados;
        if (!empty($this->Dados['xml'])) {

            $arquivo = new DomDocument();
            $arquivo->load($_FILES['xml']['tmp_name']);
            //var_dump($arquivo);
            $linhas = $arquivo->getElementsByTagName("Row");
            //var_dump($linhas);
            $primeira_linha = true;
            foreach ($linhas as $linha) {
                if ($primeira_linha == false) {
                    $this->Lista = array(
                        'tipo_material_id' => $linha->getElementsByTagName("Data")->item(0)->nodeValue,
                        'created' => date('Y-m-d H:i:s'),
                        'colecao_id' => $linha->getElementsByTagName("Data")->item(1)->nodeValue,
                        'chamada' => $linha->getElementsByTagName("Data")->item(2)->nodeValue,
                        'titulo' => $linha->getElementsByTagName("Data")->item(3)->nodeValue,
                        'sub_titulo' => $linha->getElementsByTagName("Data")->item(4)->nodeValue,
                        'isbn' => $linha->getElementsByTagName("Data")->item(5)->nodeValue,
                        'ano' => $linha->getElementsByTagName("Data")->item(6)->nodeValue,
                        'editora_id' => $linha->getElementsByTagName("Data")->item(7)->nodeValue,
                        'autor_id' => $linha->getElementsByTagName("Data")->item(8)->nodeValue,
                        'topicos' => $linha->getElementsByTagName("Data")->item(9)->nodeValue,
                        'sit_id' => $linha->getElementsByTagName("Data")->item(10)->nodeValue
                    );
                    $importar = new \App\adms\Models\helper\AdmsCreate;
                    $importar->exeCreate("bib_biblio", $this->Lista);
                }
                $primeira_linha = false;
            }
            if ($importar->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Dados importados com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível importadar os dados!!</div>";
                $this->Resultado = false;
            }
        }
    }

    public function importarCsv($Dados = null) {
        $this->Dados['csv'] = $Dados;
        if (!empty($this->Dados['csv'])) {

            $arquivo_tmp = $_FILES['csv']['tmp_name'];
            $linhas = file($arquivo_tmp);

            $primeira_linha = true;
            foreach ($linhas as $linha) {
                if ($primeira_linha == false) {
                    $linha = trim($linha);
                    $valor = explode(',', $linha);
                    
                    $this->Lista = array(
                        'tipo_material_id' => $valor[0],
                        'created' => date('Y-m-d H:i:s'),
                        'colecao_id' => $valor[1],
                        'chamada' => $valor[2],
                        'titulo' => $valor[3],
                        'sub_titulo' => $valor[4],
                        'isbn' => $valor[5],
                        'ano' => $valor[6],
                        'editora_id' => $valor[7],
                        'autor_id' => $valor[8],
                        'topicos' => $valor[9],
                        'sit_id' => $valor[10]
                    );
                    $importar = new \App\adms\Models\helper\AdmsCreate;
                    $importar->exeCreate("bib_biblio", $this->Lista);
                }
                $primeira_linha = false;
            }
            if ($importar->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Dados importados com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível importadar os dados!!</div>";
                $this->Resultado = false;
            }
        }
    }

}
