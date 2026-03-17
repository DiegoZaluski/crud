# 📋 recordlist (v0.0.1 - Alpha)

**recordlist** is a lightweight REST API for user management, built with **PHP + SQLite3**. It features a clean dark frontend for interacting with all endpoints directly from the browser.

---

## 🚀 About the Project

The goal is to explore REST API design, HTTP routing, and front-end integration without frameworks—just pure PHP, SQLite3, and pure JavaScript.

## 🛠️ Setup

### 1. Requirements

- **PHP 8.5+** — built-in server
- **SQLite3** — bundled with PHP
- **Live Server** *(optional)* — for the frontend

### 2. Running

```bash
# Start the API server
php -S localhost:8000 pack/public/index.php
```

Then open `web/index.html` with Live Server at `http://localhost:5500`.

> [!TIP]
> Add `"liveServer.settings.ignoreFiles": ["**/*.db"]` to VSCode's `settings.json` to prevent the page from reloading on every database write.

---

## 📁 Project Structure

```text
recordlist/
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
│   │   └── constants.php          # application constants
│   ├── core/
│   │   ├── routers.php            # HTTP method routing
│   │   └── services/
│   │       ├── get.php
│   │       ├── post.php
│   │       ├── patch.php
│   │       ├── delete.php
│   │       └── util/
│   └── public/
│       └── index.php              # front controller
├── web/
│   ├── index.html
│   ├── style.css
│   ├── api.js
│   └── app.js
└── openapi.json
```

---

## 🔌 Endpoints
 
All endpoints use the route `/api/operations`.
 
![GET](https://img.shields.io/badge/GET-3b82f6?style=flat-square&logoColor=white) `/api/operations` — List all users

![GET](https://img.shields.io/badge/GET-3b82f6?style=flat-square&logoColor=white) `/api/operations?id=1` or `?name=diego` — Find user by id or name

![POST](https://img.shields.io/badge/POST-22c55e?style=flat-square&logoColor=white) `/api/operations` — Create a new user

![PATCH](https://img.shields.io/badge/PATCH-f59e0b?style=flat-square&logoColor=white) `/api/operations?id=1` — Partially update a user

![DELETE](https://img.shields.io/badge/DELETE-ef4444?style=flat-square&logoColor=white) `/api/operations?id=1` — Delete a user
### Examples

```bash
# list all
curl http://localhost:8000/api/operations

# find by id
curl http://localhost:8000/api/operations?id=1

# create
curl -X POST http://localhost:8000/api/operations \
  -H "Content-Type: application/json" \
  -d '{"name":"diego","age":21,"description":"Software engineer"}'

# update
curl -X PATCH "http://localhost:8000/api/operations?id=1" \
  -H "Content-Type: application/json" \
  -d '{"atualizations":{"age":22}}'

# delete
curl -X DELETE "http://localhost:8000/api/operations?id=1"
```
 
