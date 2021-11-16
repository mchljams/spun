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


Unit Tests
-----
**Run Unit Tests**

Change directory to the root of this package and run:

```
./vendor/bin/phpunit
```

**Run Unit Tests With HTML Coverage Report**

```
./vendor/bin/phpunit --coverage-html coverage
```

Code Linting
-----
**Using PHP_CodeSniffer**

Developed using the PSR-2 Standard

```
./vendor/bin/phpcs --standard=PSR12 --tab-width=4 --colors ./src
```
