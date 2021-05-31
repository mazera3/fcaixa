<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

use Dompdf\Dompdf;
use Dompdf\Options;
use function base64_encode;
use Picqer\Barcode\BarcodeGeneratorPNG;

/**
 * Description of BibQrCode
 *
 * @author mazera
 */
class BibCodeBar {

    private $DadosCD;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function geraCodeBar($DadosCD = null) {
        $this->DadosCD = $DadosCD;
        
        // imprime na tela
        $opcoes = new Options();
        $opcoes->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($opcoes);
        $html = '';
        $html .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
        // bib_copia
        if ($this->DadosCD['tabela'] == 'bib_copia') {
            $listar = new \App\adms\Models\helper\AdmsRead();
            $listar->fullRead("SELECT * FROM bib_copia cop
            INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id");
            $this->Resultado = $listar->getResultado();

            $generator = new BarcodeGeneratorPNG();
            foreach ($this->Resultado as $val) {
                extract($val);
                // formatacao da etiqueta
                $html .= '<table border="0" width="100%" style="font-size: 13px;">';
                $html .= '<tbody>';
                $html .= '<tr>';
                if ($this->DadosCD['tipo'] === 'TYPE_CODE_128') {
                    $html .= '<td class="text-center" width="30%">'
                            . '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($cod_bar, $generator::TYPE_CODE_128)) . '" />'
                            . '<br/>' . $titulo . ' (' . $cod_bar . ')</td>';
                }
                if ($this->DadosCD['tipo'] === 'TYPE_CODE_39') {
                    $html .= '<td class="text-center" width="30%">'
                            . '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($cod_bar, $generator::TYPE_CODE_39)) . '" />'
                            . '<br/>' . $titulo . ' (' . $cod_bar . ')</td>';
                }
                $html .= '</tr>';
                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '<br/>';
            }
        }
        //
        // bib_leitor
        if ($this->DadosCD['tabela'] == 'bib_leitor') {
            $listar = new \App\adms\Models\helper\AdmsRead();
            $listar->fullRead("SELECT * FROM bib_leitor");
            $this->Resultado = $listar->getResultado();

            $generator = new BarcodeGeneratorPNG();
            foreach ($this->Resultado as $val) {
                extract($val);
                // formatacao da etiqueta
                $html .= '<table border="0" width="100%" style="font-size: 13px;">';
                $html .= '<tbody>';
                $html .= '<tr>';
                if ($this->DadosCD['tipo'] === 'TYPE_CODE_128') {
                    $html .= '<td class="text-center" width="30%">'
                            . '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($cod_barras_leitor, $generator::TYPE_CODE_128)) . '" />'
                            . '<br/>' . $primeiro_nome . ' ' . $ultimo_nome . '< /td>';
                }
                if ($this->DadosCD['tipo'] === 'TYPE_CODE_39') {
                    $html .= '<td class="text-center" width="30%">'
                            . '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($cod_barras_leitor, $generator::TYPE_CODE_39)) . '" />'
                            . '<br/>' . $primeiro_nome . ' ' . $ultimo_nome . '< /td>';
                }
                $html .= '</tr>';
                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '<br/>';
                $html .= '</div>';
                $html .= '</div>';
            }
        }
        $dompdf->load_html("
			<h1 style='text-align: center;'>" . $this->DadosCD['slug'] . "</h1>
			" . $html . "
		");
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream(
                $this->DadosCD['slug'] . " - codebar.pdf",
                array(
                    "Attachment" => true //false //Para realizar o download somente alterar para true
                )
        );
    }

}
