# Exemples de crides Postman

Base local:

```text
http://localhost:8000/api
```

Base AWS:

```text
http://IP_PUBLICA_EC2/api
```

## Captures recomanades

1. `POST /register` amb resposta 201.
2. `POST /login` amb resposta 200 i token.
3. `GET /tasks` públic.
4. `GET /tasks/{id}` públic.
5. `POST /tasks` amb Bearer Token correcte.
6. `PUT /tasks/{id}` amb Bearer Token correcte.
7. Prova d'error: `POST /tasks` sense token o amb token incorrecte.
