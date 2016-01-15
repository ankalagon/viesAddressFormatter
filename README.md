Serwis do formatowania adresów pobranych z VIES'ia, problemem jest to że często są w jednej linii i są za długie. Ta klasa próbuje sobie z tym poradzić.

W wyniku dostajemy tablicę z podziałem na ``city``, ``address`` oraz ``code`` np:

```
AL. JERZEGO WASZYNGTONA 45/51 04-008 WARSZAWA

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