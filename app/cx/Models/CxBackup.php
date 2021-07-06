<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
/**
 * Description of CxBackup
 *
 * @copyright (c) year, Édio Mazera
 */
class CxBackup {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    //Ler as tabelas
    public function geraBackup() {
        $conn = mysqli_connect(HOST, USER, PASS, DBNAME);
        $result_tabela = "SHOW TABLES";
        $resultado_tabela = mysqli_query($conn, $result_tabela);
        //Ler as tabelas
        while ($row_tabela = mysqli_fetch_row($resultado_tabela)) {
            $tabelas[] = $row_tabela[0];
        }
        //var_dump($tabelas);
        $result = "";
        foreach ($tabelas as $tabela) {
            //Pesquisar o nome das colunas
            $result_colunas = "SELECT * FROM " . $tabela;
            $resultado_colunas = mysqli_query($conn, $result_colunas);
            $num_colunas = mysqli_num_fields($resultado_colunas);
            //echo "Quantidade de colunas na tabela: " . $tabela . " - " . $num_colunas . "<br>";
            //Criar a intrução para apagar a tabela caso a mesma exista no BD
            $result .= 'DROP TABLE IF EXISTS ' . $tabela . ';';
            $result .= "\n";
            //Pesquisar como a coluna é criada
            $result_cr_col = "SHOW CREATE TABLE " . $tabela;
            $resultado_cr_col = mysqli_query($conn, $result_cr_col);
            $row_cr_col = mysqli_fetch_row($resultado_cr_col);
            //var_dump($row_cr_col);
            $result .= "\n\n" . $row_cr_col[1] . ";\n\n";
            //echo $result;
            //Percorrer o array de colunas
            for ($i = 0; $i < $num_colunas; $i++) {
                //Ler o valor de cada coluna no bando de dados
                while ($row_tp_col = mysqli_fetch_row($resultado_colunas)) {
                    //var_dump($row_tp_col);
                    //Criar a intrução da Query para inserir os dados
                    $result .= 'INSERT INTO ' . $tabela . ' VALUES(';
                    //Ler os dados da tabela
                    for ($j = 0; $j < $num_colunas; $j++) {
                        //addslashes — Adiciona barras invertidas a uma string
                        $row_tp_col[$j] = addslashes($row_tp_col[$j]);
                        //str_replace — Substitui todas as ocorrências da string \n pela \\n
                        $row_tp_col[$j] = str_replace("\n", "\\n", $row_tp_col[$j]);

                        if (isset($row_tp_col[$j])) {
                            if (!empty($row_tp_col[$j])) {
                                $result .= '"' . $row_tp_col[$j] . '"';
                            } else {
                                $result .= 'NULL';
                            }
                        } else {
                            $result .= 'NULL';
                        }

                        if ($j < ($num_colunas - 1)) {
                            $result .= ',';
                        }
                    }
                    $result .= ");\n";
                }
            }
            $result .= "\n\n";
            //echo $result;
        }
        //$this->backup();
        //Criar o diretório de backup
        //$diretorio = SITE_ROOT . "/app/cx/assets/backup/";
        $diretorio = SITE_ROOT . "/backup/";
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
            chmod($diretorio, 0777);
        }

        //Nome do arquivo de backup
        $data = date('Y-m-d-h-i-s');
        $nome_arquivo = $diretorio . "backup_db_" . $data;
        //echo $nome_arquivo;
        $handle = fopen($nome_arquivo . '.sql', 'w+');
        fwrite($handle, $result);
        fclose($handle);
        //Montagem do link do arquivo
        $download = $nome_arquivo . ".sql";

        //Adicionar o header para download
        if (file_exists($download)) {
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment; filename=\"" . basename($download) . "\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($download));
            readfile($download);
            $_SESSION['msg'] = "<div class='alert alert-success'>Exportado BD com sucesso</div>";
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro ao exportar o BD</div>";
        }
        return $this->Resultado;
    }

    public function bkArquivos() {
        // Define o nome do nosso pacote Zip.
        //Criar o diretório de backup
        $diretorio_bk = SITE_ROOT . "/backup/";
        if (!is_dir($diretorio_bk)) {
            mkdir($diretorio_bk, 0777, true);
            chmod($diretorio_bk, 0777);
        }
        $arquivo = date('Y-m-d-H-i').'_backup.zip';

        // Apaga o backup anterior para que ele não seja compactado junto com o atual.
        //if (file_exists($arquivo)) unlink(realpath($arquivo));
            
        // diretório que será compactado
        // aqui estou compactando a pasta imagens do sistema.
        $diretorio = "./app/cx/assets/imagens";
        $rootPath = realpath($diretorio);

        // Inicia o Módulo ZipArchive do PHP
        $zip = new ZipArchive();
        $zip->open($diretorio_bk . $arquivo, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Compactação de subpastas
        $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($rootPath),
                RecursiveIteratorIterator::LEAVES_ONLY
        );

        // Varre todos os arquivos da pasta
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Adiciona os arquivos no pacote Zip.
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Encerra a criação do pacote .Zip
        $zip->close();
        $backup = $diretorio_bk . $arquivo;
        // faz o teste se a variavel não esta vazia e se o arquivo realmente existe
        if (isset($backup) && file_exists($backup)) {
            // verifica a extensão do arquivo para pegar o tipo
            switch (strtolower(substr(strrchr(basename($backup), "."), 1))) {
                case "zip": $tipo = "application/zip";
                    break;
                case "php": // deixar vazio por seurança
                case "htm": // deixar vazio por seurança
                case "html": // deixar vazio por seurança
            }
            // informa o tipo do arquivo ao navegador
            header("Content-Type: " . $tipo);
            // informa o tamanho do arquivo ao navegador
            header("Content-Length: " . filesize($backup));
            // informa ao navegador que é tipo anexo e faz abrir a janela de download, 
            // tambem informa o nome do arquivo
            header("Content-Disposition: attachment; filename=" . basename($backup));
            // lê o arquivo
            readfile($backup);
            // aborta pós-ações
            exit;
        }
    }

    public function restaurarBackup($Dados) {
        $conn = mysqli_connect(HOST, USER, PASS, DBNAME);
        $this->Dados = $Dados;
        ////receber os dados do formulário
        //var_dump($this->Dados['tmp_name']);
        //Ler os dados do arquivo e converter em string
        $dados = file_get_contents($this->Dados['tmp_name']);
        //var_dump($dados);
        //Executar as query do backup
        mysqli_multi_query($conn, $dados);
    }

}
