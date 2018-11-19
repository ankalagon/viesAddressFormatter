<?php

namespace Ankalagon\ViesAddressFormatter;

/**
 * Class ViesObjectFormatter
 * @package Ankalagon\ViesAddressFormatter
 */
class ViesObjectFormatter
{
    /**
     * @var string Iso code to recognize
     */
    private $isoCode = '';

    /**
     * @var array   definitions of countries
     */
    private $allDefinitions = [];

    /**
     * @var array   actual definition for selected country
     */
    private $definition = [];

    /**
     * @param string $isoCode
     * @throws \Exception
     */
    public function __construct($isoCode)
    {
        $this->setIsoCode($isoCode);
    }

    /**
     * Zmienia iso code jeśli obiekt jest już stworzony
     * @param $isoCode
     * @throws \Exception
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = trim($isoCode);

        if (strlen($this->isoCode) != 2) {
            throw new \Exception('IsoCode required to initialize '.__METHOD__.' object');
        }

        $this->setDefinition();
    }

    /**
     * Pobiera finalne dane
     * @param $addressLine
     * @return array
     */
    public function getFormatedData($addressLine)
    {
        $finalResult = array();
        $city = $code = '';

        $address = $addressLine;

        if (is_array($this->definition)) {
            foreach ($this->definition as $pattern) {
                $pattern = '/('.$pattern.')(.*)/ism';

                if ($this->isoCode == 'GB' && strpos($addressLine, "\n") !== false) {
                    foreach (explode("\n", $addressLine) as $row) {
                        preg_match($pattern, $row, $result);

                        if ($result == false && $row) {
                            $city = $row;
                        } else {
                            $result[2] = $city;
                        }
                    }
                } else {
                    preg_match($pattern, $addressLine, $result);
                }

                if ($result) {
                    if ($finalResult == false || strlen($result[1]) > strlen($finalResult[1])) {
                        $finalResult = $result;
                        $cityPosition = substr_count($pattern,'(');
                        $city = $result[$cityPosition];

                        $address = str_replace(array($city, $result[1]), '', $addressLine);
                        $address = str_replace("\n", ' ', $address);

                        $code = $result[1];
                    }
                }
            }
        }

        return array(
            'city'        => $this->format($city),
            'postal_code' => trim($code),
            'address'     => $this->format($address),
        );
    }

    private function setDefinition()
    {
        if ($this->allDefinitions == false) {
            $definitions = json_decode(file_get_contents(__DIR__.'/postalcodes.json'), true);
            foreach ($definitions as $definition) {
                //can be multiple definitions for one country
                $definition['Regex'] = trim($definition['Regex'], ' ^$');
                $this->allDefinitions[$definition['ISO']][] = $definition['Regex'];
            }
        }

        if (isset($this->allDefinitions[$this->isoCode])) {
            $this->definition = $this->allDefinitions[$this->isoCode];
        } else {
            $this->definition = false;
            syslog(LOG_WARNING, '[FM\AddressFormatter] not recognize country, isocode = "'.$this->isoCode.'"');
        }
    }

    private function format($string)
    {
        return trim(ucwords(mb_strtolower($string, 'UTF-8')));
    }
}