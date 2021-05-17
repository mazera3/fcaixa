<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['form'][0]['cod_bar']);
//var_dump($this->Dados['RetCopia']);
?>

<div class="content p-1">
    <div class="list-group-item">
        <?php
        echo "Retirar Cópia";
        if (!empty($this->Dados['form'])) {
            echo " - {$this->Dados['form'][0]['cop_id']}";
        }
        ?>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        foreach ($this->Dados['form'] as $copia) {
            extract($copia);
        }
        ?>
        <div class="table-responsive">
            <div class="row">
                <div class="col-sm-6">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered table-sm">
                            <thead>
                                <tr class="bg-info">
                                    <th class="d-none d-sm-table-cell text-center">Retirar Cópia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <form method="POST" action="" class="form-inline">
                                            <input name="cop_id" type="hidden" value="<?php echo $this->Dados['form']['cop_id']; ?>">
                                            <div class="form-group">
                                                <label class="sr-only">Código de Barras</label>
                                            </div>
                                            <?php echo 'Código de barras: ' . $this->Dados['form'][0]['cod_bar']; ?>
                                            <button name="RetCopia" type="submit" class="btn-outline-danger ml-4">Retirar Cópia</button>
                                        </form>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <?php
                                       
                                        if ($this->Dados['botao']['ret_copia']) {
                                            if ($sit_copia == 1) {
                                                echo "<a href='" . URLADM . "retirar-copia/ret-copia/$cop_id?lt=$cod_bar'><span class='btn btn-success'>Retirar</span></a>";
                                            } else {
                                                echo "<a href='" . URLADM . "retirar-copia/ret-copia/$cop_id?lt=$cod_bar'><span class='btn btn-danger'>Devolver</span></a>";
                                            }
                                        } else {
                                            if ($sit_copia == 1) {
                                                echo "<span class='badge badge-success'>Retirar</span>";
                                            } else {
                                                echo "<span class='badge badge-danger'>Devolver</span>";
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>