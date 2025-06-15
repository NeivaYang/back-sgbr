## Instalação do Projeto
### Pré-requisitos
O projeto foi desenvolvido com as tecnologias:
- Laravel 12.0;
- PHP ^8.2;
- PostgreSQL;
- Composer;

Caso utilize o Docker, é necessário ter instalado o Docker e Docker Compose.

### Instalação

Crie o arquivo .env com as variáveis de ambiente necessárias:
```bash
cp .env.example .env
```

Inicialize o Docker:
```bash
docker compose up --build
```

Acesse o bash do container:
```bash
docker compose exec app bash
```
Instale as dependências do Projeto:
```bash
composer install
npm install && npm run build
```

Gere a chave da aplicação:
```bash
php artisan key:generate
```

Configure o banco de daos no arquivo .env:
```bash
DB_CONNECTION=pgsql
DB_HOST=postgres_db
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=postgres
DB_PASSWORD=secret
```

Execute as migrações do banco de dados:
```bash
php artisan migrate
```

Execute os seeders do banco de dados:
```bash
php artisan db:seed
```

A API estará disponível em:
`http://localhost:8000`

Todas as requisições para a API devem conter os seguintes headers:
```bash
Accept: application/json
X-API-KEY: {APP_KEY}
# APP_KEY precisa ser igual o valor gerado pelo "php artisan key:generate" (APP_KEY em seu .env)
```

## Endpoints da API

Todos os endpoints abaixo exigem o header `X-API-KEY` com o valor do `APP_KEY` gerado.

### Listar todos os lugares
**GET** `/api/places`

### Filtar lugares pelo nome
**GET** `/api/places/search?query={query}`
>substitua `{query}` pela busca desejada.

### Obter detalhes de um lugar por ID
**GET** `/api/places/{id}`
> Substitua `{id}` pelo Id do lugar que deseja obter detalhes.

### Criar um novo lugar
**POST** `/api/places`
- Body (JSON):  
    - `"name"` (string, obrigatório): Nome do lugar.
    - `"description"` (string, opcional): Descrição detalhada do lugar.
    - `"address"` (string, opcional): Endereço completo do local.
    - `"city"` (string, opcional): Cidade onde o lugar está localizado.
    - `"state"` (string, opcional): Estado correspondente.
    - `"country"` (string, opcional): País de localização.

    Exemplo de payload:
    ```json
    {
        "name": "Nome do lugar",
        "description": "Descrição do lugar",
        "address": "Endereço do lugar",
        "city": "Cidade",
        "state": "Estado",
        "country": "País"
    }
    ```

### Atualizar um lugar existente
**PUT/PATCH** `/api/places/{id}`
- Body (JSON):  
    - `"name"` (string, obrigatório): Nome do lugar.
    - `"description"` (string, opcional): Descrição detalhada do lugar.
    - `"address"` (string, opcional): Endereço completo do local.
    - `"city"` (string, opcional): Cidade onde o lugar está localizado.
    - `"state"` (string, opcional): Estado correspondente.
    - `"country"` (string, opcional): País de localização.

    Exemplo de payload:
    ```json
    {
        "name": "Nome do lugar",
        "description": "Descrição do lugar",
        "address": "Endereço do lugar",
        "city": "Cidade",
        "state": "Estado",
        "country": "País"
    }
    ```
> Substitua `{id}` pelo Id do lugar que deseja atualizar.


### Remover um lugar
**DELETE** `/api/places/{id}`
> Substitua `{id}` pelo Id do lugar que deseja remover.
