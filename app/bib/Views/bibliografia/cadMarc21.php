<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['form']);
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Cadastrar Marc21</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_bibliografia']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'bibliografias/listar'; ?>" class="btn btn-outline-info btn-sm">Listar Bibliografias</a>
                </div>
                <?php
            }
            ?>
        </div><hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <div class="row">
            <div class="col-sm-10">

                <form id="add-aula" method="POST" action="">
                    <div id="formulario">
                        <div class="form-group">
                            <fieldset class="border border-secondary">
                                <legend>Campos</legend>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Campo:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="campo" class="custom-select">
                                            <option value="" selected></option>
                                            <option value="245">245</option>
                                            <option value="100">100</option>
                                            <option value="020">020</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                        <label>Descição:</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="descricao" class="custom-select">
                                            <option value="" selected></option>
                                            <option value="TÍTULO PRINCIPAL (NR)">245 - TÍTULO PRINCIPAL (NR)</option>
                                            <option value="ENTRADA PRINCIPAL - NOME PESSOAL (NR)">100 - ENTRADA PRINCIPAL - NOME PESSOAL (NR)</option>
                                            <option value="ISBN - INTERNATIONAL STANDARD BOOK NUMBER (R)">020 - ISBN - INTERNATIONAL STANDARD BOOK NUMBER (R)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Indicadores:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="ind1" class="custom-select">
                                            <option value="" selected></option>
                                            <option value="#">#</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="ind2" class="custom-select">
                                            <option value="" selected></option>
                                            <option value="#">#</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Subcampos:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea name="subcampos" class="form-control" id="" rows="2"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <button type="button" id="add-campo" class="text-primary"> Adicionar Campo </button>
                    <div class="form-group">
                        <input name="CadMarc" id="CadMarc" type="submit" class="btn btn-dark" value="Cadastrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>