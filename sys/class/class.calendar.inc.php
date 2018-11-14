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

        $ts = $ts = mktime(0, 0, 0, $this->_m, 1, $this->_y);
        $this->_startDay = (int)date('w', $ts);
    }

    public function _loadEventData($id = NULL)
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
}
?>