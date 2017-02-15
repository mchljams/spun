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
3. Extendable Spin Type, hooks to allow new custom spin types.
4. Function to analyze string with spin candidates. Perhaps to help optimize, and perhaps just to understand the number or unique combinations.
