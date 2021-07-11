### Requisitos Mínimos
- PHP 7.4
- Banco de dados - MySql 8
- extensões PHP: php7.4-zip, php7.4-imagick ou php7.4-gd
- servidor Apache 2
- composer, nodejs, npm
- habilitar o módulo de reescrita do apache

### Instalação
- Fazer o dowload do código fonte para um diretório do Apache.
- instalar as dependências com composer e npm
- /pasta do caixa/composer update
- /pasta do caixa/npm install


### Ex: var/www/html/caixa

- Criar a base de dados: caixa
- importar o arquivo backup_db_.sql
- alterar as credenciais do arquivo Config.php



## Credenciais de acesso
- define('URLADM', 'http://localhost/caixa/');
- define('URL', 'http://localhost/caixa/');

- define('SITE_ROOT',ROOT.DS.'caixa');

- define('HOST', 'localhost');
- define('USER', 'usuario aqui');
- define('PASS', 'senha aqui');
- define('DBNAME', 'caixa');
- define('PORT', 3308);

## Primeiro Acesso:

- digite o endereço: http://localhost/caixa/
- Usuario: admin
- Senha Admin
- Altere a senha admin por segurança ou crie novo usuario administrativo

## Usuarios
- nivel superadministrador (senha: admin) (tem acesso total ao administrativo)
- nivel contador (usuario:conta senha: conta) (tem acesso total ao caixa)
- nivel funcionario (usuario:funcionario senha: 123456) (tem acesso as principais funções do caixa)
- nivel estagiário (usuario:estagio senha: 123456) (tem acesso limitado ao caixa)

-