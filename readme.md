## Consulta de CPF em blacklist

Essa aplicação foi desenvolvida usando Laravel 5.7 (compativel com PHP 7.2), PHPUnit, Docker e Docker Compose, MySQL e VanillaJS.

Para iniciar o projeto é necessario rodar o `composer install` e `php artisan migrate` dentro do container. Para rodar o container basta executar o comando `docker-compose up` na pasta raiz do projeto.

Para essa api foram desenvolvidos os seguintes end-points:

- localhost:3000/api/check-cpf?cpf=* [GET] Para consultar se um cpf está na black list. O parametro para consulta é o cpf 
- localhost:3000/api/black-list [POST] Para inserir um cpf em uma black list. Deve ser enviado o parametro cpf
- localhost:3000/api/black-list [GET] Retorna lista de dados inseridos na blacklist
- localhost:3000/api/black-list/{cpf?} [DELETE] Para excluir um registro da black list
- localhost:3000/api/status [GET] Retorna status do sistema

Na rota base (localhost:3000/) existe um form para consulta de cpf

Foram desenvolvidos testes unitarios e de funcionalidades. Para rodar esses testes basta usar o comando `vendor/bin/phpunit` dentro do container.