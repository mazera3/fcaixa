<body class="text-center">
    <form class="form-signin" method="POST" action="">
        <img class="mb-4" src="<?php echo URLADM . 'assets/imagens/logo_login/logo.jpeg'; ?>" alt="Celke" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Novo Usuário</h1>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if (isset($this->Dados['form'])) {
            $valorForm = $this->Dados['form'];
        }
        ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input name="nome" type="text" class="form-control" placeholder="Digite o nome completo" value="<?php
                if (isset($valorForm['nome'])) {
                    echo $valorForm['nome'];
                }
                ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-10">
                <input name="email" type="text" class="form-control" placeholder="Digite o seu melhor e-mail" value="<?php
                if (isset($valorForm['email'])) {
                    echo $valorForm['email'];
                }
                ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Usuário</label>
            <div class="col-sm-10">
                <input name="usuario" type="text" class="form-control" placeholder="Digite o usuário" value="<?php
                if (isset($valorForm['usuario'])) {
                    echo $valorForm['usuario'];
                }
                ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Senha</label>
            <div class="col-sm-10">
                <input name="senha" type="password" class="form-control" placeholder="Digite a senha">
            </div>
        </div>
        <input name="CadUserLogin" type="submit" class="btn btn-lg btn-success btn-block" value="Cadastrar">
        <p class="text-center"><a href="<?php echo URLADM . 'login/acesso' ?>">Clique aqui</a> para acessar</p>
    </form>
</body>
