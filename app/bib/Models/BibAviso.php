<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Description of BibAviso
 *
 * @author mazera
 */
class BibAviso {

    private $DadosAviso;
    private $Resultado;
    private $BibId;

    function getResultado() {
        return $this->Resultado;
    }

    public function geraAviso($DadosAviso = null) {
        $this->DadosAviso = $DadosAviso;

        $verConfg = new \App\adms\Models\helper\AdmsRead();
        $verConfg->fullRead("SELECT cf.* FROM bib_confs_site cf LIMIT :limit", "&limit=1");
        $this->Resultado = $verConfg->getResultado();
        //return $this->Resultado;
        foreach ($this->Resultado as $cf) {
            extract($cf);
        }

// imprime na tela
        $opcoes = new Options();
        $opcoes->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($opcoes);

        $html = '';
        $html .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
        $html .= '<style>';
        $html .= '.wrapper-page {page-break-after: always;} .wrapper-page:last-child {page-break-after: avoid;}';
        $html .= '</style>';
        if (isset($this->DadosAviso['aviso'])) {
            foreach ($this->DadosAviso['aviso'] as $cop_id => $val) {
                //$this->BibId = $id_site = 1;
                $verBiblioteca = new \App\adms\Models\helper\AdmsRead();
                $verBiblioteca->fullRead("SELECT bi.* FROM bib_biblioteca bi
        WHERE bi.id_biblioteca =:id_biblioteca LIMIT :limit", "id_biblioteca=" . $id_site . "&limit=1");
                $this->Resultado = $verBiblioteca->getResultado();
                foreach ($this->Resultado as $b) {
                    extract($b);
// formatacao da carta
                    $html .= '<div class="wrapper-page">';
                    $html .= '<div class="container">';
                    $html .= '<div class="row">';
                    $html .= '<div class="col-sm-4">';
                    if (!empty($logo_biblioteca)) {
                        $html .= '<img src="' . URLADM . "app/bib/assets/imagens/biblioteca/" . $id_biblioteca . "/" . $logo_biblioteca . '" width="30%">';
                    } else {
                        $html .= '<img src="' . URLADM . '"app/bib/assets/imagens/biblioteca/preview_img.png" width="30%">';
                    }
                    //$html .= '<img src="' . URLADM . "app/bib/assets/imagens/biblioteca/" . $id_biblioteca . "/" . $logo_biblioteca . '" width="30%">';
                    $html .= '<br/><br/><br/>';
// logo e dados da biblioteca
                    $html .= '</div><div class="col-sm-8"><br/><br/><br/>';
                    $html .= date('d-m-Y') . '<br/>';
                    $html .= '<h4>' . $nome_bib . '</h4>';
                    $html .= '' . $nome_inst . '<br/>';
                    $html .= '' . $endereco_bib . '<br/>';
                    $html .= '<b>Fone: </b>' . $fone_bib . ' - <b>E-Mail: </b>' . $email_bib . ' - <b>WhatsApp: </b>' . $whatsapp . '<br/>';
                    $html .= '' . $horario_bib . '<br/>';
                    $html .= '</div></div>';
                }

                $contarAtrasos = new \App\adms\Models\helper\AdmsRead();
                $contarAtrasos->fullRead("SELECT cp.*, bib.*, aut.*, lt.*, lt.endereco end_leitor, DATEDIFF(data_dev, CURDATE()) AS dias FROM bib_copia cp
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_leitor lt ON lt.leitor_id=cp.id_leitor
                WHERE DATEDIFF(data_dev, CURDATE()) < 0 
                AND cp.cop_id =:cop_id LIMIT :limit", "cop_id=" . $cop_id . "&limit=1");
                $this->Resultado = $contarAtrasos->getResultado();
                foreach ($this->Resultado as $cp) {
                    extract($cp);
// dados do leitor
                    $html .= '<div class="row"><div class="col-sm-6">';
                    $html .= '' . strtoupper($primeiro_nome . ' ' . $ultimo_nome) . '<br/>' . $end_leitor . '<br/>';
                    $html .= 'Sr(a) ' . $primeiro_nome . ' ' . $ultimo_nome . ':';
                    $html .= '</div></div><br/><br/>';
                    $html .= '<p>Nossos registros mostram que os seguintes itens da biblioteca foram verificados em seu nome e estão
        vencidos. Por favor devolvê-los o mais rapidamente possível e pagar as multas por atraso</p>';
                    $html .= '<br/><p>Sinceramente,</p>';
                    $html .= '<p>A equipe da ' . $nome_bib . '</p><br/>';
                    $html .= '<div class="row">';
                    $html .= '<div class="table-responsive">';
                    $html .= '<table class="table table-striped table-hover table-bordered table-sm">';
                    $html .= '<thead><tr>';
                    $html .= '<th class="d-none d-sm-table-cell">Titulo</th>';
                    $html .= '<th class="d-none d-sm-table-cell">Autor</th>';
                    $html .= '<th class="d-none d-sm-table-cell">Vencimento</th>';
                    $html .= '<th class="d-none d-sm-table-cell">Atraso</th>';
                    $html .= '</tr></thead><tbody><tr>';
                    $html .= '<td>' . $titulo . '</td>';
                    $html .= '<td>' . $autor . '</td>';
                    $html .= '<td>' . date('d/M/Y', strtotime($data_dev)) . '</td>';
                    $html .= '<td class="text-danger text-center">' . abs($dias) . ' dias</td>';
                    $html .= '</tr></tbody></table></div></div></div>';
                    $html .= '</div>';
                }

                $dompdf->load_html($html);
            }
        } else {
            $html .= '<h1>NENHUM LEITOR SELECIONADO!</h1>';
            $dompdf->load_html($html);
        }
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream(
                "aviso-" . date('d-m-Y-H-i-s') . ".pdf",
                array(
                    "Attachment" => true //false //Para realizar o download somente alterar para true
                )
        );
    }

}
