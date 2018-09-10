# Проект
Yii2 + Nginx + MySQL в Docker контейнерах.

Развернутый проект: http://efko.ekhlusov.ru

Тестовые логины для проверки:

    Рядовые сотрудники: user1, user2 (пароли: useruser)
    
    Менеджер: manager (пароль: manager)
# Развертывание

Для работы проекта необходим `docker`.

`make start` - развертывание окружения в режиме продакшена

`make shell` или  - для входа в PHP-Cli проекта

и много еще чего полезного можно найти в `Makefile`

После изменений в конфиге nginx выполнить `make stop && docker-compose build nginx && make start`

Для разварачивания проекта первый раз необходимо выполнить
`make start && make shell`

#### Настройка nginx для доступа к сайту по нормальному имени
```
server {
    server_name holidays;
    listen 80;

    location / {
        proxy_pass              http://localhost:54480;
        proxy_set_header Host   holidays.loc;
    }
}
```

### Настройка дебаг сессии
PhpStorm перейдите во вкладку Language & frameworks -> php -> servers
Для localhost настройки mapping. app/app -> app/htdocs/
