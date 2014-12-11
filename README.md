tcmb-doviz
==========

TC Merkez Bankası web sitesinden günlük döviz kurlarını alır.

Kurulum
-------

composer.json dosyanıza ekleyebilir veya workbench ile geliştirmek isterseniz git clone Wisemood/tcmb-doviz komutu ile
klonlayabilirsiniz. Kurulumu tamamladıktan sonra ```config/app.php``` dosyanıza aşağıdaki gibi eklemeniz gerekmektedir.

```php
'Wisemood\LaravelTcmbDoviz\ServiceProvider',
```

İşlem bittikten sonra döviz tablosunu yaratmanız beklenmektedir. Bunun için artisan ile aşağıdaki komutu vermeniz gerekir;

```
php artisan migrate --package wisemood/laravel-tcmb-doviz
```

Kullanım
--------

Komut satırı kısmındaki kullanımı gayet basittir, isterseniz elle kullanabilir veya bir cron işi yaratarak düzenli olarak
sitenize eklenmesini sağlayabilirsiniz.

```
php artisan doviz:get
```

Komut çalıştıktan sonra size hangi tarihli kurları kaydettiğini aşağıdaki gibi bildirecektir.

```
10.07.2014 tarihli kurlar başarı ile kaydedilmiştir.
```

Sadece Euro ve Dolar kurları alınmaktadır.

En Son Kuru Alma
----------------

```php
$kur = \Wisemood\TcmbDoviz\Doviz::sonKur();
```

ile kaydedilmiş en son kuru alabilirsiniz. Aldığınız kur içerisinde doları kullanmak için ```$kur->dolar``` euro'yu
kullanmak için ise ```$kur->euro``` değişkenlerini kullanın.

En Yakın Kuru Alma
------------------

Son kuru almak yerine verdiğiniz tarihin en yakın kurunu alır, eğer yakında bir kur yok ise ```false```, tarih
verilmemiş ise ```sonKur()``` değerini döndürür.

```php
$kur = \Wisemood\TcmbDoviz\Doviz::enYakinKur('2014-07-01');
```

Notlar
------

Doviz modeli tarihi her zaman d.m.Y formatında döndürür. Farklı bir formata ihtiyacınız varsa aşağıdaki gibi müdahale
edebilirsiniz.

```
$kur = \Wisemood\TcmbDoviz\Doviz::sonKur();
$kur->tarih = date("d-m-Y", strtotime($kur->tarih));
```

Eğer ```$kur->save();``` komutu ile kaydederseniz Doviz modelinin kurulumundan dolayı veritabanına her zaman ```Y-m-d```
formatında kaydedilir.
