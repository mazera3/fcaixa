<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

use Dompdf\Dompdf;
use Dompdf\Options;
use function base64_encode;
use Picqer\Barcode\BarcodeGeneratorPNG;

/**
 * Description of CxQrCodeOn
 *
 * @author mazera
 */
class CxCodeBarras {

    private $DadosCodBar;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function geraCodeBarras($DadosCodBar = null) {
        $this->DadosCodBar = $DadosCodBar;
        // imprime na tela
        $opcoes = new Options();
        $opcoes->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($opcoes);
        $html = '';
        $html .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
        // bib_copia selecionado
        foreach ($this->DadosCodBar['codebar'] as $cop_id => $val) {
            //echo $cop_id . '<br/>';
            $listar = new \App\adms\Models\helper\AdmsRead();
            $listar->fullRead("SELECT * FROM bib_copia cp
          INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
          WHERE cp.cop_id =:cop_id LIMIT :limit", "cop_id=" . $cop_id . "&limit=1");
            $this->Resultado = $listar->getResultado();

            $generator = new BarcodeGeneratorPNG();
            foreach ($this->Resultado as $val) {
                extract($val);
                // formatacao da etiqueta
                $html .= '<table border="0" width="100%" style="font-size: 13px;">';
                $html .= '<tbody>';
                $html .= '<tr>';
                $html .= '<td class="text-center" width="30%"><p>CODE_128<p/>'
                        . '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($cod_bar, $generator::TYPE_CODE_128)) . '" />'
                        . '<br/>' . $titulo . ' (' . $cod_bar . ')</td>';
                $html .= '<br/>';
                $html .= '<br/>';
                $html .= '<td class="text-center" width="30%"><p>CODE_39<p/>'
                        . '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($cod_bar, $generator::TYPE_CODE_39)) . '" />'
                        . '<br/>' . $titulo . ' (' . $cod_bar . ')</td>';
                $html .= '</tr>';
                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '<br/>';
            }
        }
        $dompdf->load_html("
          <h4 style='text-align: center;'>Cópias</h4>
          " . $html . "
          ");
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream(
                "Cópias_codebar.pdf",
                array(
                    "Attachment" => true //false //Para realizar o download somente alterar para true
                )
        );
    }

}
