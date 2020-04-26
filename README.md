It allows you to get Instagram user information and shares without the need for any addiction.

![Example Screen](https://i.ibb.co/41whMnS/indir.png)

Usage:
```php
include "src/SchxzInstagram.php";

use Schxz\Instagram;

$insta = new Schxz\Instagram;
$Posts = $insta->loadUser("instagram")->getPosts(24);
```


```php
$insta->User->full_name;
$insta->User->username;
$insta->User->biography
$insta->User->edge_followed_by->count
```

and more...
