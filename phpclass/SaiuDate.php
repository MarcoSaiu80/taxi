<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SaiuDate
 *
 * @author Saiu
 * @CLASSE SAIUDATE 24/06/2014
 */
class SaiuDate {
    private $year="2000";
    private $month="01";
    private $day="01";
    private $minute="00";
    private $hour="00";
    private $second="00";
    //classe statica che converte le varie modalitÃ  di data
    //la data in formato Saiu Ã¨ generata con date(YmdHis)
    
    public function isFestivo()
    {
        $timestamp=mktime($this->getHour(),$this->getMinute(),$this->getSecond(),$this->getMonth(),$this->getDay(),$this->getYear());
        $g=date('w', $timestamp);
        if($g==0) 
            return true;
        return false;
    }




    public static function convertToGGMMAAAAHHmmSS($data) {    
        
    }
    
    public static function getNowAAAAMMGGHHmmSS()
    {
        SaiuDate::today();
    }

        public static function convertAAAAMMGGHHmmSSToClass($data) {
        $sd= new SaiuDate();
        $sd->setYear(substr($data,0,4));
        $sd->setMonth(substr($data,4,2));
        $sd->setDay(substr($data,6,2));
        $sd->setHour(substr($data,8,2));
        $sd->setMinute(substr($data,10,2));
        $sd->setSecond(substr($data,12,2));
        return $sd;
    }
    public static function convertAAAAMMGGHHmmSStoGG_MM_AAAA($data) {
        $t= new SaiuDate($data);
        return $t->printToGG_MM_AAAA();
    }
    
    public static function getClassFromGG_MM_AAAA($dataGG_MM_AAAA)
    {
        $class=new SaiuDate();
        $class->setDay(substr($dataGG_MM_AAAA, 0,2));
        $class->setMonth(substr($dataGG_MM_AAAA, 3,2));
        $class->setYear(substr($dataGG_MM_AAAA, 6,4));
        $class->setMinute('00');
        $class->setHour('00');
        $class->setSecond('00');
        return $class;
    }
    
    public static function getClassFromAAAA_MM_GG($dataAAAA_MM_GG)
    {
        $class=new SaiuDate();
        $class->setDay(substr($dataAAAA_MM_GG, 8,2));
        $class->setMonth(substr($dataAAAA_MM_GG, 5,2));
        $class->setYear(substr($dataAAAA_MM_GG, 0,4));
        $class->setMinute('00');
        $class->setHour('00');
        $class->setSecond('00');
        return $class;
    }
    
    
    public static function getAAAAMMGGfromAAAA_MM_GG($dataAAAA_MM_GG) {
        $d=SaiuDate::getClassFromAAAA_MM_GG($dataAAAA_MM_GG);
        return $d->toAAAAMMGGHHmmSS();
    }

    
    public static function today() {
        return "".date("YmdHis")."";
    }
    
    public static function getTimeHH_MM($dateAAAAGGMMHHMMSS)
    {
        $d= new SaiuDate($dateAAAAGGMMHHMMSS);
        return $d->getHour().":".$d->getMinute();
    }


    
    public static function addDay($data,$giorni) {
        $sd= new SaiuDate();
        $sd=SaiuDate::convertAAAAMMGGHHmmSSToClass($data);
        $stringaData=date("YmdHis",mktime($sd->getHour(),$sd->getMinute(),$sd->getSecond(),$sd->getMonth(),$sd->getDay()+$giorni,$sd->getYear()));
        return $stringaData;
    }
    public static function isADate($data) {
            if((strlen($data)==14 && is_numeric($data)) || (strlen($data)==10 && is_numeric(substr($data, 6,4)) && is_numeric(substr($data, 0,2)) && is_numeric(substr($data, 3,2)) ))
                    return true;
            return false;
        
    }
    public function printToGG_MM_AAAA()
    {
        return "".$this->getDay()."/".$this->getMonth()."/".$this->getYear();
    }


    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function getMonth() {
        return $this->month;
    }

    public function setMonth($month) {
        $this->month = $month;
    }

    public function getDay() {
        return $this->day;
    }

    public function setDay($day) {
        $this->day = $day;
    }

    public function getMinute() {
        return $this->minute;
    }

    public function setMinute($minute) {
        $this->minute = $minute;
    }

    public function getHour() {
        return $this->hour;
    }

    public function setHour($hour) {
        $this->hour = $hour;
    }

    public function getSecond() {
        return $this->second;
    }

    public function setSecond($second) {
        $this->second = $second;
    }

    public static function getDifferenceBetween2Days($day1,$day2)
    {
        $s1= new SaiuDate();
        $s2= new SaiuDate();
        $s1= SaiuDate::convertAAAAMMGGHHmmSSToClass($day1);
        $s2= SaiuDate::convertAAAAMMGGHHmmSSToClass($day2);
        $giorniDifferenza=mktime($s1->getHour(),$s1->getMinute(),$s1->getSecond(),$s1->getMonth(),$s1->getDay(),$s1->getYear()) - mktime($s2->getHour(),$s2->getMinute(),$s2->getSecond(),$s2->getMonth(),$s2->getDay(),$s2->getYear());
        return $giorniDifferenza/ 60 / 60 / 24;
        
    }
    
    public function toAAAAMMGGHHmmSS() {
        return "".$this->getYear().$this->getMonth().$this->getDay().$this->getHour().$this->getMinute().$this->getSecond();
    }
    
    function __construct($data="") {
        if($data!="")
        {
        
        $this->setYear(substr($data,0,4));
        $this->setMonth(substr($data,4,2));
        $this->setDay(substr($data,6,2));
        $this->setHour(substr($data,8,2));
        $this->setMinute(substr($data,10,2));
        $this->setSecond(substr($data,12,2));
        }
        
    }
    
    public function getNomeMese()
    {
        switch ($this->getMonth())
        {
             case 1:
                return "Gennaio";
                break;
             case 2:
                return "Febbraio";
                break;
             case 3:
                return "Marzo";
                break;
             case 4:
                return "Aprile";
                break;
             case 5:
                return "Maggio";
                break;
             case 6:
                return "Giugno";
                break;
             case 7:
                return "Luglio";
                break;
             case 8:
                return "Agosto";
                break;
             case 9:
                return "Settembre";
                break;
            case 10:
                return "Ottobre";
                break;
            case 11:
                return "Novembre";
                break;
            case 10:
                return "Dicembre";
                break;
        }
    }
    public function getNomeGiorno()
    {
        $timestamp=mktime($this->getHour(),$this->getMinute(),$this->getSecond(),$this->getMonth(),$this->getDay(),$this->getYear());
        $g=date('w', $timestamp);
        switch($g)
        {
            case 0:
                return "domenica";
                break;
            case 1:
                return "lunedi";
                break;
            case 2:
                return "martedi";
                break;
            case 3:
                return "mercoledi";
                break;
            case 4:
                return "giovedi";
                break;
            case 5:
                return "venerdi";
                break;
            case 6:
                return "sabato";
                break;
            
        }
        
    
    }
    public static function getNameOfDayNumber($g) {
          switch($g)
        {
            case 0:
                return "domenica";
                break;
            case 1:
                return "lunedi";
                break;
            case 2:
                return "martedi";
                break;
            case 3:
                return "mercoledi";
                break;
            case 4:
                return "giovedi";
                break;
            case 5:
                return "venerdi";
                break;
            case 6:
                return "sabato";
                break;
            
        }
        
    }
    
    public function getNomeGiorno3()
    {
        return substr($this->getNomeGiorno(),0,3);
    }
    
    public function getNomeMese3()
    {
        return substr($this->getNomeMese(),0,3);
    }
    
}