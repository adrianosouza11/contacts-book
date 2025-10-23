# Contacts Book

## Passo a passo para rodar o serviço de API do projeto **Contacts Book**

### 1. Criar o arquivo no diretório `api/.env`

Antes de iniciar a aplicação, crie um arquivo `.env` na raiz do projeto e preencha as variáveis abaixo conforme necessário:

```
APP_NAME=Contactsbook-api
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"

NOTIFICATION_MAIL=
```

> O valor de `APP_KEY` será gerado automaticamente quando o container for iniciado pela primeira vez, caso ainda não exista.

---

### 2. Configuração opcional frontend (web/.env)

Caso queira indicar explicitamente onde a API está respondendo (por exemplo, para uso no frontend), você pode definir a variável de ambiente `VITE_API_URL`.  

Exemplo:

```
VITE_API_URL=http://localhost:8000/api
```

Essa configuração é opcional, mas pode ser útil para ambientes personalizados.

---

### 3. Subindo a aplicação com Docker

Após configurar o `.env`, execute o seguinte comando para construir e iniciar o serviço da API:

```
docker compose up -d --build
```

Esse comando irá:
- Criar e iniciar os containers definidos no arquivo `docker-compose.yml`;
- Executar as migrações e configurações necessárias automaticamente;
- Disponibilizar o serviço da API localmente, geralmente em `http://localhost:8000`.

---

### 4. Acesso e testes

Após o container estar em execução, você pode acessar o endpoint principal da API, por exemplo:

```
API => http://localhost:8000/api
Web => http://localhost:8080
```

---

### 5. Parar o serviço

Para interromper a execução dos containers, utilize o comando:

```
docker compose down
```
