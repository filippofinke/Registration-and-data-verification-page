<?php

/**
 * CsvParser
 * Classe che permette la gestione di file csv.
 *
 * @author Filippo Finke
 * @version 26.09.2018
 */
class CsvParser {

    /**
     * Il percorso del file da gestire.
     */
    private $path;

    /**
     * Metodo costruttore con 1 parametro.
     *
     * @param $path Il file da gestire.
     */
    function __construct($path) {
        $this->path = $path;
    }

    /**
     * Metodo che permette di scrivere un array in un file csv.
     *
     * @param $line L'array da scrivere.
     * @return bool true se la riga è stata scritta, false in caso di errore.
     */
    function writeLine($line)
    {
        $file = $this->file;
        if(is_writable($file) && file_exists($file))
        {
            $f = fopen($file,'w');
            $var = fputcsv($file,$line);
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
        $file = $this->file;
    }
}