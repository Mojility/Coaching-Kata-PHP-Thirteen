<?php

class Thirteen {

    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;
    const SUNDAY    = 0;

    private $start;
    private $end;
    private $interval;

    public static function countAllInRange($day, $startDate, $endDate) {
        $thirteen = new Thirteen($startDate, $endDate);
        return $thirteen->countAll($day);
    }

    public static function countAllWithDayOfMonthInRange($weekday, $monthday, $startDate, $endDate) {
        $thirteen = new Thirteen($startDate, $endDate);
        return $thirteen->countDayOfMonthInRange($weekday, $monthday);
    }

    private function __construct($startDate, $endDate) {
        $this->setRange($startDate, $endDate);
        $this->interval = DateInterval::createFromDateString('1 day');
    }

    private function countAll($day) {
        $count = 0;
        foreach($this->rangeInterator() as $date)
            if ($this->weekdayMatch($day, $date))
                $count++;

        return $count;
    }

    private function countDayOfMonthInRange($weekday, $monthday) {
        $count = 0;
        foreach($this->rangeInterator() as $date)
            if ($this->weekdayMatch($weekday, $date) && $this->monthdayMatch($monthday, $date))
                $count++;

        return $count;
    }

    private function weekdayMatch($dow, $date) {
        return $dow == $date->format('w');
    }

    private function monthdayMatch($monthday, $date) {
        return $monthday == $date->format('j');
    }

    private function setRange($startDate, $endDate) {
        $this->start = new DateTime($startDate);
        $this->end   = new DateTime($endDate);
        if ($this->start > $this->end) throw new InvalidArgumentException();
    }

    private function rangeInterator() {
        $iterator = new DatePeriod($this->start, $this->interval, $this->end->modify('+1 day'));
        return $iterator;
    }

}
