<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 17.09.2017
 * Time: 09:52
 */

namespace AppBundle\Service;


class Dates 
{

    /** @var \Datetime **/
    private $year;

    /** @var integer **/
    private $day_of_the_week;

    /** @var string **/
    private $date_format;

    /** @var array */
    private $odd;

    /** @var array */
    private $even;

    /** @var bool */
    private $mode;

    public function init($year,int $day,string $format,bool $mode)
    {
        $dayMonthYear = new \DateTime("{$year}-01-01");
        $this->setYear($dayMonthYear);
        $this->setDayOfTheWeek($day);
        $this->setDateFormat($format);
        $this->setMode($mode);
    }
    
    private function setDateFormat(string $format)
    {
        $this->date_format = $format;
    }

    private function setYear(\DateTime $year)
    {
        $this->year = $year;
    }

    private function setDayOfTheWeek(int $day)
    {
        $this->day_of_the_week = $day;
    }

    /**
     * @return \Datetime
     */
    private function getYear()
    {
        return $this->year;
    }

    /**
     * @return int
     */
    private function getDayOfTheWeek()
    {
        return $this->day_of_the_week;
    }

    private function setOdd(array $odd)
    {
        $this->odd = $odd;
    }
    private function setEven(array $even)
    {
        $this->even = $even;
    }

    public function getDaysFromYear()
    {
        $start_date = new \DateTime($this->getYear()->format('Y')."-01-01");
        $end_date = new \DateTime($this->getYear()->format('Y')."-12-31");

        $dates = [];
        for ($date = clone $start_date;$date<$end_date;$date->modify("+1 day")){
            switch ($date->format("w")) {
                case $this->getDayOfTheWeek():
                    if ($this->getMode()) {
                        if ($date->format('d') % 2 == 0) {
                            $dates[] = $date->format($this->getDateFormat());
                        }
                    }else{
                        if ($date->format('d') % 2 != 0) {
                            $dates[] = $date->format($this->getDateFormat());
                        }
                    }
                    break;
            }
        }

        if ($this->getMode()){
            $this->setEven($dates);
        }else{
            $this->setOdd($dates);
        }

        return $this;
    }

    public function getResults()
    {
        if (!is_null($this->getOdd())){
            $dates = $this->getOdd();
        }else{
            $dates = $this->getEven();
        }

        return $dates;
    }

    /**
     * @return array
     */
    public function getOdd()
    {
        return $this->odd;
    }

    /**
     * @return array
     */
    public function getEven()
    {
        return $this->even;
    }

    /**
     * @return bool
     */
    private function getMode()
    {
        return $this->mode;
    }

    /**
     * @param bool $mode
     */
    private function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return string
     */
    private function getDateFormat()
    {
        return $this->date_format;
    }

    
}