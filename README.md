Este repositorio consiste em um Code Challenge promovido por @Tecnofit e desenvolvido por Carlos Eugenio
 - Tempo de desenvolvimento: `04h (10pm - 02am)`

A aplicacao contem Users CRUD, Movement CRUD, PersonalRecords CRUD, bem como suas migrations e seeders.
Ao finalizar a instalacao do projeto voce podera consumir o endpoint principal '/personal-records/ranking/{movement_id}' (nao esqueca de autenticar), que devera retornar o movimento escolhido e o ranking dos respectivos recordes de usuarios cadastrados, apesar de nao estar no escopo decidi implementar de forma simploria testes unitarios, autenticacao e cruds completos para as tabelas. 

![Screenshot_2](https://github.com/user-attachments/assets/89a821d7-cb44-4826-a800-b69ada0929db)

![Screenshot_3](https://github.com/user-attachments/assets/acd9914f-4b63-407c-91e4-bba7c519ac63)

![Screenshot_4](https://github.com/user-attachments/assets/4a66e3ff-91fe-44e7-9ad4-9c3837b1f448)



Projeto Laravel com Docker
- Este é um projeto Laravel configurado para rodar em contêineres Docker, facilitando o ambiente de desenvolvimento.

Como Clonar e Executar o Projeto
1. Clone esse repositório

2. Copiar o Arquivo de Configuração:
    - `cp .env.example .env`

3. Iniciar os Contêineres Docker:
   - `docker-compose up -d`

4. Executar Migrations e Seeders:
   - `docker-compose exec app php artisan migrate --seed`

5. Gerar a Chave da Aplicação:
   - `docker-compose exec app php artisan key:generate`

6. Acessar a Aplicação:
   - A aplicação estará disponível em `http://localhost:8000`


Para fazer requisicoes com sucesso voce devera estar autenticado, utilize register() ou login().
Para facilitar, voce pode baixar o Postman Collections `Tecnofit API.postman_collection.json` e importa-lo, contem todas as reqs disponiveis.
