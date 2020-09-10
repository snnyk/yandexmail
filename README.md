# Yandex Corporate Mail 

1 - You must point your domain to yandex connect first [Follow here](https://yandex.com/support/connect/enable-mail.html)
2-  Get domain key from [Yandex Token Manegement Page](https://pddimp.yandex.ru/api2/admin/get_token)

```sh
$ composer require snnyk/yandexmail
```
```php
$mail = new Snnyk\Yandex\Mail([
    'key' => 'youdomainkey',
    'domain' => 'yourdomain.com'
]);

$list = $mail->getList();
var_dump($list->accounts);
```

you can find other example functions in **example.php**
