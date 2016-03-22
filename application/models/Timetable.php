<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TimeTable extends CI_Model {

    protected $xml = null;
    protected $course = array();
    protected $dayOfWeek = array();
    protected $period = array();

    function __construct() {
        parent::_construct();
        $this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');

        // build a full list of courses
        foreach ($this->xml->courses->course as $course) {
            $record = new stdClass();
            $record->code = (string) $course['code'];
            $record->name = (string) $course;
            $this->couse[$record->code] = $record;
            //$this->course_name[(string) $course[course_num]] = (string) $course;
        }

        // build a full list of days
        foreach ($this->xml->days->day as $day) {
            $record = new stdClass();
            $record->code = (string) $day['code'];
            $record->name = (string) $day;
            $this->days[$record->code] = $record;
        }

        // build a full list of period
        foreach ($this->xml->periods->preiod as $period) {
            $record = new stdClass();
            $record->code = (string) $period['code'];
            $record->time = (string) $period;
            $this->days[$record->code] = $record;
        }

        // retrieve a list of courses, to populate a dropdown, for instance
        function course() {
            return $this->course;
        }

        // retrieve a course record
        function getCourse($code) {
            if (isset($this->course[$code])) {
                return $this->course[$code];
            } else {
                return null;
            }
        }

        // retrieve a day record
        function getDay($code) {
            if (isset($this->day[$code])) {
                return $this->day[$code];
            } else {
                return null;
            }
        }

        // retrieve a period record
        function getPeriod($code) {
            if (isset($this->period[$code])) {
                return $this->period[$code];
            } else {
                return null;
            }
        }

    }

}
