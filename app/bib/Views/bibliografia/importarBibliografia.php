<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="container">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Importar Bibliografia</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_bibliografia']) {
                ?>
                <div class="ml-auto p-2">
                    <a href="<?php echo URLADM . 'bibliografias/listar'; ?>" class="btn btn-outline-info btn-sm">Listar Bibliografias</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <hr>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
// var_dump($this->Dados);
    ?>
    <div class="list-group-item">
        <h3>Importar XLM <small><button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal1">Exemplo </button></small></h3>
        <span tabindex="0" data-toggle="tooltip" data-placement="top" data-html="true" title="XLM: cada linha contem um conjunto de dados separados por celula. No excel salvar como XML">
            <i class="fas fa-question-circle"></i>
        </span>
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Arquivo XML</label>
            <input type="file" name="xml"><br><br>
            <input type="submit"  value="Enviar XML">
        </form>
    </div>
    <hr>
    <div class="list-group-item">
        <h3>Importar CSV <small><button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal2">Exemplo </button></small></h3>
        <span tabindex="0" data-toggle="tooltip" data-placement="top" data-html="true" title="CSV: cada linha contem um conjunto de dasdos separados por virgula. No excel salvar como CSV">
            <i class="fas fa-question-circle"></i>
        </span>
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Arquivo CSV</label>
            <input type="file" name="csv"><br><br>
            <input type="submit"  value="Enviar CSV">
        </form>
    </div>
    <!-- Modal para XML -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Arquivo XML</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Cada linha contem um conjunto de dados separados por célula da planilha<br/>
                        No Excell deve-se salvar com formato XML. Todas as 7 celulas da linha devem ser preenchidas</p>
                    <p><b>tipo_material_i,colecao_id,chamada,titulo,sub_titulo,isbn,ano,editora_id,autor_id,topicos,sit_id</b><br/></p>
                        tipo_material_id = 1 (Livros)<br/>
                        colecao_id = 1 (Centro)<br/>
                        classificacao_id = 1 (Outros)<br/>
                        editora_id = 1 (Outra)<br/>
                        autor_id = 1 (Outro)<br/>
                        sit_id = 1 (Circulação)
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
      <!-- Modal para CSV -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Arquivo CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Cada linha contem um conjunto de dados separados por virgula (,)</p>
                    <p><b>tipo_material_i,colecao_id,chamada,titulo,sub_titulo,isbn,ano,editora_id,autor_id,topicos,sit_id</b><br/></p>
                        tipo_material_id = 1 (Livros)<br/>
                        colecao_id = 1 (Centro)<br/>
                        classificacao_id = 1 (Outros)<br/>
                        editora_id = 1 (Outra)<br/>
                        autor_id = 1 (Outro)<br/>
                        sit_id = 1 (Circulação)
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    
</div>