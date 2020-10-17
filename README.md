## При развертке на Open Server

Для nginx в конфигах изменить параметр try_files как в документации.
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
Для Apache разбирайтесь сами. На этом мои полномочия как бы все.
(Пример можно смотреть на официальном сайте)

Выполнить php artisan key:generate
