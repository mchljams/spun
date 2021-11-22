# Spun

A PHP string/text spinning library using spintax. Spintax may be used as a content creation tool. The term spintax originates by combining two words, spinning and syntax. Using this you can create multiple versions of a string that may appear unique. Useful applications may be in article writing, SEO, targeted marketing messages or more. 

## How To Use

```php

$str = "This is a string that {includes|contains|holds} choices you can spin.";

$spinner = new Mchljams\Spun\Spinner($str);

$result = $spinner->spin();

// One possible result will be: "This is a string that holds choices you can spin."
```


## Contributing

### Unit Tests

Change directory to the root of this package and run:

```
composer test
```

**Run Unit Tests With HTML Coverage Report**

```
./vendor/bin/phpunit --coverage-html coverage
```

```
phpdbg -qrr ./vendor/bin/phpunit --coverage-html coverage
```

Code Linting
-----
**Using PHP_CodeSniffer**

Developed using the PSR-12 Standard

```
./vendor/bin/phpcs --standard=PSR12 --tab-width=4 --colors ./src
```
