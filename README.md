# Read More 

**Read More** will help you make summary of a text by a tag that you’ve defined previously. you just have to place a tag or a selector anywhere on your HTML code. with this package you will be able to extract all the content before the tag (selector).

*Note: farsi [documentation](https://github.com/mostafaznv/readmore/blob/master/README.fa.md)*


## Install

1. Install the package with a composer 
    ```shell
    composer require mostafaznv/readmore
    ```

2. Publish the config file
    ```
    php artisan vendor:publish --provider="Mostafaznv\ReadMore\ReadMoreServiceProvider"
    ```

3. Done


## Usage

##### Using with facade

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


##### Using with trait

By adding the following trait to any model, you can automatically make a summery from content of an `existing` table column and add it to your `desired` column.
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



## Changelog

Check out the [Changelog](CHANGELOG.md) to see the list of changes on each version.

## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2018 Mostafaznv, All rights reserved.
