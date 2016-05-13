<?php

require_once('src/Thirteen.php');

class ThirteenTest extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException InvalidArgumentException
     */
    public function test_second_date_should_be_after_first() {
        Thirteen::countDayOfWeekMatchesInRange(Thirteen::MONDAY, '1973-12-31', '1973-01-01');
    }

    public function test_Jan_1_1973_Was_A_Monday() {
        $this->assertEquals(1, Thirteen::countDayOfWeekMatchesInRange(Thirteen::MONDAY, '1973-01-01', '1973-01-01'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::TUESDAY, '1973-01-01', '1973-01-01'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::WEDNESDAY, '1973-01-01', '1973-01-01'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::THURSDAY, '1973-01-01', '1973-01-01'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::FRIDAY, '1973-01-01', '1973-01-01'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::SATURDAY, '1973-01-01', '1973-01-01'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::SUNDAY, '1973-01-01', '1973-01-01'));
    }

    public function test_First_Friday_The_Thirteenth_In_1973() {
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::MONDAY, '1973-04-13', '1973-04-13'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::TUESDAY, '1973-04-13', '1973-04-13'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::WEDNESDAY, '1973-04-13', '1973-04-13'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::THURSDAY, '1973-04-13', '1973-04-13'));
        $this->assertEquals(1, Thirteen::countDayOfWeekMatchesInRange(Thirteen::FRIDAY, '1973-04-13', '1973-04-13'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::SATURDAY, '1973-04-13', '1973-04-13'));
        $this->assertEquals(0, Thirteen::countDayOfWeekMatchesInRange(Thirteen::SUNDAY, '1973-04-13', '1973-04-13'));
    }

    public function test_Fridays_In_1973() {
        $this->assertEquals(52, Thirteen::countDayOfWeekMatchesInRange(Thirteen::FRIDAY, '1973-01-01', '1973-12-31'));
    }

    public function test_Two_Friday_The_13ths_In_1973() {
        $this->assertEquals(2, Thirteen::countDayOfMonthAndDayOfWeekMatchesInRange(Thirteen::FRIDAY, 13, '1973-01-01', '1973-12-31'));
    }

    public function test_Friday_The_13ths_In_40y() {
        $fridays = $this->count13thsOver40years(Thirteen::FRIDAY);
        $saturdays = $this->count13thsOver40years(Thirteen::SATURDAY);
        $sundays = $this->count13thsOver40years(Thirteen::SUNDAY);
        $mondays = $this->count13thsOver40years(Thirteen::MONDAY);
        $tuesdays = $this->count13thsOver40years(Thirteen::TUESDAY);
        $wednesdays = $this->count13thsOver40years(Thirteen::WEDNESDAY);
        $thursdays = $this->count13thsOver40years(Thirteen::THURSDAY);

        $this->assertTrue($tuesdays > $fridays);
        $this->assertTrue($tuesdays > $saturdays);
        $this->assertTrue($tuesdays > $sundays);
        $this->assertTrue($tuesdays > $mondays);
        $this->assertTrue($tuesdays > $wednesdays);
        $this->assertTrue($tuesdays > $thursdays);
    }

    public function test_Friday_The_13ths_In_116y() {
        $fridays = $this->count13thsOver116years(Thirteen::FRIDAY);
        $saturdays = $this->count13thsOver116years(Thirteen::SATURDAY);
        $sundays = $this->count13thsOver116years(Thirteen::SUNDAY);
        $mondays = $this->count13thsOver116years(Thirteen::MONDAY);
        $tuesdays = $this->count13thsOver116years(Thirteen::TUESDAY);
        $wednesdays = $this->count13thsOver116years(Thirteen::WEDNESDAY);
        $thursdays = $this->count13thsOver116years(Thirteen::THURSDAY);

        $this->assertTrue($fridays > $saturdays);
        $this->assertTrue($fridays > $sundays);
        $this->assertTrue($fridays > $mondays);
        $this->assertTrue($fridays > $tuesdays);
        $this->assertTrue($fridays > $wednesdays);
        $this->assertTrue($fridays > $thursdays);
    }

    public function test_Friday_The_13ths_Over_Many() {
        $fridays = $this->count13thsOverManyYears(Thirteen::FRIDAY);
        $saturdays = $this->count13thsOverManyYears(Thirteen::SATURDAY);
        $sundays = $this->count13thsOverManyYears(Thirteen::SUNDAY);
        $mondays = $this->count13thsOverManyYears(Thirteen::MONDAY);
        $tuesdays = $this->count13thsOverManyYears(Thirteen::TUESDAY);
        $wednesdays = $this->count13thsOverManyYears(Thirteen::WEDNESDAY);
        $thursdays = $this->count13thsOverManyYears(Thirteen::THURSDAY);

        $this->assertTrue($fridays > $saturdays);
        $this->assertTrue($fridays > $sundays);
        $this->assertTrue($fridays > $mondays);
        $this->assertTrue($fridays > $tuesdays);
        $this->assertTrue($fridays > $wednesdays);
        $this->assertTrue($fridays > $thursdays);
    }

    private function count13thsBetween($day, $start, $end) {
        return Thirteen::countDayOfMonthAndDayOfWeekMatchesInRange($day, 13, $start, $end);
    }

    private function count13thsOver40years($day) {
        return $this->count13thsBetween($day, '1973-01-01', '2013-12-31');
    }

    private function count13thsOver116years($day) {
        return $this->count13thsBetween($day, '1900-01-01', '2015-12-31');
    }

    private function count13thsOverManyYears($day) {
        return $this->count13thsBetween($day, '1900-01-01', '2999-12-31');
    }

}

