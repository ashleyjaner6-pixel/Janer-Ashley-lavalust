# Laboratory Exercise 5 Setup

## Local or Aiven database

The application reads all credentials from environment variables. Do not commit real values.

Run this SQL in Aiven MySQL if you are not using the included migration:

```sql
CREATE TABLE products (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
```

Set `DB_DRIVER=mysql`, `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`, and `DB_CHARSET=utf8mb4` from the Aiven service connection details. Aiven's MySQL service normally requires TLS. Download its CA certificate, convert it to one line with base64, and set that value as `DB_SSL_CA_BASE64`; the application writes it to temporary storage before connecting. `DB_SSL_CA` can still be used when the deployment already has the CA certificate as a file path.

To create the base64 value locally:

```powershell
[Convert]::ToBase64String([IO.File]::ReadAllBytes('.\\ca.pem'))
```

## Authentication

Set `ADMIN_EMAIL`, `ADMIN_PASSWORD`, and optionally `ADMIN_USERNAME`. On the first successful login, the configured admin is created in the `users` table from the existing migration. Product routes are protected by the `auth` middleware and redirect unauthenticated requests to `/login`.

## Render

Push the project to your GitHub repository and create a Render Web Service from that repository. Render will detect the included `Dockerfile` (or use `render.yaml`). Configure the variables from `render.yaml` in Render Environment Variables. Set `APP_URL` to the public Render URL. Use the Aiven values for all `DB_*` variables and never commit `.env` or passwords.

The equivalent manual start command is:

```bash
php -S 0.0.0.0:$PORT -t public public/router.php
```

For Apache hosting, point the document root at `public/` and enable the included `public/.htaccess` rewrite rules. Verify `/login`, `/products`, create, edit, and delete after deployment.
