<?php

namespace App\Http;
use App\Config\Database;
use App\Http\File;

class MO extends Database {
    private $table = 'mo';

	public function save($token)
    {
        $sql_array = $this->array_to_sql(array(
            'msisdn'        => $_REQUEST['msisdn'],
            'operatorid'    => $_REQUEST['operatorid'],
            'shortcodeid'   => $_REQUEST['shortcodeid'],
            'text'          => $_REQUEST['text'],
            'auth_token'    => $token,
            'created_at'    => date('Y-m-d H:i:s')
        ));
        $query = sprintf('INSERT INTO %s (%s) VALUES (%s)', $this->table, $sql_array['keys'], $sql_array['values']);
        return $this->insert($query);
    }

    public function write_to_file($token)
    {
        $text = implode(',', array(
            'msisdn'        => $_REQUEST['msisdn'],
            'operatorid'    => $_REQUEST['operatorid'],
            'shortcodeid'   => $_REQUEST['shortcodeid'],
            'text'          => $_REQUEST['text'],
            'auth_token'    => $token,
            'created_at'    => date('Y-m-d H:i:s')
        ));
        $file = new File;
        $file->open('file.txt', 'a');
        $file->write($text);
        $file->close();
    }

    public function last_15_min()
    {
        $datetime = date('Y-m-d H:i:s', strtotime('-15 minutes'));
        $query = sprintf('SELECT count(id) as mo_count from %s where created_at > "%s"', $this->table, $datetime);
        return reset($this->select($query))['mo_count'];
    }

    public function last_10k()
    {
        $query = sprintf("SELECT min(created_at) as min_mo, max(created_at) as max_mo from %s order by id DESC limit 10000", $this->table);
        return array_values(reset($this->select($query)));
    }
}