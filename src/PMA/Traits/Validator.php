<?php

namespace PMA\Traits;

use InvalidArgumentException;

trait Validator
{
    private function guardAgainstInvalidAttn($attn)
    {
        if (strlen($attn) > 35)
            throw new InvalidArgumentException('ATTN is longer then the allowed length of 35.');
    }

    private function guardAgainstInvalidFirstName($first_name)
    {
        if (strlen($first_name) > 35)
            throw new InvalidArgumentException('First Name is longer then the allowed length of 35.');
    }

    private function guardAgainstInvalidLastName($last_name)
    {
        if (strlen($last_name) > 35)
            throw new InvalidArgumentException('Last Name is longer then the allowed length of 35.');
    }

    private function guardAgainstInvalidAddressOne($address_one)
    {
        if (strlen($address_one) > 35)
            throw new InvalidArgumentException('Address One is longer then the allowed length of 35.');
    }

    private function guardAgainstInvalidAddressTwo($address_two)
    {
        if (strlen($address_two) > 35)
            throw new InvalidArgumentException('Address Two is longer then the allowed length of 35.');
    }

    private function guardAgainstInvalidCity($city)
    {
        if (strlen($city) > 25)
            throw new InvalidArgumentException('City is longer then the allowed length of 25.');
    }

    private function guardAgainstInvalidState($state)
    {
        if ($this->isInvalidState($state))
            throw new InvalidArgumentException('Invalid state provided.');
    }

    private function isInvalidState($state)
    {
        if ($this->isValidState($state) === false)
            return true;
        return false;
    }

    private function isValidState($state)
    {
        $states = [
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AS' => 'American Samoa',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District of Columbia',
            'FM' => 'Federated States of Micronesia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'GU' => 'Guam',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MH' => 'Marshall Islands',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'MP' => 'Northern Mariana Islands',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PW' => 'Palau',
            'PA' => 'Pennsylvania',
            'PR' => 'Puerto Rico',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VI' => 'Virgin Islands',

            // US Postal Abbreviations for military addresses
            'AE' => 'Armed Forces',
            'AA' => 'Armed Forces Americas',
            'AP' => 'Armed Forces Pacific',

            // Canadian Provinces and Territories
            'AB' => 'Alberta',
            'BC' => 'British Columbia',
            'MB' => 'Manitoba',
            'NB' => 'New Brunswick',
            'NL' => 'Newfoundland and Labrador',
            'NT' => 'Northwest Territories',
            'NS' => 'Nova Scotia',
            'NU' => 'Nunavut',
            'ON' => 'Ontario',
            'PE' => 'Prince Edward Island',
            'QC' => 'Quebec',
            'SK' => 'Saskatchewan',
            'YT' => 'Yukon Territory',

            // Mexico
            'AG' => 'Aguascalientes',
            'BN' => 'Baja California',
            'BS' => 'Baja California Sur',
            'CM' => 'Campeche',
            'CP' => 'Chiapas',
            'CH' => 'Chihuahua',
            'CA' => 'Coahuila',
            'CL' => 'Colima',
            'DF' => 'Federal District',
            'DU' => 'Durango',
            'GT' => 'Guanajuato',
            'GR' => 'Guerrero',
            'HI' => 'Hidalgo',
            'JA' => 'Jalisco',
            'MX' => 'Mexico State',
            'MC' => 'Michoacán',
            'MR' => 'Morelos',
            'NA' => 'Nayarit',
            'NL' => 'Nuevo León',
            'OA' => 'Oaxaca',
            'PU' => 'Puebla',
            'QE' => 'Querétaro',
            'QR' => 'Quintana Roo',
            'SL' => 'San Luis Potosí',
            'SI' => 'Sinaloa',
            'SO' => 'Sonora',
            'TB' => 'Tabasco',
            'TM' => 'Tamaulipas',
            'TL' => 'Tlaxcala',
            'VE' => 'Veracruz',
            'YU' => 'Yucatán',
            'ZA' => 'Zacatecas',
        ];

        if (array_key_exists($state, $states))
            return true;
        return false;
    }

    private function guardAgainstInvalidZipCode($zip)
    {
        if ($this->isNotValidZip($zip))
            throw new InvalidArgumentException('Invalid zip code provided.');
    }

    private function isNotValidZip($zip)
    {
        return !$this->isValidZip($zip);
    }

    public function isValidZip($zip)
    {
        return preg_match('/^(\d{5}-\d{4}\b|\d{5,6}\b|\d{3,4}\s\d{3}\b|\w{3,4}\s\w{3})$/', $zip);
    }

    private function guardAgainstInvalidCountry($country)
    {
        if ($this->isNotValidCountry($country))
            throw new InvalidArgumentException('Invalid country code provided.');
    }

    private function isNotValidCountry($country)
    {
        return !$this->isValidCountry($country);
    }

    private function isValidCountry($country)
    {
        return preg_match('/^([A-Z]{3})$/', $country);
    }

    private function guardAgainstInvalidPhoneNumber($phone_number)
    {
        if ($this->isNotValidPhoneNumber($phone_number))
            throw new InvalidArgumentException('Invalid phone number entered. Must be all numeric.');
    }

    private function isNotValidPhoneNumber($phone_number)
    {
        return !$this->isValidPhoneNumber($phone_number);
    }

    private function isValidPhoneNumber($phone_number)
    {
        return preg_match('/^([0-9]{10,20})$/', $phone_number);
    }

    private function guardAgainstInvalidAddressType($address_type)
    {
        if ($this->isNotValidAddressType($address_type))
            throw new InvalidArgumentException('Invalid address type provided. Available options are RESIDENTIAL and COMMERCIAL.');
    }

    private function isNotValidAddressType($address_type)
    {
        return !$this->isValidAddressType($address_type);
    }

    private function isValidAddressType($address_type)
    {
        return in_array($address_type, ['RESIDENTIAL', 'COMMERCIAL'], true);
    }
}
