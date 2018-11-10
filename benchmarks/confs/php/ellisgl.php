<?php
return [
    'SomeStuff'   => [
        'a' => 'x',
        'b' => 'y',
        'c' => 'z',
        'x' => 'macrodmacro'
    ],
    'database'    => [
        'host' => 'localhost',
        'user' => 'ellisgl',
        'pass' => 'ellisglpass',
        'db'   => 'ellisgldb'
    ],
    'space Pants' => [
        'look at my' => 'space pants'
    ],
    'macrodmacro' => [
        'a' => '{%macrodmacro.{%somestuff.a%}%}',
        'b' => '{%{%somestuff.x%}.y%}',
        'c' => '{%{%somestuff.x%}.{%somestuff.c%}%}',
        'x' => 'We Can Do That!',
        'y' => 'And this!',
        'z' => 'This too!',
    ],
    'other.stuff' => [
        '.i.like.dots.period' => 'And that is a fact!',
        'multiline'           => 'This
is
a
multiline
value.'
    ]
];