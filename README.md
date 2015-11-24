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
2. Confugurable Syntax (Use delimeters other than curly braces)
3. Configurable Spin Type (Currently random, with skeleton for first and last in place. Another idea may be some sort of alphabetical choice.)
4. Extendable Spin Type, hooks to allow new custom spin types.
5. Function to analize string with spin candidates. Perhaps to help optimize, and perhaps just to understand the number or unique combinations.