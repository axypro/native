# `Strings`

The class `axy\native\Strings` provides string functions.

## Internat encoding

By default, the library works with UTF-8.
This can be changed.

* `setInternalEncoding(string $encoding):void`
* `getInternalEncoding(void):string`

## Common

##### `length(string $string):int`

Returns the length of the string

##### `isNotEmpty(string $string):bool`

Checks if the string is not empty.
Unlike the native `empty()` string `0` is not considering empty.
 
```php
Strings::isNotEmpty('String'); // TRUE
Strings::isNotEmpty('0'); // TRUE
Strings::isNotEmpty(''); // FALSE
```

##### `convertEncoding(string $string [, string $to [, string $from]):string`

Converts the string `$string` from `$from` encoding to `$to` encoding.
By default for `$to` and `$from` used the internal encoding.

## Search in string

All of these methods are looking for a substring (`$needle`) in a string (`$haystack`).
These methods taking an argument `$offset` which specify an offset in `$haystack` to begin searching 
(by default it is the begin of the string).
These methods have two form: case sensitive and case insensitive (has a prefix `i`).

##### `pos(string $haystack, string $needle [, int $offset]):int|FALSE` and `ipos()`

Returns the position of first occurrence of the needle in the haystack.
Counting starts at zero.
If the needle was not found it returns `FALSE`. 

```php
Strings::pos('One, Two, Three, One, Two', 'One'); // 0
Strings::pos('One, Two, Three, One, Two', 'One', 10); // 17 (offset)
Strings::pos('One, Two, Three, One, Two', 'two'); // FALSE
Strings::ipos('One, Two, Three, One, Two', 'two'); // 5 (case insensitive)
```

##### `contains(string $haystack, string $needle [, int $offset]):bool` and `icontains()`

Checks if the haystack contains the needle.
Returns `TRUE` if the needle is in the haystack and `FALSE` if no.

```php
Strings::contains('One, Two, Three', 'One'); // TRUE
Strings::contains('One, Two, Three', 'Two'); // TRUE
Strings::contains('One, Two, Three', 'Four'); // FALSE
Strings::contains('One, Two, Three', 'One', 10); // FALSE
Strings::contains('One, Two, Three', 'two'); // FALSE
Strings::icontains('One, Two, Three', 'two'); // TRUE
```

##### `begins(string $haystack, string $needle [, int $offset]):bool` and `ibegins()`

Checks if the haystack begins with the needle.

```php
Strings::begins('One, Two, Three', 'One'); // TRUE
Strings::begins('One, Two, Three', 'Two'); // FALSE
Strings::begins('One, Two, Three', 'Two', 4); // TRUE
Strings::begins('One, Two, Three', 'one'); // FALSE
Strings::ibegins('One, Two, Three', 'one'); // FALSE
```
## Changing case

##### `toLowerCase(string $string):string`

Makes a string lowercase.

```php
Strings::toLowerCase('This is string. It is not array.'); // this is string. it is not array.
```

##### `toUpperCase(string $string):string`

Makes a string uppercase.

```php
Strings::toUpperCase('This is string. It is not array.'); // THIS IS STRING. IT IS NOT ARRAY.
```

##### `firstToUpperCase(string $string):string`

Makes a string's first character uppercase.

```php
Strings::firstToUpperCase('this is string. it is not array.'); // This is string. it is not array.
```

##### `wordsToUpperCase(string $string):string`

Makes the first character of each word uppercase (and lowercase for other).

```php
Strings::wordsToUpperCase('This is STRING. It is not ARRAY.'); // This Is String. It Is Not Array.
```

## Unicode code

##### `ord(string $char):int`

Returns an unicode code of a character.
Unlike the built-in `ord()` it work with multibyte encodings.

```php
Strings::ord('A'); // 65
ord('A');          // 65, ASCII ok
Strings::ord('й'); // 1081 (Unicode symbol 0439 in hex)
ord('й');          // 208 (FAIL)
```

##### `chr(int $code):string`

Returns a character by an unicode code.
Unlike the built-in `chr()` it work with multibyte encodings.

```php
Strings::chr(65);   // A
chr(65);            // A, ASCII ok
Strings::chr(1081); // й (Unicode symbol 0439 in hex)
chr(1081);          // 9 (FAIL)
```

## Format

##### `html(string $plain [, string $nl = FALSE]):string`

Converts a plain text to a html code.
Converts special characters to HTML-entities.

If argument `$nl` is specified as `TRUE` then line breaks replaced by `<br>`. 

## Cut

##### `sub($string, $start [, $length]):string`

Returns a part of the string.

```php
Strings::sub('this is string', 3, 6); // s is s
Strings::sub('this is string', 3); // s is string (to the end of the string)
Strings::sub('this is string', 0); // this is string (from the begin to the end)
Strings::sub('this is string', -3, 5); // ing (starting with 3rd character from the end)
Strings::sub('this is string', 3, -3); // s is str (to 3rd characted from the end)
```

##### `cut(string $string, int $maxLength [, array $options]):string`

Cuts a string.
To display short texts, etc.

If the string length less than `$maxLength` the string is not cut:

```php
Strings::cut('This is long text', 100); // This is long text
```

If the string length greater than max length the string is cut and added "...":
 
```php
echo Strings::cut('This is long text', 10); // This is... (in total 10)
```

The array `$options` can contain the following fields:

* `end`
* `endSingle`
* `sep`
* `maxCut`

`end` is the end of the string (by default "...").
`endSingle` indicates that `end` should be consider as a single character. 

```php
$options = ['end' => '&hellip;'];
Strings::cut('This is long text', 15, $options); // This is&hellip;

$options['endSingle'] = true;
Strings::cut('This is long text', 15, $options); // This is long t&hellip;
```

`$sep` and `$maxCut` are used to track the cut line within a word.

Cutting the default may be ugly:
```php
Strings::cut('This is long text', 13); // This is lo...
```

`$sep` is regexp for cut the end.
If specified `TRUE` used `/\s*\p{L}+$/u`: cut between words:

```php
$options = ['sep' => true];
Strings::cut('This is long text', 13, $options); // This is...
```

`maxCut` - maximum cut for $sep-search.
Not to trim too much.
By default `min[10, half length]`.

```php
$options = ['sep' => true];
$string = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
Strings::cut($string, 13, $options); // aaaaaa...
```
