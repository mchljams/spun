Spun
=====

PHP string/text spinning library using spintax.

How To Use
-----

```php
$spun = new Spun;

$spun->str = "This is a string that {includes|contains|holds} choices you can spin.";

$new_string = $spun->spin();
```

**One Possible Result**

```
This is a string that holds choices you can spin.
```

Proposed Features
----
1. Nesting
2. Configurable Syntax (Use delimiters other than curly braces)
