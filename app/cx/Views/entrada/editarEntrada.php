<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['select']);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Editar Entrada</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_ent']) {
            ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-entrada/ver-entrada/' . $valorForm['id_ent']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                </div>
            <?php
            }
            ?>

        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <input name="id_ent" type="hidden" value="<?php
                                                        if (isset($valorForm['id_ent'])) {
                                                            echo $valorForm['id_ent'];
                                                        }
                                                        ?>">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Descrição</label>
                        <select name="descricao_id" class="form-control">
                            <option value="1">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['des'] as $des) {
                                extract($des);
                                if ($valorForm['descricao_id'] == $id_des) {
                                    echo "<option value='$id_des' selected>$descricao</option>";
                                } else {
                                    echo "<option value='$id_des'>$descricao</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Valor -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Valor (R$)</label>
                        <input name="valor" type="number" min="0" step=".01" class="form-control" value="<?php if (isset($valorForm['valor'])) {
                                                                                                                echo $valorForm['valor'];
                                                                                                            } ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label><span class="text-danger">*</span> Mês</label>
                        <select name="mes" id="mes" class="form-control">
                            <option>Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['mes'] as $m) {
                                extract($m);
                                if ($valorForm['mes'] == $mes) {
                                    echo "<option value='$mes' selected>$id_mes - $mes</option>";
                                } else {
                                    echo "<option value='$mes'>$id_mes - $mes</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditEnt" type="submit" class="btn btn-warning" value="Atualizar">
        </form>
    </div>
</div>