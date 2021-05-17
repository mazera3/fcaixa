<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="content p-1">
    <div class="col-lg-12 col-sm-6">
        <div class="card text-light text-center" style="background-color: #000000">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <h2 class="card-title"><i class="fas fa-book fa-1x"></i> Biblioteca Francisco Mazzola</h2>
                        <h5>Escola de Educação Básica Francisco Mazzola</h5>
                        <p>Organizador: Profº Édio Mazera - mazera3@gmail.com </p>
                        <div class="text-info"
                             <p>Horario de Funcionamento: De segunda a sexta das 8:00 as 22:00</br>
                            Contatos: (48) 3267-2166  -  Email: biblivre@nead.pro.br</p>
                        </div>
                    </div>
                    <?php if (empty($_SESSION['usuario_id'])) { ?>
                        <div class="col-sm-3">
                            <form class="form-signin" method="POST" action="<?php echo URLADM . 'login/acesso' ?>">
                                <?php
                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                                if (isset($this->Dados['form'])) {
                                    $valorForm = $this->Dados['form'];
                                }
                                ?>
                                <div class="form-group">
                                    <input name="usuario" type="text" class="form-control" placeholder="Digite o usuário" value="<?php
                                    if (isset($valorForm['usuario'])) {
                                        echo $valorForm['usuario'];
                                    }
                                    ?>"> 
                                </div>
                                <div class="form-group">
                                    <input name="senha" type="password" class="form-control" placeholder="Digite a senha">
                                </div>
                                <input name="SendLogin" type="submit" class="btn btn-sm btn-primary btn-block" value="Acessar">
                                <a href="<?php echo URLADM . 'esqueceu-senha/esqueceu-senha' ?>">Esqueceu a senha?</a></p>
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <?php echo "<a href='" . URLADM . "opac/listar' class='btn btn-success btn-sm btn-block'>Catálogo Público - OPAC</a> "; ?>
            </div>
        </div>
        <!-- Inicio das estatisticas -->
        <?php
        foreach ($this->Dados['contarLeitor'] as $leitor) {
            extract($leitor);
        }
        foreach ($this->Dados['contarBiblio'] as $biblio) {
            extract($biblio);
        }
        foreach ($this->Dados['contarEmprestimo'] as $emprestimo) {
            extract($emprestimo);
        }
        foreach ($this->Dados['contarCopias'] as $copias) {
            extract($copias);
        }
        foreach ($this->Dados['contarAtrasos'] as $atrasos) {
            extract($atrasos);
        }
        ?>
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Estatísticas</h2>
                </div>
            </div>
            <dl class="row">
                <dt class="col-sm-2"><i class="fas fa-users fa-1x"></i> Leitores:</dt>
                <dd class="col-sm-10"><?php echo $num_leitores; ?></dd>

                <dt class="col-sm-2"><i class="fas fa-file fa-1x"></i> Bibliografias:</dt>
                <dd class="col-sm-10"><?php echo $num_bibliografias; ?></dd>

                <dt class="col-sm-2"><i class="fas fa-balance-scale fa-1x"></i> Copias:<dt/>
                <dd class="col-sm-10"><?php echo $num_copias; ?></dd>

                <dt class="col-sm-2"><i class="fas fa-balance-scale fa-1x"></i> Emprestimos:<dt/>
                <dd class="col-sm-10"><?php echo $num_emprestimos; ?></dd>

                <dt class="col-sm-2"><i class="fas fa-money-bill-alt fa-1x"></i> Atrasos:<dt/>
                <dd class="col-sm-10"><?php echo $num_atrasos; ?></dd>

                <dt class="col-sm-2"><dt/>
                <dd class="col-sm-10"></dd>
            </dl>
        </div>
    </div>
</div>