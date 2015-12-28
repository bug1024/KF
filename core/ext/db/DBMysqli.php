<?php namespace core\ext\db;

class DBMysqli extends DBAbstract {

    public function connect() {
        if ($this->ping(false)) {
            return $this->conn;
        }

        if (!extension_loaded('mysqli')) {
            throw new \Exception('NO_MYSQLI_EXTENSION_FOUND');
        }

        $this->conn = mysqli_init();
        $connected = @mysqli_real_connect(
            $this->conn, $this->config['host'], $this->config['user'],
            $this->config['password'], $this->config['database'], $this->config['port']
        );

        if ($connected) {
            if ($this->config['charset']) $this->query("SET NAMES '{$this->config['charset']}';");
            return $this->conn;
        }

        $this->_throwException();
    }

    public function selectDb($database) {
        return $this->conn->select_db($database);
    }

    public function close() {
        if ($this->conn) {
            return $this->conn->close();
        }

        return true;
    }

    public function free() {
        if ($this->query) {
            return $this->query->free();
        }
    }

    protected function _query($sql) {
        return $this->conn->query($sql);
    }

    public function affectedRows() {
        return $this->conn->affected_rows;
    }

    public function fetch($type = 'ASSOC') {
        switch ($type) {
            case 'ASSOC':
                $func = 'fetch_assoc';
                break;
            case 'BOTH':
                $func = 'fetch_array';
                break;
            case 'OBJECT':
                $func = 'fetch_object';
                break;
            default:
                $func = 'fetch_assoc';
        }

        return $this->query->$func();
    }

    public function fetchAll($type = 'ASSOC') {
        switch ($type) {
            case 'ASSOC':
                $func = 'fetch_assoc';
                break;
            case 'BOTH':
                $func = 'fetch_array';
                break;
            case 'OBJECT':
                $func = 'fetch_object';
                break;
            default:
                $func = 'fetch_assoc';
        }

        $result = [];
        while ($row = $this->query->$func()) {
            $result[] = $row;
        }
        $this->query->free();
        return $result;


    }

    public function lastInsertId() {
        return $this->conn->insert_id;
    }

    public function beginTransaction() {
        return $this->conn->autocommit(false);
    }

    public function commit() {
        $this->conn->commit();
        $this->conn->autocommit(true);
    }

    public function rollBack() {
        $this->conn->rollback();
        $this->conn->autocommit(true);
    }

    public function escape($str) {
        if($this->conn) {
            return  $this->conn->real_escape_string($str);
        }else{
            return addslashes($str);
        }
    }

    public function error() {
        if ($this->conn) {
            $errno = $this->conn->errno;
            $error = $this->conn->error;
        } else {
            $errno = mysqli_connect_errno();
            $error = mysqli_connect_error();
        }

        return array('code' => intval($errno), 'msg' => $error);
    }

    public function ping($reconnect = true) {
        if ($this->conn && $this->conn->ping()) {
            return true;
        }

        if ($reconnect) {
            $this->close();
            $this->connect();
            return $this->conn->ping();
        }

        return false;
    }

}
