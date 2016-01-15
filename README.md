Service can recognize ``postal_code``, ``city`` and ``address`` (rest of address line) from address provided by VIES service (http://ec.europa.eu/taxation_customs/vies/?locale=en).

Example results:
| IsoCode2 | Address | Output |
|---|---|---|
| GB | C/O BMW UK GROUPTAX FR-3-UK SUMMIT ONE SUMMIT AVENUE\nFARNBOROUGH\nGU14 0FB |   |
| GB  | 28-29 THE BROADWAY\nEALING\nLONDON\n\nW5 2NP | |
| GB  | 254 BANNERDALE ROAD\nSHEFFIELD\nS11 9FE | |

```


Array
(
    [city] => Warszawa
    [address] => Al. Jerzego Waszyngtona 45/51
    [code] => 04-008
)
```

```
R FIGUEIRAS N 616 MAIA 4475-011 MAIA

Array
(
    [city] => Maia
    [address] => R Figueiras N 616
    [code] => 4475-011
)
```

```
40, RUE ANTOINE MEYER L-2153  LUXEMBOURG

Array
(
    [city] => Luxembourg
    [address] => 40, Rue Antoine Meyer L-
    [code] => 2153
)
```

Więcej szczegółów oraz to jak używać klasy można zobaczyć uruchamiajać plik z przykładami:
```
php Examples/Example.php
```