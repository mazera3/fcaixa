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
    QROptions,
    QRImage,
    QRImageWithText
};
use function base64_encode,
             imagechar,
             imagecolorallocate,
             imagecolortransparent,
             imagecopymerge,
             imagecreatetruecolor,
             imagedestroy,
             imagefilledrectangle,
             imagefontwidth,
             in_array,
             round,
             str_split,
             strlen;

/**
 * Description of BibQrCode
 *
 * @author mazera
 */
class BibQrCode {

    private $DadosQR;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function geraQrCode($DadosQR = null) {
        $this->DadosQR = $DadosQR;
        // salva do servidor
        if ($this->DadosQR['tipo'] == 'download') {
            $options = new QROptions([
                'version' => 10,
                'outputType' => QRCode::OUTPUT_IMAGE_PNG, //QRCode::OUTPUT_MARKUP_SVG,
                'scale' => 5,
                'imageBase64' => false,
            ]);
            $qrcode = new QRCode($options);
            $qrcode->render($this->DadosQR['slug'],
                    $_SERVER['DOCUMENT_ROOT'] . '/biblivre/app/bib/assets/imagens/qrcode/' . $this->DadosQR['slug'] . '.png');
        }
        // imprime na tela
        if ($this->DadosQR['tipo'] == 'imprimir') {
            $options = new QROptions([
                'version' => 7,
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'scale' => 3,
                'imageBase64' => true, //false,
            ]);
            $qr = new QRCode($options);
            //$dompdf = new Dompdf();
            $opcoes = new Options();
            $opcoes->set('isRemoteEnabled', TRUE);
            $dompdf = new Dompdf($opcoes);
            $html = '';
            $html .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
            // bib_uf
            if ($this->DadosQR['tabela'] == 'bib_uf') {
                $listar = new \App\adms\Models\helper\AdmsRead();
                $listar->fullRead("SELECT * FROM {$this->DadosQR['tabela']}");
                $this->Resultado = $listar->getResultado();

                foreach ($this->Resultado as $val) {
                    extract($val);
                    $this->Resultado = $qr->render($uf_id);
                    // formatacao da carteira
                    $html .= '<table border="1" width="100%" style="font-size: 13px;">';
                    $html .= '<tbody>';
                    $html .= '<tr>';
                    $html .= '<td width="30%"><img src="' . $this->Resultado . '" /></td>';
                    $html .= '<td><b>Nome: <b>' . $nome . ' (' . $uf . ')<br/>'
                            . '<b>País: <b>' . $id_pais . '</td>';
                    $html .= '</tr>';
                    $html .= '</tbody>';
                    $html .= '</table>';
                    $html .= '<br/>';
                }
            }
            //bib_biblio
            if ($this->DadosQR['tabela'] == 'bib_biblio') {
                $listar = new \App\adms\Models\helper\AdmsRead();
                $listar->fullRead("SELECT * FROM {$this->DadosQR['tabela']}");
                $this->Resultado = $listar->getResultado();

                foreach ($this->Resultado as $val) {
                    extract($val);
                    $this->Resultado = $qr->render($chamada);
                    $html .= '<p>Teste</p>';
                    $html .= '<img src="' . $this->Resultado . '" /><br/>';
                    //return $this->Resultado;
                }
            }
            // bib_copia
            if ($this->DadosQR['tabela'] == 'bib_copia') {
                $listar = new \App\adms\Models\helper\AdmsRead();
                $listar->fullRead("SELECT * FROM {$this->DadosQR['tabela']}");
                $this->Resultado = $listar->getResultado();

                foreach ($this->Resultado as $val) {
                    extract($val);
                    $this->Resultado = $qr->render($cod_bar);
                    $html .= '<img src="' . $this->Resultado . '" /><br/>';
                    //return $this->Resultado;
                }
            }
            //
            // bib_leitor
            if ($this->DadosQR['tabela'] == 'bib_leitor') {
                $listar = new \App\adms\Models\helper\AdmsRead();
                $listar->fullRead("SELECT * FROM {$this->DadosQR['tabela']}");
                $this->Resultado = $listar->getResultado();

                foreach ($this->Resultado as $val) {
                    extract($val);
                    $this->Resultado = $qr->render($cod_barras_leitor);
                    // formatacao da carteira
                    $html .= '<table>';
                    $html .= '<thead>';
                    $html .= '<tr border="1">';
                    $html .= '<th><img src="' . $this->Resultado . '" /></th>';
                    $html .= '<th><b>Nome: <b>' . $primeiro_nome . ' ' . $ultimo_nome . '<br/>'
                            . '<b>Matrícula: <b>' . $cod_barras_leitor . '</th>';
                    $html .= '</tr>';
                    $html .= '</thead>';
                    $html .= '</table >';
                }
            }
            //
            $dompdf->load_html("
			<h1 style='text-align: center;'>" . $this->DadosQR['slug'] . "</h1>
			" . $html . "
		");
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream(
                    $this->DadosQR['slug'] . " - qrcode.pdf",
                    array(
                        "Attachment" => true //false //Para realizar o download somente alterar para true
                    )
            );
        }

        // imprime na tela como texto
        if ($this->DadosQR['tipo'] == 'texto') {
            $options = new QROptions([
                'version' => 5,
                'outputType' => QRCode::OUTPUT_STRING_TEXT,
                'eccLevel' => QRCode::ECC_L,
            ]);
            $qr = new \chillerlan\QRCode\QRCode($options); //$options
            $this->Resultado = $qr->render($this->DadosQR['slug']);
            return $this->Resultado;
        }

        // imprime na tela como texto + imagem
        if ($this->DadosQR['tipo'] == 'matrix') {
            $options = new QROptions([
                'version' => 7,
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'scale' => 3,
                'imageBase64' => false,
            ]);
            //header('Content-type: image/png');
            $qr = new QRImageWithText($options, (new QRCode($options))->getMatrix($this->DadosQR['slug']));
            $qr->dump(null, 'texto aqui');
            //$this->Resultado = $qr->dump(null, 'texto aqui'); //$this->DadosQR['slug']
            //return $this->Resultado;
            echo '<img src="' . $qr . '" />';
        }
    }

}
