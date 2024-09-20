**Este repositório consiste em um Code Challenge promovido por @Tecnofit**

É uma aplicação simples que contém as seguintes entidades: *User*, *Movement*, *PersonalRecords*. A entidade *PersonalRecords* registra um *User* e um *Movement* existentes atrelando aos atributos correspondentes para data e peso. 

Todas as entidades contém Model, Controller, Service, RequestValidator e Teste unitário (crud funcional). 

Ao finalizar a instalação e configuralçao do ambiente consuma o endpoint principal **'/personal-records/ranking/{movement_id}'** (nao esqueca de autenticar), onde *{movement_id}* é o ID do movimento *Movement* cadastrado e o ranking dos respectivos recordes de usuarios cadastrados será retornado num pacote json serializado. Além disso todos os endpoints da aplicação montados e disponibilizados no arquivo: `Tecnofit API.postman_collection.json`
Para facilitar os testes, voce pode baixar essa coleção e importá-la em seu postman.

![Screenshot_2](https://github.com/user-attachments/assets/89a821d7-cb44-4826-a800-b69ada0929db) 
![Screenshot_3](https://github.com/user-attachments/assets/acd9914f-4b63-407c-91e4-bba7c519ac63)



**Projeto Laravel Docker**
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


Para fazer requisicoes com sucesso voce devera estar autenticado, utilize de registro ou login (ambos contidos no diretório 'Autenticação' do postman collection disponibilizado).
