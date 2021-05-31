<?php

namespace App\bib\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibPdf
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPdf {

    private $Resultado;
    private $DadosDb;

    function getResultado() {
        return $this->Resultado;
    }

    public function imprimir($DadosDb = null) {
        $this->DadosDb = $DadosDb;

        //Criando a Instancia
        $dompdf = new Dompdf();
        if ($this->DadosDb['tabela'] == '') {
        $html = 'Selecione uma tabela';
        }
        //dados
        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT * FROM {$this->DadosDb['tabela']}");
        $this->Resultado = $listar->getResultado();
        // Tabela bib_leitor
        if ($this->DadosDb['tabela'] == 'bib_leitor') {

            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Código</th>';
            $html .= '<th>Criado</th>';
            $html .= '<th>Nome Completo</th>';
            $html .= '<th>Endereço</th>';
            $html .= '<th>Fone / Celular</th>';
            $html .= '<th>E-mail</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $leitor_id . '</td>';
                $html .= '<td>' . $cod_barras_leitor . '</td>';
                $html .= '<td>' . $created . '</td>';
                $html .= '<td>' . $primeiro_nome . ' ' . $ultimo_nome . '</td>';
                $html .= '<td>' . $endereco . '</td>';
                $html .= '<td>' . $fone . ' - ' . $celular . '</td>';
                $html .= '<td>' . $email . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        // Tabela bib_biblio
        if ($this->DadosDb['tabela'] == 'bib_biblio') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Chamada</th>';
            $html .= '<th>ISBN</th>';
            $html .= '<th>Titulo</th>';
            $html .= '<th>Ano</th>';
            $html .= '<th>Tópicos</th>';
            $html .= '<th>Flag</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $bib_id . '</td>';
                $html .= '<td>' . $chamada . '</td>';
                $html .= '<td>' . $isbn . '</td>';
                $html .= '<td>' . $titulo . ' - ' . $sub_titulo . '</td>';
                $html .= '<td>' . $ano . '</td>';
                $html .= '<td>' . $topicos . '</td>';
                $html .= '<td>' . $opac_flag . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        
        // Tabela bib_editora
        if ($this->DadosDb['tabela'] == 'bib_editora') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Editora</th>';
            $html .= '<th>Endereço</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $ed_id . '</td>';
                $html .= '<td>' . $editora . '</td>';
                $html .= '<td>' . $endereco . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        
        // Tabela bib_autores
        if ($this->DadosDb['tabela'] == 'bib_autores') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Autor</th>';
            $html .= '<th>E-Mail</th>';
            $html .= '<th>Endereço</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $aut_id . '</td>';
                $html .= '<td>' . $autor . '</td>';
                $html .= '<td>' . $email . '</td>';
                $html .= '<td>' . $endereco . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        
        // Tabela bib_colecao
        if ($this->DadosDb['tabela'] == 'bib_colecao') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Descrição</th>';
            $html .= '<th>Flag</th>';
            $html .= '<th>Dias de Retorno</th>';
            $html .= '<th>Taxa Diária</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $col_id . '</td>';
                $html .= '<td>' . $descricao . '</td>';
                $html .= '<td>' . $flag . '</td>';
                $html .= '<td>' . $dias_retorno . '</td>';
                $html .= '<td>' . $taxa_diaria_atraso . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        
        // Tabela bib_classificacao
        if ($this->DadosDb['tabela'] == 'bib_classificacao') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Classificação</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $clas_id . '</td>';
                $html .= '<td>' . $classificacao . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        // Tabela bib_copia
        if ($this->DadosDb['tabela'] == 'bib_copia') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Id Bib</th>';
            $html .= '<th>Data Emp</th>';
            $html .= '<th>Descrição</th>';
            $html .= '<th>Código</th>';
            $html .= '<th>Cont Renov</th>';
            $html .= '<th>Sit Copia</th>';
            $html .= '<th>Id Leitor</th>';
            $html .= '<th>Data Dev</th>';
            $html .= '<th>Data Res</th>';
            $html .= '<th>Data Lib</th>';
            $html .= '<th>Sit Res</th>';
            $html .= '<th>ID Res</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $cop_id . '</td>';
                $html .= '<td>' . $cop_bib_id . '</td>';
                $html .= '<td>' . $data_emp . '</td>';
                $html .= '<td>' . $descricao . '</td>';
                $html .= '<td>' . $cod_bar . '</td>';
                $html .= '<td>' . $cont_renov . '</td>';
                $html .= '<td>' . $sit_copia . '</td>';
                $html .= '<td>' . $id_leitor . '</td>';
                $html .= '<td>' . $data_dev . '</td>';
                $html .= '<td>' . $data_res . '</td>';
                $html .= '<td>' . $data_lib . '</td>';
                $html .= '<td>' . $sit_res . '</td>';
                $html .= '<td>' . $id_res . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        
         // Tabela bib_historico
        if ($this->DadosDb['tabela'] == 'bib_historico') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Id Leitor</th>';
            $html .= '<th>Id Cópia</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $id_hist . '</td>';
                $html .= '<td>' . $id_lt . '</td>';
                $html .= '<td>' . $cp_id . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
          // Tabela bib_uf
        if ($this->DadosDb['tabela'] == 'bib_uf') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Nome</th>';
            $html .= '<th>UF</th>';
            $html .= '<th>Id Pais</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $uf_id . '</td>';
                $html .= '<td>' . $nome . '</td>';
                $html .= '<td>' . $uf . '</td>';
                $html .= '<td>' . $id_pais . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        
        // Tabela bib_pais
        if ($this->DadosDb['tabela'] == 'bib_pais') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Nome</th>';
            $html .= '<th>Sigla</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $pais_id . '</td>';
                $html .= '<td>' . $nome_pais . '</td>';
                $html .= '<td>' . $sigla . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        
        // Tabela bib_municipio
        if ($this->DadosDb['tabela'] == 'bib_municipio') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Municipio</th>';
            $html .= '<th>Id UF</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $mun_id . '</td>';
                $html .= '<td>' . $municipio . '</td>';
                $html .= '<td>' . $id_uf . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        // Tabela bib_bairro
        if ($this->DadosDb['tabela'] == 'bib_bairro') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Bairro</th>';
            $html .= '<th>Id Mun</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $br_id . '</td>';
                $html .= '<td>' . $bairro . '</td>';
                $html .= '<td>' . $id_mun . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        
        // Tabela bib_tipo_material
        if ($this->DadosDb['tabela'] == 'bib_tipo_material') {
            $html = '<table border="1" style="font-size: 10px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Id</th>';
            $html .= '<th>Descrição</th>';
            $html .= '<th>Flag</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($this->Resultado as $val) {
                extract($val);
                $html .= '<tr>';
                $html .= '<td>' . $cod_id . '</td>';
                $html .= '<td>' . $descricao . '</td>';
                $html .= '<td>' . $flag . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }
        
        // Carrega seu HTML
        $dompdf->load_html("
			<h1 style='text-align: center;'>" . $this->DadosDb['titulo'] . "</h1>
			" . $html . "
		");
        // // (Optional) Setup the paper size and orientation
        // portrait ou landscape
        $dompdf->setPaper('A4', $this->DadosDb['formato']);

        //Renderizar o html
        $dompdf->render();

        //Exibibir a página
        $dompdf->stream(
                $this->DadosDb['titulo'] . " - relatorio.pdf",
                array(
                    "Attachment" => true //false //Para realizar o download somente alterar para true
                )
        );
    }

}
