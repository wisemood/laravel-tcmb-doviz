tcmb-doviz
==========

TC Merkez Bankası web sitesinden günlük döviz kurlarını alır.

Kurulum
=======

composer.json dosyanıza ekleyebilir veya workbench ile geliştirmek isterseniz git clone obarlas/tcmb-doviz komutu ile klonlayabilirsiniz.

İşlem bittikten sonra döviz tablosunu yaratmanız beklenmektedir. Bunun için artisan ile aşağıdaki komutu vermeniz gerekir;

```
php artisan migrate --bench obarlas/tcmb-doviz
```

Kullanım
========

Kullanımı gayet basittir, isterseniz elle kullanabilir veya bir cron işi olarak sitenize ekleyebilirsiniz.

```
php artisan get:doviz
```

Komut çalıştıktan sonra size hangi tarihli kurları kaydettiğini aşağıdaki gibi bildirecektir.

```
10.07.2014 tarihli kurlar başarı ile kaydedilmiştir.
```


Usage
=====

- You must add the package to your app config.

```php
'Obarlas\LaravelMigrateCustomCommand\LaravelMigrateCustomCommandServiceProvider',
```

- In the ```src/stubs``` folder of the package original stubs from the Laravel package can be found, create and copy them to your ```database/templates``` folder. Now you can edit the stubs according to your needs.

- Usage is simple

```
php artisan migrate:custom stub_name class_name --table=table_name
```

- ```migrate:custom``` command checks if there is a ```{{table}}``` variable in the stub file, and if no ```--table``` argument is passed it stops.
