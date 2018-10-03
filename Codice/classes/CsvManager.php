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
        $file = $this->path;
        if(is_writable($file) && file_exists($file))
        {
            $f = fopen($file,'a');
            $var = fputcsv($f,$line,$this->delimiter);
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
                while (($data = fgetcsv($f, 1000, $this->delimiter)) !== FALSE)
                {
                    $csvArray[] = $data;
                }
                fclose($f);
            }
            return $csvArray;
        }
        return false;
    }
}