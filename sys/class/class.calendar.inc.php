<?php

declare(strict_types=1);

class Calendar extends DB_Connect
{
    private $_userDate;

    private $_m;

    private $_y;

    private $_daysInMonth;

    private $_startDay;

    public function __construct($dbo = NULL, $useData = NULL)
    {
        parent::__construct($dbo);

        $this->_userDate = date('Y-m-d H:i:s');

        if (isset($useDate)) {
            $this->_userDate = $useData;
        }

        $ts = strtotime($this->_userDate);
        $this->_m = (int)date('m', $ts);
        $this->_y = (int)date('Y', $ts);

        $this->_daysInMonth = cal_days_in_month(
            CAL_GREGORIAN,
            $this->_m,
            $this->_y
        );

        $ts = mktime(0, 0, 0, $this->_m, 1, $this->_y);
        $this->_startDay = (int)date('w', $ts);
    }

    private function _loadEventData($id = NULL)
    {
        $sql = "SELECT * FROM events";

        if (!empty($id)) {
            $sql .= " WHERE event_id =:id LIMIT 1";
        } else {
            $startTS = mktime(0, 0, 0, $this->_m, 1, $this->_y);
            $endTS = mktime(23, 59, 59, $this->_m + 1, 0, $this->_y);
            $startDate = date('Y-m-d H:i:s', $startTS);
            $endDate = date('Y-m-d H:i:s', $endTS);

            $sql .= " WHERE event_start BETWEEN '" . $startDate . "' AND '" . $endDate . "' ORDER BY event_start";
        }

        try {
            $stmt = $this->db->prepare($sql);

            if (!empty($id)) {
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            }

            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $results;
        } catch (EXception $e) {
            die($e->getMessage());
        }
    }

    private function _createEventObj()
    {
        $arr = $this->_loadEventData();

        $events = array();

        foreach ($arr as $event) {
            $day = date('j', strtotime($event['event_start']));

            try {
                $events[$day][] = new Event($event);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        return $events;
    }

    public function buildCalendar()
    {
        define('WEEKDAYS', array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'));

        $calMonth = date('F Y', strtotime($this->_userDate));
        $html = '<h2>' . $calMonth . '</h2>';
        for ($d = 0, $labels = NULL; $d < 7; ++$d) {
            $labels .= '<li>' . WEEKDAYS[$d] . '</li>';
        }
        $html .= '<ul class="weekdays">' . $labels . '</ul>';

        $events = $this->_createEventObj();

        $html .= '<ul>';
        for ($i = 1, $c = 1, $t = date('j'), $m = date('m'), $y = date('Y'); $c <= $this->_daysInMonth; ++$i) {
            $class = $i <= $this->_startDay ? 'fill' : NULL;

            if ($c + 1 == $t && $m == $this->_m && $y == $this->_y) {
                $class = 'today';
            }

            $ls = sprintf('<li class="%s">', $class);
            $le = '</li>';

            $date = '&nbsp;';
            $eventInfo = NULL;
            
            if ($this->_startDay < $i && $this->_daysInMonth >= $c) {
                if (isset($events[$c])) {
                    foreach ($events[$c] as $event) {
                        $link = '<a href="view.php?event_id=' . $event->id . '">' . $event->title . '</a>';
                        $eventInfo .= $link;
                    }
                } 

                $date = sprintf('<b>%02d</b>', $c++);
            }

            $wrap = $i != 0 && $i % 7 == 0 ? '</ul><ul>' : NULL;
            $html .= $ls . $date . $eventInfo . $le . $wrap;
        }

        while ($i % 7 != 1) {
            $html .= '<li class="fill">&nbsp;</li>';
            ++$i;
        }

        $html .= '</ul>';
        return $html;
    }
}
?>