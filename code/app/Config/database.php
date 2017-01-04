<?php

namespace App\Config;

class Database 
{
    private $connection;
    private $data;
 
    function __construct()
    {
        $config = parse_ini_file(__DIR__.'/../../config.ini'); 
		$this->connection = mysqli_connect($config['DB_HOST'] , $config['DB_USER'], $config['DB_PASS'], $config['DB_DATABASE']);
    }

    protected function query($query)
    {
        $result = $this->connection->query($query);
        if(!$result) return $this->response(false, $this->connection->error);
        return $result;
    }

    /**
     * Handle an incoming query request.
     *
     * @param  string $table
     * @param  string $query
     * @return array
     */
    protected function select($query)
    {
        $this->data = array();
        $result = $this->connection->query($query);
        
        if(!$result) return $this->response(false, $this->connection->error);
        if($result->num_rows < 1) return array();
        while($row = $result->fetch_assoc()) {
            $this->data[] = $row;
        }
        return $this->data;
    }

    /**
     * Handle an incoming insert request.
     *
     * @param  string $query
     * @return array
     */
    protected function insert($query)
    {
        if(!$this->connection->query($query)) return $this->response(false, $this->connection->error);
        return $this->response(true, $this->connection->insert_id);
    }

    /**
     * Handle an incoming delete request.
     *
     * @param  string $table
     * @param  array $args
     * @return array
     */protected function delete($query)
    {
        if(!$this->connection->query($query)) return $this->response(false, $this->connection->error);
        return $this->response(true, true);
    }

    protected function response($type, $message)
    {
        $type = (!$type) ? false : true;
        return array('response_code' => $type, 'response' => $message);
    }

    protected function array_to_sql($data)
    {
        $count = count($data); $values = ''; $flag = 0;
        $keys = implode(',', array_keys($data));
        foreach ($data as $key => $value) {
            $values .= sprintf('"%s"%s', $value, ($flag < $count-1) ? ',' : '');
            $flag++;
        }
        return array('keys' => $keys, 'values' => $values);
    }
}