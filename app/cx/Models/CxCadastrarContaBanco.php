<?php

        namespace App\cx\Models;
        
        if (!defined('URL')) {
            header("Location: /");
            exit();
        }
        
        /**
         * Description of CxCadastrarContaBanco
         *
         * @copyright (c) year, Édio Mazera
         */
        class CxCadastrarContaBanco
        {
        
            private $Resultado;
            private $Dados;
            private $VazioVencimento;
            private $VazioCodigo;
            private $VazioObs;
        
            function getResultado()
            {
                return $this->Resultado;
            }
        
            public function cadConta(array $Dados)
            {
                $this->Dados = $Dados;
        
                
                $this->VazioCodigo = $this->Dados['codigo'];
                unset($this->Dados['codigo']);
                $this->VazioVencimento = $this->Dados['vencimento'];
                unset($this->Dados['vencimento']);
                $this->VazioObs = $this->Dados['observacao'];
                unset($this->Dados['observacao']);
        
                $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
                $valCampoVazio->validarDados($this->Dados);
        
                if ($valCampoVazio->getResultado()) {
                    $this->inserirConta();
                } else {
                    $this->Resultado = false;
                }
            }
        
            private function inserirConta()
            {
                $this->Dados['created'] = date("Y-m-d H:i:s");
                $this->Dados['ano'] = date("Y");
                $this->Dados['codigo'] = $this->VazioCodigo;
                $this->Dados['vencimento'] = $this->VazioVencimento;
                $this->Dados['observacao'] = $this->VazioObs;
        
                $cadConta = new \App\adms\Models\helper\AdmsCreate;
                $cadConta->exeCreate("cx_conta_banco", $this->Dados);
        
                if ($cadConta->getResultado()) {
                    $_SESSION['msg'] = "<div class='alert alert-success'>Conta cadastrada com sucesso!</div>";
                    $this->Resultado = true;
                } else {
                    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Conta não foi cadastrada!!</div>";
                    $this->Resultado = false;
                }
            }
        
            public function listarCadastrar()
            {
                $listar = new \App\adms\Models\helper\AdmsRead();
        
                $listar->fullRead("SELECT id_mes, mes FROM cx_mes ORDER BY id_mes ASC");
                $registro['mes'] = $listar->getResultado();
        
                $this->Resultado = [
                    'mes' => $registro['mes']
                ];
        
                return $this->Resultado;
            }
        }
        