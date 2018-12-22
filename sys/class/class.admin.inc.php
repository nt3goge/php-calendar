<?php

declare(strict_types=1);

class Admin extends DB_Connect
{
    private $_saltLength = 7;

    public function __construct($dbo = null, $saltLength = null)
    {
        parent::__construct($dbo);

        if (is_int($saltLength)) {
            $this->_saltLength = $saltLength;
        }
    }

    public function processLoginForm()
    {
        if ($_POST['action'] != 'user_login') {
            return 'Invalid action supplied for processLoginForm.';
        }

        $userName = htmlentities($_POST['username'], ENT_QUOTES);
        $password = htmlentities($_POST['password'], ENT_QUOTES);

        $sql = 'SELECT `user_id`, `user_name`, `user_email`, `user_pass`
                FROM `users`
                WHERE `user_name` = :username
                LIMIT 1';

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
            $stmt->execute();
            $user = array_shift($stmt->fetchAll());
            $stmt->closeCursor();
        } catch (Exception $e) {
            die($e->getMessage());
        }

        if (!isset($user)) {
            return 'Your username or password is invaild.';
        }

        $hash = $this->_getSaltedHash($password, $user['user_pass']);

        if ($user['user_pass'] == $hash) {
            $_SESSION['user'] = [
                'id' => $user['user_id'],
                'name' => $user['user_name'],
                'email' => $user['user_email']
            ];

            return true;
        } else {
            return 'Your username or password is invaild.';
        }
    }

    private function _getSaltedHash($string, $salt = NULL)
    {
        if ($salt == NULL) {
            $salt = substr(md5((string)time()), 0, $this->_saltLength);
        } else {
            $salt = substr($salt, 0, $this->_saltLength);
        }

        return $salt . sha1($salt . $string);
    }

    public function testSaltedHash($string, $salt = NULL)
    {
        return $this->_getSaltedHash($string, $salt);
    }

    public function processLogout()
    {
        if ($_POST['action'] != 'user_logout') {
            return 'Invalid action supplied for processLogout';
        }

        session_destroy();
        return true;
    }
}
