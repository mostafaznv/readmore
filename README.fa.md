# ادامه مطلب

**ادامه مطلب** به شما کمک میکند که خلاصه یک متن را به وسیله یک *تگ* که از پیش مشخص کرده اید بدست آورید.

برای این کار کافی ست که یک *تگ* یا یک *سلکتور* را در هرجای کد «اچ تی ام ال» خود قرار دهید. به کمک این پکیج می توانید تمام محتوای قبل از تگ را استخراج کنید.

## مراحل نصب

1. نصب کردن پکیج به وسیله کامپوزر:
    ```shell
    composer require mostafaznv/readmore
    ```

2. انتشار فایل تنظیمات:
    ```
    php artisan vendor:publish --provider="Mostafaznv\ReadMore\ReadMoreServiceProvider"
    ```

3. تمام


## روش استفاده

##### به وسیله Facade

```php
<?php

use Illuminate\Http\Request;
use ReadMore;

class ReadMoreTest {
    public function testReadMore(Request $request) {
        $summary = ReadMore::generate($request->html);
        
        dd($summary);
    }   
}
```


##### به وسیله Trait

شما می توانید با اضافه کردن *تریت* ادامه مطلب به هر مدل دلخواه، به صورت کاملا اتوماتیک از داده های *یکی از ستون های فعلی* جدول خلاصه بسازید و به *ستون دلخواه* خود اضافه کنید.

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\ReadMore\Traits\ReadMore;

class Post extends Model
{
    use ReadMore;

    public static $readMore = ['from' => 'description', 'to' => 'title'];
}

```


## توسعه دهنگان
- مصطفی زینی وند -  [@mostafaznv](https://github.com/mostafaznv)
- فائزه قربان نژاد - [@Ghorbannezhad](https://github.com/Ghorbannezhad)
- تیم سمسون اپز [@SamssonApps](https://github.com/SamssonApps)


## Changelog

به [Changelog](CHANGELOG.md) مراجعه کنید تا از لیست تفییرات هر نسخه با خبر شوید.

## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2018 Mostafaznv, Some rights reserved.
