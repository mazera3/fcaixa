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
 * Description of BibImportarCsv
 *
 * @copyright (c) year, Édio Mazera
 */
class BibImportarLeitor {

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
                        'cod_barras_leitor' => $linha->getElementsByTagName("Data")->item(0)->nodeValue,
                        'created' => date('Y-m-d H:i:s'),
                        'primeiro_nome' => $linha->getElementsByTagName("Data")->item(1)->nodeValue,
                        'ultimo_nome' => $linha->getElementsByTagName("Data")->item(2)->nodeValue,
                        'id_mun' => $linha->getElementsByTagName("Data")->item(3)->nodeValue,
                        'bairro_id' => $linha->getElementsByTagName("Data")->item(4)->nodeValue,
                        'endereco' => $linha->getElementsByTagName("Data")->item(5)->nodeValue,
                        'fone' => $linha->getElementsByTagName("Data")->item(6)->nodeValue,
                        'celular' => $linha->getElementsByTagName("Data")->item(7)->nodeValue,
                        'email' => $linha->getElementsByTagName("Data")->item(8)->nodeValue,
                        'classificacao_id' => $linha->getElementsByTagName("Data")->item(9)->nodeValue,
                        'sits_leitor_id' => $linha->getElementsByTagName("Data")->item(10)->nodeValue
                    );
                    $importar = new \App\adms\Models\helper\AdmsCreate;
                    $importar->exeCreate("bib_leitor", $this->Lista);
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
                        'cod_barras_leitor' => $valor[0],
                        'created' => date('Y-m-d H:i:s'),
                        'primeiro_nome' => $valor[1],
                        'ultimo_nome' => $valor[2],
                        'id_mun' => $valor[3],
                        'bairro_id' => $valor[4],
                        'endereco' => $valor[5],
                        'fone' => $valor[6],
                        'celular' => $valor[7],
                        'email' => $valor[8],
                        'classificacao_id' => $valor[9],
                        'sits_leitor_id' => $valor[10]
                    );
                    $importar = new \App\adms\Models\helper\AdmsCreate;
                    $importar->exeCreate("bib_leitor", $this->Lista);
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
