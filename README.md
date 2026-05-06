# DA03 TaskManager API - Laravel + Docker + MySQL

Projecte base per a la pràctica **DA03 – Desenvolupament al núvol**.

## Funcionalitats incloses

- API REST amb Laravel.
- Autenticació amb Bearer Token mitjançant Laravel Sanctum.
- Base de dades MySQL.
- Dockerització amb 2 contenidors: `app` i `db`.
- Endpoints públics i privats.
- Workflow de GitHub Actions per publicar imatge a Docker Hub i desplegar a AWS EC2.

## Endpoints

| Tipus | Mètode | Ruta | Auth |
|---|---:|---|---|
| Health check | GET | `/api/health` | No |
| Registre | POST | `/api/register` | No |
| Login | POST | `/api/login` | No |
| Llistar tasques | GET | `/api/tasks` | No |
| Veure tasca | GET | `/api/tasks/{id}` | No |
| Crear tasca | POST | `/api/tasks` | Sí, Bearer Token |
| Actualitzar tasca | PUT | `/api/tasks/{id}` | Sí, Bearer Token |
| Eliminar tasca | DELETE | `/api/tasks/{id}` | Sí, Bearer Token |
| Logout | POST | `/api/logout` | Sí, Bearer Token |

## Posada en marxa local amb Docker

```bash
cp .env.example .env
docker compose up --build
```

L'API queda disponible a:

```text
http://localhost:8000/api/health
```

## Proves amb Postman

### 1. Registre

`POST http://localhost:8000/api/register`

```json
{
  "name": "Alumne DA03",
  "email": "alumne@example.com",
  "password": "password123"
}
```

### 2. Login

`POST http://localhost:8000/api/login`

```json
{
  "email": "alumne@example.com",
  "password": "password123"
}
```

Copia el camp `token` i utilitza'l com a Bearer Token a Postman.

### 3. Crear tasca privada

`POST http://localhost:8000/api/tasks`

Header:

```text
Authorization: Bearer EL_TOKEN_REBUT
```

Body:

```json
{
  "title": "Preparar documentació",
  "description": "Afegir captures de Postman, Docker, GitHub Actions i AWS",
  "status": "pending"
}
```

## Branques recomanades

```bash
git checkout -b dev
git checkout -b feature/auth
git checkout -b feature/tasks
git checkout -b feature/docker
git checkout -b feature/deploy-github-actions
```

Després, fes Pull Requests cap a `dev` i finalment cap a `main`.

## Secrets necessaris a GitHub Actions

A GitHub → Settings → Secrets and variables → Actions:

- `DOCKERHUB_USERNAME`
- `DOCKERHUB_TOKEN`
- `EC2_HOST`
- `EC2_USER`
- `EC2_SSH_KEY`

## URL Docker Hub

Substitueix pel teu usuari real:

```text
https://hub.docker.com/r/USUARI_DOCKERHUB/da03-taskmanager-api
```

## URL API AWS EC2

Substitueix per la IP elàstica real:

```text
http://IP_PUBLICA_EC2/api/health
```
