# Symfony Docker

A [Docker](https://www.docker.com/)-based installer and runtime for the [Symfony](https://symfony.com) web framework, with full [HTTP/2](https://symfony.com/doc/current/weblink.html), HTTP/3 and HTTPS support.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## Recreate database schema

```bash
docker-compose exec symfony bin/console app:db:schema:recreate
```

## Check syntax

```bash
docker-compose exec symfony vendor/bin/php-cs-fixer fix src --diff --dry-run -v --allow-risky=yes
```

## PHPUnit tests

```bash
docker-compose exec -T symfony bin/phpunit
```
