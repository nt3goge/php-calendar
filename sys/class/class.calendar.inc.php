<?php

declare(strict_types=1);

class Calendar extends DB_Connect
{
    private $userDate;

    private $_m;

    private $_y;

    private $_daysInMonth;

    private $_startDay;

    public function __construct($dbo = NULL, $useData = NULL)
    {
        parent::__construct($dbo);
    }
}
?>