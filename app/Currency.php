<?php


namespace App;


use DateTime;
use Exception;
use SimpleXMLElement;

class Currency
{

    private $error;

    private $dollar;
    private $dollarBefore;
    private $euro;
    private $euroBefore;

    private $date;
    private $dateBefore;

    private const DOLLAR_ID = 'R01235';
    private const EURO_ID = 'R01239';

    public function __construct()
    {
        $this->error = '';

        try {
            $this->APIConnection();
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }

    }

    public function getDollarBefore()
    {
        return $this->dollarBefore;
    }

    public function getDollar()
    {
        return $this->dollar;
    }

    public function getEuroBefore()
    {
        return $this->euroBefore;
    }

    public function getEuro()
    {
        return $this->euro;
    }

    public function getDateBefore()
    {
        return $this->dateBefore;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function hasError()
    {
        return $this->error;
    }

    private function APIConnection()
    {
        $dataDollar = $this->getInfoByValute(self::DOLLAR_ID);
        $dataEuro = $this->getInfoByValute(self::EURO_ID);

        $this->dateBefore = $dataDollar[2];
        $this->date = $dataDollar[3];

        $this->dollarBefore = $dataDollar[0];
        $this->dollar = $dataDollar[1];

        $this->euroBefore = $dataEuro[0];
        $this->euro = $dataEuro[1];

    }


    private function getInfoByValute($valuteId)
    {
        $dateBeforeSlash = date('d/m/Y', strtotime("-15 days"));;
        $dateSlash = date('d/m/Y', strtotime("+7 days"));;

        $urlDynamic = "http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=$dateBeforeSlash&date_req2=$dateSlash&VAL_NM_RQ=" . $valuteId;

        $xmlString = file_get_contents($urlDynamic);
        $xml = new SimpleXMLElement($xmlString);

        $dateBefore = 0;
        $date = 0;

        $i = 0;
        foreach ($xml->Record as $key => $record) {

            if ($i == $xml->Record->count() - 2) {
                foreach ($record->attributes() as $name => $attr) {
                    if ($name == 'Date') {
                        $dateBefore = $attr->__toString();
                    }
                }
            }

            if ($i == $xml->Record->count() - 1) {
                foreach ($record->attributes() as $name => $attr) {
                    if ($name == 'Date') {
                        $date = $attr->__toString();
                    }
                }
            }

            $i++;
        }

        $valueBefore = 0;
        $value = 0;

        foreach ($xml->Record as $key => $record) {

            foreach ($record->attributes() as $name => $attr) {
                if ($name == 'Date') {
                    if ($attr == $dateBefore) {
                        $valueBefore = $record->Value->__toString();
                    }
                    if ($attr == $date) {
                        $value = $record->Value->__toString();
                    }
                }
            }

        }

        return [$valueBefore, $value, $dateBefore, $date];

    }

}