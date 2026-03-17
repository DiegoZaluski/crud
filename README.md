# recordlist

API REST para gerenciamento de usuários, construída com PHP + SQLite3.

---

## Stack

- **PHP 8.5** — servidor embutido
- **SQLite3** — banco de dados
- **Vanilla JS** — frontend no módulo `web/`

---

## Estrutura

```
recordlist/
├── data/
│   ├── data.db                       # banco SQLite3
│   └── DBOperations/
│       ├── db.php                    # conexão SQLite3
│       ├── querys.php                # queries reutilizáveis
│       ├── create.php
│       ├── inserts.php
│       ├── updates.php
│       └── deleteRegistration.php
├── pack/
│   ├── config/
│   │   ├── config.php                # CORS e origens permitidas
│   │   └── constants.php             # constantes da aplicação
│   ├── core/
│   │   ├── routers.php               # roteamento por método HTTP
│   │   └── services/
│   │       ├── get.php
│   │       ├── post.php
│   │       ├── patch.php
│   │       ├── delete.php
│   │       └── util/
│   └── public/
│       └── index.php                 # front controller
├── web/
│   ├── index.html
│   ├── style.css
│   ├── api.js
│   └── app.js
├── openapi.json
└── README.md
```

---

## Rodando

```bash
php -S localhost:8000 pack/public/index.php
```

Frontend disponível em `http://localhost:5500` via Live Server.

> **Dica:** adicione `"liveServer.settings.ignoreFiles": ["**/*.db"]` no `settings.json` do VSCode para evitar reloads desnecessários causados pelo SQLite.

---

## Endpoints

Todos os endpoints usam a rota `/api/operations`.

| Método | Params | Descrição |
|---|---|---|
| `GET` | — | Lista todos os usuários |
| `GET` | `?id=1` ou `?name=diego` | Busca usuário por id ou nome |
| `POST` | body | Cria novo usuário |
| `PATCH` | `?id=1` + body | Atualiza parcialmente |
| `DELETE` | `?id=1` | Remove usuário |

### Exemplos

```bash
# listar todos
curl http://localhost:8000/api/operations

# buscar por id
curl http://localhost:8000/api/operations?id=1

# criar
curl -X POST http://localhost:8000/api/operations \
  -H "Content-Type: application/json" \
  -d '{"name":"diego","age":21,"description":"Software engineer"}'

# atualizar
curl -X PATCH "http://localhost:8000/api/operations?id=1" \
  -H "Content-Type: application/json" \
  -d '{"atualizations":{"age":22}}'

# deletar
curl -X DELETE "http://localhost:8000/api/operations?id=1"
```