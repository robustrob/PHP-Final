<?php

/**
 * @author  Xu Ding
 * @email   thedilab@gmail.com
 * @website http://www.StarTutorial.com
 **/
require_once '../BookingApp/core/Model.php';
require_once '../BookingApp/model/Preferences.php';
require_once '../BookingApp/model/Schedule.php';


class Calendar extends Model
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);

        $p = new Preferences();
        $this->maxSessions = $p->getMaxSessions();
    }

    /********************* PROPERTY ********************/
    private $maxSessions = 0;


    private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");

    private $currentYear = 0;

    private $currentMonth = 0;

    private $currentDay = 0;

    private $currentDate = null;

    private $daysInMonth = 0;

    private $naviHref = null;

    /********************* PUBLIC **********************/

    /**
     * print out the calendar
     */
    public function show()
    {
        $year = null;

        $month = null;

        if (null == $year && isset($_GET['year'])) {

            $year = $_GET['year'];

        } else if (null == $year) {

            $year = date("Y", time());

        }

        if (null == $month && isset($_GET['month'])) {

            $month = $_GET['month'];

        } else if (null == $month) {

            $month = date("m", time());

        }

        $this->currentYear = $year;

        $this->currentMonth = $month;

        $this->daysInMonth = $this->_daysInMonth($month, $year);

        $content = '<div id="calendar">' .
            '<div class="box">' .
            $this->_createNavi() .
            '</div>' .
            '<div class="box-content">' .
            '<ul class="label">' . $this->_createLabels() . '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '<ul class="dates">';

        $weeksInMonth = $this->_weeksInMonth($month, $year);
        // Create weeks in a month
        for ($i = 0; $i < $weeksInMonth; $i++) {

            //Create days in a week
            for ($j = 1; $j <= 7; $j++) {
                $cell = $i * 7 + $j;
                $day = $this->_getDay($cell);
                $date = $day . '-' . $month . '-' . $year;

                $content .= $this->_showDay($day, $cell, $date);

            }
        }

        $content .= '</ul>';

        $content .= '<div class="clear"></div>';

        $content .= '</div>';

        $content .= '</div>';
        return $content;
    }

    /********************* PRIVATE **********************/
    /**
     * create the li element for ul
     */
    private function _getDay($cellNumber)
    {

        if ($this->currentDay == 0) {

            $firstDayOfTheWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));

            if (intval($cellNumber) == intval($firstDayOfTheWeek)) {

                $this->currentDay = 1;

            }
        }

        if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {

            $this->currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));

            $cellContent = $this->currentDay;

            $this->currentDay++;

        } else {

            $this->currentDate = null;

            $cellContent = null;
        }


        return $cellContent;
    }

    //Function that returns the calendar <li>
    private function _showDay($day, $cellNumber, $date)
    {

        $datetime = strtotime($date);
        $today = strtotime("now");



        $status = "";
        $ref = '/booking/index/' . $date;
        if ($today >= $datetime || $day == 0) {
            $status = "block";
            $ref = "#";
        }
        else
        {
            $sessions = self::getSessions($date);

            $numOfSessions = count($sessions);

            if($numOfSessions == 0)
                $status = "available";
            else if($numOfSessions == $this->maxSessions)
                $status = 'booked';
            else if($numOfSessions > 0 && $numOfSessions < $this->maxSessions)
                $status = 'limited';

            $s = new Schedule();
            if(!$s->dayIsAvailable($date))
                $status = "block";


        }

        $link = ['start_tag'=>'<a href="' . $ref . '" >','end_tag' => '</a>'];

        if($status == 'block' || $status == 'booked')
        {
            $link['start_tag'] = "";
            $link['end_tag'] = "";
        }

        return $link['start_tag'].'<li id="li-' . $this->currentDate . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) .
        ($day == null ? 'mask' : '') . ' ' . $status . '">' . $day . '</li>'.$link['end_tag'];

    }

    private function getSessions($date)
    {
        $start = date ("Y-m-d H:i:s", strtotime($date));
        $end = date ("Y-m-d H:i:s", strtotime($date.' +1 day'));

        $st = $this->db->select("SELECT s_id, s_start, s_end FROM sessions WHERE s_start >= :s_start AND s_start < :s_end",['s_start' => $start, 's_end' => $end] , PDO::FETCH_ASSOC);

        return $st;
    }

    public function getSessionsVisual($date)
    {
        $sessions = self::getSessions($date);


        $sessionsVisual = "";

        foreach($sessions as $key => $s)
        {
            $sessionsVisual .= '<table class="session">
                                    <tr class="session-header"><td><h4>Session #'.($key+1).'</h4></td><td></td></tr>
                                    <tr>
                                        <td>Start: &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>'.date('H:i',strtotime($s['s_start'])).'</td>
                                    </tr>
                                    <tr>
                                        <td>End: &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>'.date('H:i',strtotime($s['s_end'])).'</td>
                                    </tr>
                                </table><br/><br/>';

        }

        return $sessionsVisual;
    }

    public function maxSessionsReached($date)
    {
        $sessions = self::getSessions($date);

        $pref = new Preferences();
        $max = $pref->getMaxSessions();

        if(count($sessions) == $max)
            return true;
        else
            return false;

    }


    /**
     * create navigation
     */
    private function _createNavi()
    {

        $nextMonth = $this->currentMonth == 12 ? 1 : intval($this->currentMonth) + 1;

        $nextYear = $this->currentMonth == 12 ? intval($this->currentYear) + 1 : $this->currentYear;

        $preMonth = $this->currentMonth == 1 ? 12 : intval($this->currentMonth) - 1;

        $preYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;

        return
            '<div class="header">' .
            '<a class="prev" href="' . $this->naviHref . '?month=' . sprintf('%02d', $preMonth) . '&year=' . $preYear . '">Prev</a>' .
            '<span class="title">' . date('Y M', strtotime($this->currentYear . '-' . $this->currentMonth . '-1')) . '</span>' .
            '<a class="next" href="' . $this->naviHref . '?month=' . sprintf("%02d", $nextMonth) . '&year=' . $nextYear . '">Next</a>' .
            '</div>';
    }

    /**
     * create calendar week labels
     */
    private function _createLabels()
    {

        $content = '';

        foreach ($this->dayLabels as $index => $label) {

            $content .= '<li class="' . ($label == 6 ? 'end title' : 'start title') . ' title">' . $label . '</li>';

        }

        return $content;
    }


    /**
     * calculate number of weeks in a particular month
     */
    private function _weeksInMonth($month = null, $year = null)
    {

        if (null == ($year)) {
            $year = date("Y", time());
        }

        if (null == ($month)) {
            $month = date("m", time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month, $year);

        $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);

        $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));

        $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));

        if ($monthEndingDay < $monthStartDay) {

            $numOfweeks++;

        }

        return $numOfweeks;
    }

    /**
     * calculate number of days in a particular month
     */
    private function _daysInMonth($month = null, $year = null)
    {

        if (null == ($year))
            $year = date("Y", time());

        if (null == ($month))
            $month = date("m", time());

        return date('t', strtotime($year . '-' . $month . '-01'));
    }

}
   