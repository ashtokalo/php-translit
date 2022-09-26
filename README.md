translit
========

`translit` is a PHP library to convert text from one script to another.
Currently it assume conversion of Cyrillic, Georgian, Armenian and Greek
scripts into Roman (Latin). Cyrillic has sub-groups for Russian, Ukrainian,
Belarusian, Bulgarian and Kazakh languages with custom rules.

## Installation

This package can be installed through Composer:

```sh
$ composer require ashtokalo/php-translit
```

Make sure to use Composer's autoload:

```php
require __DIR__.'/../vendor/autoload.php';
```

## Usage

Main class Translit could be used as singleton or object itself. Built-in
transliteration tables could be referred by following language codes:
* ru - Russian cyrillic chars,
* uk - Ukrainian cyrillic chars,
* mk - Macedonian cyrillic chars,
* be - Belarusian cyrillic chars (converted to latin with diacritical),
* bg - Bulgarian cyrillic chars (converted to latin with diacritical),
* kk - Kazakh cyrillic chars (converted to latin with diacritical),
* ka - Georgian chars,
* hy - Armenian chars (converted to latin with diacritical),
* el - Greek chars (converted to latin with diacritical),
* cyrillic - all cyrillic chars according to ISO 9:1995,
* latin - only latin chars without diacritical marks,
* ascii - only ASCII chars, all non ASCII will be replaced with question mark.

Language codes could be combined by comma to handle more cases, e.g.

```php
echo \ashtokalo\translit\Translit::object()->convert('Беларусь', 'be') . ' vs ' .
    \ashtokalo\translit\Translit::object()->convert('Беларусь', 'be,latin');
```

produce output:

```
Bielaruś vs Bielarus
```

You can also add alternative transliteration tables through property `classes`,
which is list of language code in keys and class names in values:

```php
$translit = new \ashtokalo\translit\Translit;
$translit->classes['tlh'] = \startrek\TranslitKlingon::class;
echo $translit->convert(' ', 'tlh');
```

By default wrong language codes ignored. But this behavior could be changed by
using strict mode. For all language codes that prepended with exclamation mark
exception will be fired if any error (no conversion table, wrong format, empty).
For example:

    // following code returns 'Привет' as is because handler ru_ru not defined
    echo Translit::object()->convert('Привет', 'ru_ru') . PHP_EOL;

    // but next code fires Exception, because strict mode have used
    echo Translit::object()->convert('Привет', '!ru_ru') . PHP_EOL;

## Tests

The package contains integration tests. You can run them using PHPUnit.

```sh
$ vendor/bin/phpunit
```

## Credits

All transliteration tables were created from information found at Wikipedia. The
links to these pages posted into header of each file. Please update me if any
mistakes found or you have new transliteration tables to add here.

There are many sources of these tables which could be used - ISO and BGN/PCGN
standards, a lot of native standards and informal standard used by people.
For this library I assume next order of sources - native, ISO, BGN/PCGN, informal.

## Contributing

Contributions are very welcome.

Only contributions via Pull Requests on [Github](https://github.com/ashtokalo/php-translit) is accepted:

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)**

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant
documentation are kept up-to-date.

- **Create feature branches** - Don't ask me to pull from your master branch.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful.
If you had to make multiple intermediate commits while developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

## License

The MIT License (MIT). Refer to the [License](LICENSE) for more information.
