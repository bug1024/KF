<?php namespace core\ext\db;

abstract class DBAbstract {

    public $config = [];

    public $conn = null;

    public $query = null;

    public $debug = false;

    public $log = [];

    public function __construct($config) {
        $this->config = $config;
    }

    public function query($sql) {
        if (is_null($this->conn)) {
            $this->connect();
        }

        $log = $sql . '@' . date('Y-m-d H:i:s');
        $this->log[] = $log;

        if ($this->query = $this->_query($sql)) {
            return $this->query;
        }

        $this->_throwException();
    }

    public function sql($sql, $type = 'ASSOC') {
        $this->query($sql);

        $tags = explode(' ', $sql, 2);
        switch (strtoupper($tags[0])) {
            case 'SELECT':
                ($result = $this->fetchAll($type)) || ($result = []);
                break;
            case 'INSERT':
                $result = $this->lastInsertId();
                break;
            case 'UPDATE':
            case 'DELETE':
                $result = $this->affectedRows();
                break;
            default:
                $result = $this->query;
        }

        return $result;
    }

    public function row($sql, $type = 'ASSOC') {
        $this->query($sql);
        return $this->fetch($type);
    }

    public function col($sql) {
        $this->query($sql);
        $result = $this->fetch();
        return empty($result) ? null : current($result);
    }

    public function find($opts) {
        if (is_string($opts)) {
            $opts = array('where' => $opts);
        }

        $opts = $opts + array(
            'fileds' => '*',
            'where' => 1,
            'order' => null,
            'start' => -1,
            'limit' => -1
        );

        $sql = "select {$opts['fileds']} from {$opts['table']} where {$opts['where']}";

        if ($opts['order']) {
            $sql .= " order by {$opts['order']}";
        }

        if (0 <= $opts['start'] && 0 <= $opts['limit']) {
            $sql .= " limit {$opts['start']}, {$opts['limit']}";
        }

        return $this->sql($sql);
    }

    public function insert($data, $table) {
        $keys = [];
        $values = [];
        foreach ($data as $key => $value) {
            $keys[] = "`$key`";
            $values[] = "'" . $this->escape($value) . "'";
        }
        $keys = implode(',', $keys);
        $values = implode(',', $values);
        $sql = "insert into {$table} ({$keys}) values ({$values});";
        return $this->sql($sql);
    }

    public function update($data, $where = '0', $table) {
        $tmp = [];

        foreach ($data as $key => $value) {
            $tmp[] = "`$key`='" . $this->escape($value) . "'";
        }

        $str = implode(',', $tmp);

        $sql = "update {$table} set {$str} where {$where}";

        return $this->sql($sql);
    }

    public function delete($where = '0', $table) {
        $sql = "delete from $table where $where";
        return $this->sql($sql);
    }

    public function count($where, $table) {
        $sql = "select count(1) as cnt from $table where $where";
        $this->query($sql);
        $result = $this->fetch();
        return empty($result['cnt']) ? 0 : $result['cnt'];
    }

    protected function _throwException() {
        $error = $this->error();
        throw new \Exception($error['msg'], $error['code']);
    }

    abstract public function connect();

    abstract public function close();

    abstract protected function _query($sql);

    abstract public function affectedRows();

    abstract public function fetch();

    abstract public function fetchAll();

    abstract public function lastInsertId();

    abstract public function beginTransaction();

    abstract public function commit();

    abstract public function rollBack();

    abstract public function free();

    abstract public function escape($str);

}
