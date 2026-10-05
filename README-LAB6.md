# Lab 6 Product API

LavaLust API for the React inventory frontend. Product reads and writes require a signed bearer token. The browser must use this API; it must never connect directly to MySQL.

## Routes

| Method | Route | Access |
| --- | --- | --- |
| `GET` | `/` | Public health check |
| `POST` | `/api/login` | Public |
| `POST` | `/api/logout` | Bearer token |
| `GET` | `/api/products` | Bearer token |
| `POST` | `/api/products` | Bearer token |
| `PUT` or `PATCH` | `/api/products/{id}` | Bearer token |
| `DELETE` | `/api/products/{id}` | Bearer token |

Login JSON contains `username` and `password`. Product JSON contains `product_name`, `description`, `price`, and `quantity`. API responses use LavaLust's `Api` library. Logout revokes the token in `auth_sessions`.

## Aiven MySQL

Use Navicat to connect to the Aiven service and run [`database/schema.sql`](database/schema.sql) against the application database. This creates `products` and `auth_sessions`.

The Render service already has database variables. Keep their values private. The API reads `DB_HOST`, `DB_PORT`, `DB_NAME` (or `DB_DATABASE`), `DB_USER` (or `DB_USERNAME`), and `DB_PASSWORD`. Upload Aiven's downloaded CA certificate in Render as a **Secret File**, then set `DB_SSL_CA` to its mounted file path. The API enables PDO MySQL certificate verification when that path is configured.

Configure these additional variables in Render's Environment page; never put real values in GitHub:

| Variable | Required value |
| --- | --- |
| `JWT_SECRET` | Random secret, at least 32 characters |
| `REFRESH_TOKEN_KEY` | Different random secret, at least 32 characters |
| `ADMIN_USERNAME` | Administrator username |
| `ADMIN_PASSWORD_HASH` | PHP `password_hash()` result for the chosen password |
| `FRONTEND_ORIGIN` | Exact deployed frontend origin |
| `ACCESS_TOKEN_TTL` | Token lifetime in seconds; defaults to `900` |
| `JWT_ISSUER` | Optional; defaults to `product-api` |
| `JWT_AUDIENCE` | Optional; defaults to `product-frontend` |

Generate an administrator password hash locally:

```powershell
php -r "echo password_hash('choose-your-own-password', PASSWORD_DEFAULT), PHP_EOL;"
```

Put the resulting hash in Render's `ADMIN_PASSWORD_HASH` secret value. Do not commit the password or hash. Keep Aiven network access limited to Render's outbound IPs where your Aiven plan allows it.

## Render

The `Janer-Ashley-lavalust-2` Web Service uses this repository's root Dockerfile and `main` branch. The Docker image serves the LavaLust PHP app on Render's `PORT`. After pushing an API change, Render's automatic deploy should build the new commit. Confirm `/` returns `{"status":"ok"}` and that `/api/products` returns `401` without a bearer token.

For the React static site, set `VITE_API_BASE_URL` to this service URL and set the API's `FRONTEND_ORIGIN` to the static site's exact URL. If frontend files are in another repository, deploy that repository as a separate Render Static Site.