    <?php
    /* Habilita a exibição de erros */
    //error_reporting(E_ALL);
    //ini_set("display_errors", 1);
    require './core/Config.php';
    require './vendor/autoload.php';

    use Core\ConfigController as Home;

    $Url = new Home();
    $Url->carregar();
