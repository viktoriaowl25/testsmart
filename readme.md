
## Test Task

Для работы с Api нужно зарегистироваться/залогинется.
api_token можно посмотреть в profile

Для запуска нужно создать бд mysql

```
cp .env.example .env
composer install
php artisan key:generate
```

Запись тестовых данных в бд 
```
php artisan migrate --seed
```

Консольные команды

```
php artisan order:create {product_id*}
php artisan order:update {order_id} {status_id}
```

Статусы можно менять согласно схеме

<p>Создан -> Обработан/Отменён </p>
<p>Обработан -> Передан Курьеру/Отменён</p>
<p>Передан Курьеру -> Выполнен/Отменён</p>

Тесты расположены test/Unit