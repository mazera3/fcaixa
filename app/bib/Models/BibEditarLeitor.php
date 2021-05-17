<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarLeitor {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;
    private $VazioEmail;
    private $VazioMun;
    private $VazioBairro;
    private $VazioFone;
    private $VazioCelular;
    private $VazioEndereco;

    function getResultado() {
        return $this->Resultado;
    }

    public function verLeitor($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT lt.* FROM bib_leitor lt
                WHERE leitor_id =:leitor_id LIMIT :limit", "leitor_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verLeitor->getResultado();
        return $this->Resultado;
    }

    public function altLeitor(array $Dados) {
        $this->Dados = $Dados;
        
        $this->VazioEmail = $this->Dados['email'];
        unset($this->Dados['email']);
        
        $this->VazioMun = $this->Dados['id_mun'];
        unset($this->Dados['id_mun']);

        $this->VazioBairro = $this->Dados['bairro_id'];
        unset($this->Dados['bairro_id']);

        $this->VazioFone = $this->Dados['fone'];
        unset($this->Dados['fone']);

        $this->VazioCelular = $this->Dados['celular'];
        unset($this->Dados['celular']);

        $this->VazioEndereco = $this->Dados['endereco'];
        unset($this->Dados['endereco']);
        
        $this->Foto = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->valFoto();
        } else {
            $this->Resultado = false;
        }
    }
    
    private function valFoto()
    {
        if (empty($this->Foto['name'])) {
            $this->updateEditLeitor();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['foto_leitor'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/leitor/' . $this->Dados['leitor_id'] . '/', $this->Dados['foto_leitor'], 180, 270);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/leitor/' . $this->Dados['leitor_id'] . '/' . $this->ImgAntiga);
                $this->updateEditLeitor();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditLeitor() {
        $this->Dados['email'] = $this->VazioEmail;
        $this->Dados['id_mun'] = $this->VazioMun;
        $this->Dados['bairro_id'] = $this->VazioBairro;
        $this->Dados['fone'] = $this->VazioFone;
        $this->Dados['celular'] = $this->VazioCelular;
        $this->Dados['endereco'] = $this->VazioEndereco;
        $this->Dados['primeiro_nome'] = ucwords($this->Dados['primeiro_nome']);
        $this->Dados['ultimo_nome'] = ucwords($this->Dados['ultimo_nome']);
        
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltLeitor = new \App\adms\Models\helper\AdmsUpdate();
        $upAltLeitor->exeUpdate("bib_leitor", $this->Dados, "WHERE leitor_id =:leitor_id", "leitor_id=" . $this->Dados['leitor_id']);
        if ($upAltLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Leitor atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O leitor não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }
    
    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT mun_id, municipio FROM bib_municipio ORDER BY municipio ASC");
        $registro['munic'] = $listar->getResultado();

        $listar->fullRead("SELECT br_id, bairro FROM bib_bairro ORDER BY bairro ASC");
        $registro['bairro'] = $listar->getResultado();

        $listar->fullRead("SELECT clas_id, classificacao FROM bib_classificacao ORDER BY clas_id ASC");
        $registro['classe'] = $listar->getResultado();

        $listar->fullRead("SELECT id, nome FROM bib_sits_leitores ORDER BY id ASC");
        $registro['stl'] = $listar->getResultado();

        $this->Resultado = ['munic' => $registro['munic'], 'bairro' => $registro['bairro'], 'classe' => $registro['classe'], 'stl' => $registro['stl']];

        return $this->Resultado;
    }
}
