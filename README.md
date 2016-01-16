Service can recognize ``postal_code``, ``city`` and ``address`` (rest of address line) from address provided by VIES service (http://ec.europa.eu/taxation_customs/vies/?locale=en).

Requirements
------------

* PHP5.3

Installation
------------

Update your composer.json and run `composer update`

``` json
{
    "require": {
        "ankalagon/vies-address-formatter": "dev-master"
    }
}
```

or execute

``` bash
composer require ankalagon/vies-address-formatter
```

Usage
------------

``` php
    use Ankalagon\ViesAddressFormatter\ViesFormatter;

    $result = ViesFormatter::recognize("GB", "254 BANNERDALE ROAD<br>SHEFFIELD<br>S11 9FE");

    print_r($result);
```

the above example will produce the following output:

``` php
Array (
    [city] => Sheffield
    [postal_code] => S11 9FE
    [address] => 254 Bannerdale Road
)
```

Example address line recognizion:
------------

| Iso Code  | Address line | Return data |
| ------------- | ------------- | ------------- |
| GB | C/O BMW UK GROUPTAX FR-3-UK SUMMIT ONE SUMMIT AVENUE<br>FARNBOROUGH<br>GU14 0FB | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Farnborough<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => GU14 0FB<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => C/o Bmw Uk Grouptax Fr-3-uk Summit One Summit Avenue<br>)<br> |
| GB | 28-29 THE BROADWAY<br>EALING<br>LONDON<br><br>W5 2NP | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => London<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => W5 2NP<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => 28-29 The Broadway Ealing<br>)<br> |
| GB | 10 THE GRANGEWAY<br>GRANGE PARK<br>LONDON<br>N21 2HA | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => London<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => N21 2HA<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => 10 The Grangeway Grange Park<br>)<br> |
| GB | 254 BANNERDALE ROAD<br>SHEFFIELD<br>S11 9FE | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Sheffield<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => S11 9FE<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => 254 Bannerdale Road<br>)<br> |
| PT | R FIGUEIRAS N 616 MAIA<br>4475-011<br>MAIA | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Maia<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 4475-011<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => R Figueiras N 616 Maia<br>)<br> |
| LU | 40, RUE ANTOINE MEYER L-2153  LUXEMBOURG | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Luxembourg<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => L-2153<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => 40, Rue Antoine Meyer<br>)<br> |
| NL |  EEKHORSTWEG 00031 A 7942KC MEPPEL  | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Meppel<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 7942KC<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => Eekhorstweg 00031 A<br>)<br> |
| BE | EZELSTRAAT 69 1 8000  BRUGGE | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Brugge<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 8000<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => Ezelstraat 69 1<br>)<br> |
| IT | P.ZA FERRAVILLA N. 2  20092 CINISELLO BALSAMO MI  | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Cinisello Balsamo Mi<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 20092<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => P.za Ferravilla N. 2<br>)<br> |
| BG | ул. Самуиловско шосе  №1А обл.СЛИВЕН, гр.СЛИВЕН 8800 | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => <br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 8800<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => ул. самуиловско шосе  №1а обл.сливен, гр.сливен<br>)<br> |
| AT | Herrengasse 44<br>7471 Rechnitz | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Rechnitz<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 7471<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => Herrengasse 44<br>)<br> |
| NO | Setesdalsveien 76<br>4617 KRISTIANSAND S | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Kristiansand S<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 4617<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => Setesdalsveien 76<br>)<br> |
| PL | KORNELA UJEJSKIEGO 12 M7<br>30-102 KRAKÓW | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Kraków<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 30-102<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => Kornela Ujejskiego 12 M7<br>)<br> |
| PL | AL. 29 LISTOPADA 155C<br>31-406 KRAKów | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Kraków<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 31-406<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => Al. 29 Listopada 155c<br>)<br> |
| PL | AL. JERZEGO WASZYNGTONA 45/51<br>04-008 WARSZAWA | Array (<br>    &nbsp;&nbsp;&nbsp;&nbsp;[city] => Warszawa<br>    &nbsp;&nbsp;&nbsp;&nbsp;[postal_code] => 04-008<br>    &nbsp;&nbsp;&nbsp;&nbsp;[address] => Al. Jerzego Waszyngtona 45/51<br>)<br> |
