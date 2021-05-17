<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarLeitor {

    private $Resultado;
    private $Dados;
    //private $DadosId;
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

    /*
      public function verLeitor($DadosId) {
      $this->DadosId = (int) $DadosId;
      $verPerfil = new \App\adms\Models\helper\AdmsRead();
      $verPerfil->fullRead("SELECT * FROM bib_leitor WHERE leitor_id=:leitor_id LIMIT :limit", "leitor_id=" . $this->DadosId . "&limit=1");
      $this->Resultado = $verPerfil->getResultado();
      return $this->Resultado;
      }
     */

    public function cadLeitor(array $Dados) {
        $this->Dados = $Dados;

        $this->VazioEmail = $this->Dados['email'];
        unset($this->Dados['email']);
        //if (!empty($this->VazioEmail)) {
        //    $this->valEmail();
        //}

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
        unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);


        if ($valCampoVazio->getResultado()) {
            $this->valMatricula();
        } else {
            $this->Resultado = false;
        }
    }

    /*
      private function valEmail() {
      $valEmail = new \App\bib\Models\helper\BibEmail();
      $valEmail->valEmail($this->Dados['email']);

      $valEmailUnico = new \App\bib\Models\helper\BibEmailUnico();
      $valEmailUnico->valEmailUnico($this->Dados['email']);

      if (($valEmail->getResultado()) AND ($valEmailUnico->getResultado())) {
      $this->inserirLeitor();
      } else {
      $this->Resultado = false;
      }
      }
     */

    private function valMatricula() {
        $valMatricula = new \App\bib\Models\helper\BibValMatricula();
        $valMatricula->valMatricula($this->Dados['cod_barras_leitor']);

        if (( $valMatricula->getResultado())) {

            if (!empty($this->Foto['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirLeitor();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Foto);

        if ($valImagem->getResultado()) {
            $this->inserirLeitor();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirLeitor() {
        $this->Dados['email'] = $this->VazioEmail;
        $this->Dados['id_mun'] = $this->VazioMun;
        $this->Dados['bairro_id'] = $this->VazioBairro;
        $this->Dados['fone'] = $this->VazioFone;
        $this->Dados['celular'] = $this->VazioCelular;
        $this->Dados['endereco'] = $this->VazioEndereco;
        $this->Dados['primeiro_nome'] = ucwords($this->Dados['primeiro_nome']);
        $this->Dados['ultimo_nome'] = ucwords($this->Dados['ultimo_nome']);

        $this->Dados['created'] = date("Y-m-d H:i:s");
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['foto_leitor'] = $slugImg->nomeSlug($this->Foto['name']);

        $cadLeitor = new \App\adms\Models\helper\AdmsCreate;
        $cadLeitor->exeCreate("bib_leitor", $this->Dados);

        if ($cadLeitor->getResultado()) {
            if (empty($this->Foto['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Leitor cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['leitor_id'] = $cadLeitor->getResultado();
                $this->uploadFoto();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este leitor não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    private function uploadFoto() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/leitor/' . $this->Dados['leitor_id'] . '/', $this->Dados['foto_leitor'], 150, 150);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Leitor cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O leitor não foi cadastrado!!</div>";
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
