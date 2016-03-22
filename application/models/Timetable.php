<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TimeTable extends CI_Model {

    protected $xml = null;
    protected $course = array(); // courses facet
    protected $dayOfWeek = array(); // days facet
    protected $period = array(); // period facet

    function __construct() {
        parent::_construct();
        // Load XML File
        $this->xml = simplexml_load_file(DATAPATH . 'master.xml', "SimpleXMLElement", LIBXML_NOENT);


        // build a full list of bookings by courses
        foreach ($this->xml->courses->course as $course) {
            foreach ($course->booking as $booking) {
                $this->courses[] = new Booking($booking, $course);
            }
        }

        // build a full list of bookings by days
        foreach ($this->xml->days->day as $day) {
            foreach ($day->booking as $booking) {
                $this->days[] = new Booking($booking, $day);
            }
        }

        // build a full list of bookings by periods
        foreach ($this->xml->periods->period as $period) {
            foreach ($period->booking as $booking) {
                $this->periods[] = new Booking($booking, $period);
            }
        }

        //----------------------------------------------------------------------
        // Public Accessors
        //----------------------------------------------------------------------
        
        // retrieves php array for bookings from course.xml
        function getCourses() {
            return $this->courses;
        }

        // retrieves php array for bookings from dayOfWeek.xml
        function getDays() {
            return $this->days;
        }

       // retrieves php array for bookings from period.xml
        function getPeriods() {
            return $this->periods;
        }

    }
  
}

class booking extends CI_model {
    public $day = "";
    public $room = "";
    public $instructor = "";
    public $period = "";
    public $course = "";
    
    public function __construct($rec, $par){
        $this->day = (isset($rec->day['num']) ? $rec->day['num'] : $par['num']);
        $this->room = $rec->room;
        $this->instructor = $rec->instructor;
        $this->period =(isset($rec->day['time']) ? $rec->day['time'] : $par['time']);
        $this->course =(isset($rec->day['course_num']) ? $rec->day['course_num']
                : $par['course_num']);
    }
}
