## TecDocSite

Пример каталога TecDoc с использованием TecDoc API от ABCP

### Внимание

Директория ```./tmp``` должна быть доступна для записи web-сервером

Требования:

```php 5.5 - 7.2```

#### Установка: 
Распаковать или клонировать репозиторий в корень сайта.

Выполнить в корне репозитория в консоли команду:

```bash
php composer.phar install
```
Заполнить данные выданные при регистрации в файле: 
`Common/TecDocApiConfig.php`

Отредактировать ссылку для перехода к поиску на вашем сайте.

Ссылка находится в файле: `View/group.details.tpl` 
строка 62 и 110 
`<a target="_blank" href="//4mycar.ru/parts/ ...`

#### Запуск с использованием [docker](http://docker.com), [docker-compose](http://docs.docker.com/compose/)

```bash
#для php 7.2
#установка зависимостей
docker-compose run web72 php composer.phar install
#запуск контейнера с катаолгом
docker-compose up -d web72
```
каталог будет доступен по адресу ```http://localhost:8072``` так же доступны другие версии php в контейнерах `web55` `web56` на портах `8055` `8056` соответвенно


### Дополнительная информация
##### Известные ошибки и способы их решения
###### Ошибка неудовлетворенных зависимостей:
```
Warning: require_once(vendor/autoload.php): failed to open stream: No such file or directory in /var/www/__autoload.php on line 26

Fatal error: require_once(): Failed opening required 'vendor/autoload.php' (include_path='.:/usr/local/lib/php') in /var/www/__autoload.php on line 26
```
Данная ошибка возникает из-за того что не установлены зависимости для проекта, для её устранения необходимо запустить в корне репозитория 
```bash
php composer.phar install
```
или для [docker-compose](http://docs.docker.com/compose/) 
```bash
docker-compose up -d web72
```
###### Ошибка авторизации

```Fatal error: Uncaught exception 'Exception' with message 'Ошибка авторизации пользователя' ```

Данная ошибка возникает в случае если в конфигурационном файле указаны неверные данные.