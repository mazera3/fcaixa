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
                        <h2 class="card-title"><i class="fas fa-book fa-1x"></i> Fluxo de Caixa</h2>
                        <h5>Fluxo de Caixa</h5>
                        <p>Organizador: Profº Édio Mazera - mazera3@gmail.com </p>
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
            </div>
        </div>
    </div>