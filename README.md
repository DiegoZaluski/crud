# 📋 recordlist (v0.0.1 - Alpha)

**recordlist** is a lightweight REST API for user management, built with **PHP + SQLite3**. It features a clean dark frontend for interacting with all endpoints directly from the browser.

---

## 🚀 About the Project

The goal is to explore REST API design, HTTP routing, and front-end integration without frameworks—just pure PHP, SQLite3, and pure JavaScript.

## 🛠️ Setup

### 1. Requirements

- **PHP 8.5+** — built-in server
- **SQLite3** — bundled with PHP

### 2. Running
```bash
# Start the API server
php -S localhost:8000 pack/public/index.php
```

> [!TIP]
> Add `"liveServer.settings.ignoreFiles": ["**/*.db"]` to VSCode's `settings.json` to prevent the page from reloading on every database write.

---

## 📁 Project Structure
```text
crud/
├── data/
│   ├── data.db                    # SQLite3 database
│   └── DBOperations/
│       ├── db.php                 # SQLite3 connection
│       ├── querys.php             # reusable queries
│       ├── create.php
│       ├── inserts.php
│       ├── updates.php
│       └── deleteRegistration.php
├── pack/
│   ├── config/
│   │   ├── config.php             # CORS and allowed origins
│   │   └── constants.php         # application constants
│   ├── core/
│   │   ├── routers.php            # HTTP method routing
│   │   └── services/
│   │       ├── get.php
│   │       ├── post.php
│   │       ├── patch.php
│   │       ├── delete.php
│   │       └── util/
│   │           └── validations.php
│   └── public/
│       ├── index.php              # front controller
│       ├── docs.php               # API docs
│       └── openapi.json
├── compose.yaml
├── Dockerfile
└── openapi.json
```

---

## 🔌 Endpoints

All endpoints use the route `/api/users`.

![GET](https://img.shields.io/badge/GET-3b82f6?style=flat-square&logoColor=white) `/api/users` — List all users

![POST](https://img.shields.io/badge/POST-22c55e?style=flat-square&logoColor=white) `/api/users` — Create a new user

![PUT](https://img.shields.io/badge/PUT-8b5cf6?style=flat-square&logoColor=white) `/api/users?id=1` — Full update of a user

![PATCH](https://img.shields.io/badge/PATCH-f59e0b?style=flat-square&logoColor=white) `/api/users?id=1` — Partially update a user

![DELETE](https://img.shields.io/badge/DELETE-ef4444?style=flat-square&logoColor=white) `/api/users?id=1` — Delete a user

### Examples
```bash
# list all
curl http://localhost:8000/api/users

# create
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{"name":"diego","age":21,"email":"diego@email.com"}'

# full update
curl -X PUT "http://localhost:8000/api/users?id=1" \
  -H "Content-Type: application/json" \
  -d '{"name":"diego silva","age":22,"email":"diego.silva@email.com"}'

# partial update
curl -X PATCH "http://localhost:8000/api/users?id=1" \
  -H "Content-Type: application/json" \
  -d '{"age":22}'

# delete
curl -X DELETE "http://localhost:8000/api/users?id=1"
```