<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

use Dompdf\Dompdf;
use Dompdf\Options;
//use chillerlan\QRCode\Output\QRImage;
use chillerlan\QRCode\{
    QRCode,
    QROptions
};
use function base64_encode;

use Picqer\Barcode\BarcodeGeneratorPNG;
/**
 * Description of BibQrCodeLeitor
 *
 * @author mazera
 */
class BibQrCodeLeitor {

    private $LeitorId;
    private $InstituicaoId;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function geraQrCode($LeitorId = null, $InstituicaoId = null) {
        $this->LeitorId = $LeitorId;
        $this->InstituicaoId = $InstituicaoId;
        $options = new QROptions([
            'version' => 7,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'scale' => 3,
            'imageBase64' => true, //false,
        ]);
        $qr = new QRCode($options);
        $opcoes = new Options();
        $opcoes->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($opcoes);
        //$html = '';
        $html = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
        $this->verLeitor($this->LeitorId);
        $this->verInstituicao($this->InstituicaoId);
        if (!empty($this->Dados['instituicao'][0])) {
            extract($this->Dados['instituicao'][0]);
        }
        // formatacao da carteira
        $generator = new BarcodeGeneratorPNG();
        if (!empty($this->Dados['leitor'][0])) {

            extract($this->Dados['leitor'][0]);
            $qrcode = $qr->render($cod_barras_leitor);
            $html .= '<table class="border" width="100%" style="font-size: 13px;">';
            $html .= '<tbody>';
            $html .= '<tr>';
            $html .= '<th class="border text-center"><img src="' . URLADM . "app/bib/assets/imagens/instituicao/" . $id_instituicao . "/" . $logo_instituicao . '" width="10%"></th>';
            $html .= '<th colspan = "4"><h5>Estado de Santa Catarina<span class="small">' . $nome_instituicao . '</span></h5><span><b>Carteira da Biblioteca ' . date('Y') . '</b></span></th>';
            $html .= '<th rowspan = "5"></th>';
            $html .= '<td class="border text-center" width="48%" rowspan = "5"><span">'. $primeiro_nome . ' ' . $ultimo_nome .'</span><br/><span">'. $cod_barras_leitor .'</span><br/><img src="' . $qrcode . '" /></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td colspan = "3"><b>Nome: </b>' . $primeiro_nome . ' ' . $ultimo_nome . '</td>';
            if (!empty($foto_leitor)) {
                $html .= '<td colspan="2" rowspan="2" class="text-center"><img src="' . URLADM . "app/bib/assets/imagens/leitor/" . $leitor_id . "/" . $foto_leitor . '" width="10%"></td>';
            } else {
                $html .= '<td colspan="2" rowspan="2" class="text-center"><img src="' . URLADM . "app/bib/assets/imagens/leitor/icone_leitor.png" . '" width="10%"></td>';
            }
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td><b>Matrícula: </b><br/>' . $cod_barras_leitor . '</td>';
            $html .= '<td></td>';
            $html .= '<td><b>E-Mail: </b>' . $email . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td colspan = "5"><b>Endereço: </b>' . $endereco . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            // Gera código de barras Code 39
            $html .= '<td colspan = "5"%"><img src="data:image/png;base64,' . base64_encode($generator->getBarcode($cod_barras_leitor , $generator::TYPE_CODE_39)). '" /></td>';
            $html .= '</tr>';
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '<br/>';
        }

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream(
                $primeiro_nome . '_' . $ultimo_nome . "_carteira.pdf",
                array(
                    "Attachment" => true //false //Para realizar o download somente alterar para true
                )
        );
    }

    private function verLeitor($LeitorId = null) {
        $this->LeitorId = $LeitorId;
        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT lt.* FROM bib_leitor lt
        WHERE lt.leitor_id =:leitor_id LIMIT :limit", "leitor_id=" . $this->LeitorId . "&limit=1");
        $this->Resultado = $listar->getResultado();
        return $this->Dados['leitor'] = $this->Resultado;
    }

    private function verInstituicao($InstituicaoId = null) {
        $this->InstituicaoId = $InstituicaoId;
        $listarInstituicao = new \App\adms\Models\helper\AdmsRead();
        $listarInstituicao->fullRead("SELECT inst.* FROM bib_instituicao inst
                ORDER BY id_instituicao ASC LIMIT :limit", "limit=1");
        $this->Resultado = $listarInstituicao->getResultado();
        return $this->Dados['instituicao'] = $this->Resultado;
    }

}
