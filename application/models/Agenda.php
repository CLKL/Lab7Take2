<?php

/**
 * Description of Agenda
 *
 * @author Kelly Liu
 */
class Schedule extends CI_Model {

    protected $xml = null;
    protected $days = array();
    protected $periods = array();

    // Constructor
    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'agenda.xml');

        // build list of days 
        foreach ($this->xml->days->day as $day) {
            $record = new stdClass();
            $record->code = (string) $day['code'];
            $record->name = (string) $day;
            $this->days[$record->code] = $record;
        }

        // build list of periods
        foreach ($this->xml->periods->period as $period) {
            $record = new stdClass();
            $record->code = (string) $period['code'];
            $record->name = (string) $period;
            $this->periods[$record->code] = $record;
        }
    }

    // retreive list of days 
    function days() {
        return $this->days;
    }

    // retrieve a day record (for code)
    function getDay($code) {
        if (isset($this->days[$code])) {
            return $this->days[$code];
        } else {
            return null;
        }
    }

    // retrieve list of periods
    function periods() {
        return $this->periods;
    }

    // retrieve a period record
    function getPeriod($code) {
        if (isset($this->periods[$code])) {
            return $this->periods[$code];
        } else {
            return null;
        }
    }

}
