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
                <h2 class="display-4 titulo">Cadastrar Copia</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_copia']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'copias/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
        $cop_bib_id = filter_input(INPUT_GET, 'bib_id', FILTER_SANITIZE_STRING);
        ?>
        <form method="POST" action="" enctype="multipart/form-data" name="form">
            <input name="cop_bib_id" type="hidden" value="<?php echo $cop_bib_id; ?>">
            <div class="row">
                <div class="col-4">
                    <!-- descricao  -->
                    <label>Descrição</label>
                    <input name="descricao" type="text" class="form-control" placeholder="descricao" value="<?php
                    if (isset($valorForm['descricao'])) {
                        echo $valorForm['descricao'];
                    }
                    ?>">
                </div>
                <div class="col-4">
                    <!-- cod_bar  -->
                    <label>Código de barras</label>
                    <span class="btn btn-outline-secondary btn-sm" onclick="gerarEtiqueta()">
                        Gerar Código Aleatório
                    </span>
                    <input name="cod_bar" id="cod_bar" type="text" class="form-control" value="">
                </div>
                <div class="col-6">
                    <input name="CadCopia" type="submit" class="btn btn-warning" value="Salvar">
                </div>
            </div>
        </form>
    </div>
    <script language=javascript type="text/javascript">
        
        function makeid(length) {
            var result = '';
            var characters = '0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
        
        function gerarEtiqueta() {
            var codigo = makeid(6);
            document.getElementById("cod_bar").value = codigo;
        }
    </script>