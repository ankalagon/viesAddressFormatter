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
    private $_isoCode = '';

    /**
     * @var array   definitions of countries
     */
    private $_allDefinitions = '';

    /**
     * @var array   actual definition for selected country
     */
    private $_definition = '';

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
        $this->_isoCode = trim($isoCode);

        if (strlen($this->_isoCode) != 2) {
            throw new \Exception('IsoCode required to initialize '.__METHOD__.' object');
        }

        $this->_setDefinition();
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

        if (is_array($this->_definition)) {
            foreach ($this->_definition as $pattern) {
                $pattern = '/('.$pattern.')(.*)/ism';

                if ($this->_isoCode == 'GB' && strpos($addressLine, "\n") !== false) {
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
            'city'        => $this->_format($city),
            'postal_code' => trim($code),
            'address'     => $this->_format($address),
        );
    }

    private function _setDefinition()
    {
        if ($this->_allDefinitions == false) {
            $definitions = json_decode(file_get_contents(__DIR__.'/postalcodes.json'), true);
            foreach ($definitions as $definition) {
                //can be multiple definitions for one country
                $definition['Regex'] = trim($definition['Regex'], ' ^$');
                $this->_allDefinitions[$definition['ISO']][] = $definition['Regex'];
            }
        }

        if (isset($this->_allDefinitions[$this->_isoCode])) {
            $this->_definition = $this->_allDefinitions[$this->_isoCode];
        } else {
            $this->_definition = false;
            syslog(LOG_WARNING, '[FM\AddressFormatter] not recognize country, isocode = "'.$this->_isoCode.'"');
        }
    }

    private function _format($string)
    {
        return trim(ucwords(mb_strtolower($string, 'UTF-8')));
    }
}