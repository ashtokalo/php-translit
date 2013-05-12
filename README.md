translit
========

`translit` is a PHP library to convert text from one script to another.
Currently it assume conversion of Cyrillic, Georgian, Armenian and Greek
scripts into Roman (Latin). Cyrillic has sub-groups for Russian, Ukrainian,
Belarusian, Bulgarian and Kazakh languages with custom rules.

Main class Translit could be used as singleton or object itself. Built-in
translitaration tables could be refered by following language codes:
* ru - Russian cyrillic chars,
* uk - Ukrainian cyrillic chars,
* be - Belarusian cyrillic chars (converted to latin with diacritical),
* bg - Bulgarian cyrillic chars (converted to latin with diacritical),
* kk - Kazakh cyrillic chars (converted to latin with diacritical),
* ka - Georgian chars,
* hy - Armenian chars (converted to latin with diacritical),
* el - Greek chars (converted to latin with diacritical),
* cyrillic - all cyrillic chars according to ISO 9:1995
* latin - only latin chars without diacritical marks

Language codes could be combined by comma to handle more cases, e.g.

    echo Translit::object()->convert('Беларусь', 'be') . ' vs ' .
        Translit::object()->convert('Беларусь', 'be,latin');

produce output:

    Bielaruś vs Bielarus

By default wrong language codes ignored. But this behavior could be changed by
using strict mode. For all language codes that prepended with exclamation mark
exception will be fired if any error (no conversion table, wrong format, empty).
For example:

    // following code returns 'Привет' as is because handler ru_ru not defined
    echo Translit::object()->convert('Привет', 'ru_ru') . PHP_EOL;

    // but next code fires Exception, because strict mode have used
    echo Translit::object()->convert('Привет', '!ru_ru') . PHP_EOL;

There are many sources of these tables which could be used - ISO and BGN/PCGN
standards, a lot of native standards and informal standard used by people.
For this library I assume next order of sources - native, ISO, BGN/PCGN,
informal.

All transliteration tables were created from information found at Wikipedia. The
links to these pages posted into header of each file. Please update me if any
mistakes found or you have new transliteration tables to add here.
