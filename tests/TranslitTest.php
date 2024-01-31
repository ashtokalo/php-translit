<?php

use PHPUnit\Framework\TestCase;
use ashtokalo\translit\Translit;

class TranslitTest extends TestCase
{
    public function test_translit()
    {
        // test difference between cyrillic scripts
        $this->assertEquals('Rossiia', Translit::object()->convert('Россия', 'ru'));
        $this->assertEquals('Rossiâ', Translit::object()->convert('Россия', 'cyrillic'));
        $this->assertEquals('Rossia', Translit::object()->convert('Россия', 'cyrillic,latin'));
        $this->assertEquals('Ukraina', Translit::object()->convert('Україна', 'uk'));
        $this->assertEquals('Ukraïna', Translit::object()->convert('Україна', 'cyrillic'));
        $this->assertEquals('Ukraina', Translit::object()->convert('Україна', 'cyrillic,latin'));
        $this->assertEquals('Bielaruś', Translit::object()->convert('Беларусь', 'be'));
        $this->assertEquals('Bielarus', Translit::object()->convert('Беларусь', 'be,latin'));
        $this->assertEquals('Konstantinos', Translit::object()->convert('Κωνσταντίνος', 'el,latin'));
        // test undefined language
        $this->assertEquals('мир', Translit::object()->convert('мир', 'cyr'));
        // and strict mode
        $this->expectException(\Exception::class);
        $this->assertEquals('мир', Translit::object()->convert('мир', '!cyr'));
    }
}
