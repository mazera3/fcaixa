<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="sidebar-toggle text-light mr-3">
        <span class="navbar-toggler-icon"></span>
    </a>
    <img class="rounded-circle" src="<?php echo URLADM . './assets/imagens/icone/fluxo-de-caixa.png'; ?>" width="40" height="40"> &nbsp;<a class="navbar-brand" href="<?php echo URLADM . 'home/index'; ?>">Fluxo de Caixa</a>
    <li class="text-white">
        &nbsp;&nbsp;Data de Hoje: <?php echo date("d-m-Y"); ?>
    </li>
    <?php if (isset($_SESSION['usuario_imagem']) AND (!empty($_SESSION['usuario_imagem']))) { ?>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle menu-header" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <?php } else {
                        ?>
                        <
                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav ml-auto">
                                <li>
                                    <a href="<?php echo URLADM . 'login/logout' ?>"><i class='fas fa-sign-out-alt'></i> Login</a>
                                </li>
                            </ul>
                        </div>

                        <?php
                    }
                    ?>
                    <?php if (isset($_SESSION['usuario_imagem']) AND (!empty($_SESSION['usuario_imagem']))) { ?>
                        <img class="rounded-circle" src="<?php echo URLADM . 'assets/imagens/usuario/' . $_SESSION['usuario_id'] . '/' . $_SESSION['usuario_imagem']; ?>" width="20" height="20"> &nbsp;<span class="d-none d-sm-inline">
                            <?php
                            $nome = explode(" ", $_SESSION['usuario_nome']);
                            $prim_nome = $nome[0];
                            echo $prim_nome;
                            echo '</span>';
                            echo '</a>';
                            echo '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">';
                            echo '<a class="dropdown-item" href="';
                            echo URLADM . 'ver-perfil/perfil';
                            echo '"><i class="fas fa-user"></i> Perfil</a>';
                            echo '<a class="dropdown-item" href="';
                            echo URLADM . 'login/logout';
                            echo '"><i class="fas fa-sign-out-alt"></i> Sair</a>';
                            echo '</div>';
                        }
                        ?>
                        </li>
                        </ul>
                        </div>
                        </nav>
