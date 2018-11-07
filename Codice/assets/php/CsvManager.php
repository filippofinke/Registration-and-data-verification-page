<?php
/**
 * CsvManager
 * Classe che permette la gestione di file csv.
 *
 * @author Filippo Finke
 * @version 26.09.2018
 */
class CsvManager {

    /**
     * Il percorso del file da gestire.
     */
    private $path;

    /**
     * Separatore del file csv.
     */
    private $delimiter;

    /**
     * Metodo costruttore con 1 parametro.
     *
     * @param $path Il file da gestire.
     */
    function __construct($path, $delimiter) {
        $this->path = $path;
        $this->delimiter = $delimiter;
    }

    /**
     * Metodo che permette di scrivere un array in un file csv.
     *
     * @param $line L'array da scrivere.
     * @return bool true se la riga è stata scritta, false in caso di errore.
     */
    function writeLine($line)
    {
        $line = str_replace("\r\n", " ", $line);
        $line = str_replace("\n", " ", $line);
        $file = $this->path;
        if(!file_exists($file))
        {
            $f = fopen($file,'w');
            $csvline = "";
            $x = 0;
            foreach($line as $key => $data)
            {
                if($x != 0)
                    $csvline .= $this->delimiter;
                $csvline .= $key;
                $x++;
            }
            fwrite($f, $csvline."\n");
            fclose($f);
        }
        if(is_writable($file) && file_exists($file))
        {
            $f = fopen($file,'a');
            $csvline = "";
            $x = 0;
            foreach($line as $data)
            {
                if($x != 0)
                    $csvline .= $this->delimiter;
                $csvline .= $data;
                $x++;
            }
            $var = fwrite($f, $csvline."\n");
            fclose($f);
            return $var;
        }
        return false;
    }

    /**
     * Ritorna tutto il contenuto del file csv in un array.
     * @return array Ritorna il file csv in un array.
     */
    function readAll()
    {
        $file = $this->path;
        if(is_readable($file) && file_exists($file))
        {
            $csvArray = [];
            if (($f = fopen($file,'r')) !== FALSE)
            {
                while (($data = fgetcsv($f, 100000, $this->delimiter)) !== FALSE)
                {
                    if($data == null) continue;
                    $csvArray[] = $data;
                }
                fclose($f);
            }
            return $csvArray;
        }
        return false;
    }
}
