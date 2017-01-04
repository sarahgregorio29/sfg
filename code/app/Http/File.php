<?php

namespace App\Http;

class File {
    private $fhandler;
    private $path;

    public function __construct()
    {  
        $this->path = dirname(dirname(dirname(__FILE__)));
    } 

    public function open($filename, $mode)
    {
        $file = sprintf('%s/%s', $this->path, $filename);
        $this->fhandler = fopen($file, $mode) or die("Can't open the file");
    }

    public function write($text)
    {
        fwrite($this->fhandler, $text."\n");
    }

    public function close()
    {
        fclose($this->fhandler);
    }

    public function row_count($filename)
    {
        $count = 0;
        $this->open($filename, 'r');
        while( !feof($this->fhandler) ) {
            fgets($fhandler);
            $count++;
        }
        $this->close();
        return $count;
    }
}