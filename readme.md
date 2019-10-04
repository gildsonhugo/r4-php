
## Executando o projeto

(Certifique-se de que possui o ambiente de desenvolvimento do Laravel instalado na máquina antes de tudo).

- Clone o projeto para a pasta htdocs no seu servidor apache.
- Acesse o projeto através do cmd e execute o comando 'composer install'.
- Crie um banco de dados chamado 'r4php' ou outro nome que desejar no seu phpmyadmin utilizando o collation 'uft8mb4_unicode_ci'.
- Acesse o arquivo '.env' e edite as configurações de root do seu mysql instalado (user, password e database_name caso tenha criado o banco com um nome diferente).
- Você pode gerar o banco apenas com os dados do user admin rodando o comando 'php artisan migrate --seed' ou importar o banco com alguns os dados utilizando o arquivo na pasta 'dump' chamado 'db-dump.sql'.
- Antes de acessar a aplicação, execute o comando 'php artisan storage:link'.
- Acesse os endereço '{ADDRESS_LOCALHOST}/r4-php/public' para acessar a aplicação.

#### Dados do usuário admin

- Email: admin@admin.com
- Senha: admin
 
#### Demais usuários:

##### Hugo:
- Email: hugo@gmail.com
- Senha: asdfasdf

##### User:
- Email: user@user.com
- Senha: asdfasdf
