# Pindichreich Themes

A collection of WordPress themes covering a range of lifestyle and interest topics.

## Planned themes

| Theme                       | Topic                   | Developed |
|-----------------------------|-------------------------|-----------|
| `pindichreich-travel`       | Travel & adventure      | ✔         |
| `pindichreich-sport`        | Sport & fitness         |           |
| `pindichreich-health`       | Health & wellness       |           |
| `pindichreich-esoteric`     | Esoteric & spirituality |           |
| `pindichreich-aurum-arcana` | Mysticism & occult      | ✔         |
| `pindichreich-mamasglueck`  | Mamas & Parenting       | ✔         |
| `pindichreich-coaching`     | Coaching                |           |
| `pindichreich-culinary`     | Healthy Food            | ✔         |

More themes to be added over time.

## Local development

### Requirements

- [Docker](https://docs.docker.com/get-docker/) and Docker Compose

### Setup

1. Copy the environment file and set your credentials:
   ```bash
   cp .env.example .env
   ```

2. Start the stack:
   ```bash
   docker compose up -d
   ```

   WordPress installs itself automatically. A `wpcli` container runs once after the DB and WordPress are healthy, then exits. Give it ~30 seconds on first boot.

3. Open WordPress at [http://localhost:8080](http://localhost:8080) — no install wizard, login straight away with the credentials from your `.env`.  
   Open phpMyAdmin at [http://localhost:8082](http://localhost:8082).

4. In the WordPress admin, go to **Appearance → Themes** and activate the theme you are working on.

### Stopping / resetting

```bash
# Stop containers (data persisted)
docker compose down

# Stop and wipe all data (full reset)
docker compose down -v
```

### Theme file structure

Each theme lives in `wp-content/themes/<theme-name>/`. The folder is bind-mounted into the WordPress container, so file changes are reflected immediately without restarting Docker.

Minimum required files per theme:

```
wp-content/themes/<theme-name>/
├── style.css        # Theme header (name, description, version, …)
├── functions.php    # Theme setup, enqueue scripts/styles
└── index.php        # Fallback template
```

## License

Mozilla Public License 2.0 — see [LICENSE](LICENSE).
