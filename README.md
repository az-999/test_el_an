# test_el_an

Тестовое API для аналитики (продажи, заказы, склады, доходы) на Laravel 8 + Octane.

## Стек

- PHP 8.1, Laravel 8, Laravel Octane (Swoole)
- MySQL 8
- Docker / docker-compose

## Быстрый старт

```bash
docker compose up --build
```

API будет доступно на `http://localhost:6969`.

При первом запуске выполняются миграции и сиды (если `SEED_ON_START=true`).

### Переменные окружения

Скопируйте `application/.env.example` в `application/.env` или используйте значения из `docker-compose.yml`:

| Переменная | Значение по умолчанию |
|------------|----------------------|
| `API_KEY` | `test-api-key` |
| `DB_HOST` | `mysql` |
| `DB_DATABASE` | `wb_api` |
| `DB_USERNAME` | `wb` |
| `DB_PASSWORD` | `wb_secret` |

## Эндпоинты

Авторизация: query-параметр `key`.

| Метод | Путь | Параметры |
|-------|------|-----------|
| GET | `/api/sales` | `dateFrom`, `dateTo`, `page`, `limit`, `key` |
| GET | `/api/orders` | `dateFrom`, `dateTo`, `page`, `limit`, `key` |
| GET | `/api/incomes` | `dateFrom`, `dateTo`, `page`, `limit`, `key` |
| GET | `/api/stocks` | `dateFrom` (текущий день), `page`, `limit`, `key` |

- Формат даты: `Y-m-d`
- Лимит по умолчанию: **500** (макс. 500)
- Ответ: JSON с пагинацией (`data`, `current_page`, `per_page`, `total`, …)

### Примеры

```text
GET /api/orders?dateFrom=2024-01-01&dateTo=2024-12-31&page=1&limit=100&key=test-api-key

GET /api/stocks?dateFrom=2025-05-16&key=test-api-key
```

## Сиды (тестовые данные)

```bash
docker compose exec app php artisan db:seed
```

Или пересоздать БД:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

Сиды создают ~300 incomes, ~800 orders, ~800 sales, ~200 stocks (stocks — только на сегодня).

## Тесты

```bash
docker compose exec app php artisan test
```

Локально (из `application/`):

```bash
php artisan test
```

## Postman

[Коллекция app-api-test](https://www.postman.com/cy322666/workspace/app-api-test/overview)

## Эталон

Реализация ориентирована на [cy322666/wb-api](https://github.com/cy322666/wb-api).
