<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
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
<div class="content p-1">
    <!-- Inicio das estatisticas -->
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo"><i class="fas fa-chart-line fa-1x"></i> Estatísticas</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['imprimir']) {
                    echo "<a href='" . URLADM . "imprimir/imprimir/1' class='btn btn-outline-dark btn-sm'>Imprimir</a> ";
                }
                ?>                
            </div>
        </div>
        <?php
        if (empty($this->Dados['contarBiblio']) AND empty($this->Dados['contarLeitor'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma estatistica de biliografia ou leitor encontrada!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <dl class="row">

            <dt class="col-sm-2"><i class="fas fa-users fa-1x"></i> Leitores:</dt>
            <dd class="col-sm-10"><?php echo $num_leitores; ?></dd>

            <dt class="col-sm-2"><i class="fas fa-file fa-1x"></i> Bibliografias:</dt>
            <dd class="col-sm-10"><?php echo $num_bibliografias; ?></dd>

            <dt class="col-sm-2"><i class="fas fa-copy fa-1x"></i> Copias:<dt/>
            <dd class="col-sm-10"><?php echo $num_copias; ?></dd>

            <dt class="col-sm-2"><i class="fas fa-money-bill-alt fa-1x"></i> Emprestimos:<dt/>
            <dd class="col-sm-10"><?php echo $num_emprestimos; ?></dd>

            <dt class="col-sm-2"><i class="fas fa-clock fa-1x"></i> Atrasos:<dt/>
            <dd class="col-sm-10"><?php echo $num_atrasos; ?></dd>

            <dt class="col-sm-2"><dt/>
            <dd class="col-sm-10"></dd>
        </dl>
    </div>
</div>