0 - Criar o .env do projeto:
    duplicar o .env.example e renomear para .env

1 - buildar o projeto:
    docker compose build 

2 - subir os containers:
    docker compose up

3 - instalar as dependências do composer:
	3.1 - docker compose exec -it php bash 
	3.2 - composer install


4 - criar a key do projeto:
	4.1 - docker compose exec -it php bash 
	4.2 - php artisan key:generate
	

5 - rodar migrations (criar as tabelas do banco):
	5.1 - docker compose exec -it php bash 
	5.2 - php artisan migrate
	

6 - acessar a aplicação:
    http://localhost