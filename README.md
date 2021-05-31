### Requisitos Mínimos
- PHP 7.4
- Banco de dados - MySql 8
- extensões PHP: php7.4-zip, php7.4-imagick ou php7.4-gd
- servidor Apache 2
- composer
- habilitar o módulo de reescrita do apache

### Instalação
- Fazer o dowload do código fonte para um diretório do Apache.
- instalar as dependências com composer
- /pasta do bibelivre/composer update


### Ex: var/www/html/bibelivre

- Criar a base de dados: bibelivre
- importar o arquivo backup_db_.sql
- alterar as credenciais do arquivo Config.php



## Credenciais de acesso
- define('URLADM', 'http://localhost/bibelivre/');
- define('URL', 'http://localhost/bibelivre/');

- define('SITE_ROOT',ROOT.DS.'bibelivre');

- define('HOST', 'localhost');
- define('USER', 'usuario aqui');
- define('PASS', 'senha aqui');
- define('DBNAME', 'bibelivre');
- define('PORT', 3308);

## Primeiro Acesso:

- digite o endereço: http://localhost/bibelivre/
- Usuario: admin
- Senha Admin
- Altere a senha admin por segurança ou crie novo usuario administrativo

## Usuarios
- nivel superadministrador (senha: admin) (tem acesso total ao administrativo)
- nivel administrador (usuario:bibelivre senha: 123456) (tem acesso total a biblioteca)
- nivel funcionario (usuario:funcionario senha: 123456) (tem acesso as principais funções da biblioteca)
- nivel estagiário (usuario:estagio senha: 123456) (tem acesso limitado a biblioteca)

-