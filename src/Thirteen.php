<?php

class Thirteen {

    const SUNDAY    = 0;
    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;

    private $start;
    private $end;
    private $interval;

    public static function countDayOfWeekMatchesInRange($day, $startDate, $endDate) {
        $thirteen = new Thirteen($startDate, $endDate);
        return $thirteen->countDayOfWeekMatches($day);
    }

    public static function countDayOfMonthAndDayOfWeekMatchesInRange($weekday, $monthday, $startDate, $endDate) {
        $thirteen = new Thirteen($startDate, $endDate);
        return $thirteen->countDayOfMonthAndDayOfWeekMatches($weekday, $monthday);
    }

    private function __construct($startDate, $endDate) {
        $this->setRange($startDate, $endDate);
        $this->interval = DateInterval::createFromDateString('1 day');
    }

    private function countDayOfWeekMatches($day) {
        $count = 0;
        foreach($this->rangeInterator() as $date)
            if ($this->matchesDayOfWeek($day, $date))
                $count++;

        return $count;
    }

    private function countDayOfMonthAndDayOfWeekMatches($weekday, $monthday) {
        $count = 0;
        foreach($this->rangeInterator() as $date)
            if ($this->matchesDayOfWeek($weekday, $date) && $this->matchesDayOfMonth($monthday, $date))
                $count++;

        return $count;
    }

    private function matchesDayOfWeek($dow, $date) {
        return $dow == $date->format('w');
    }

    private function matchesDayOfMonth($monthday, $date) {
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
