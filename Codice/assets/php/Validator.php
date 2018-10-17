<?php
/**
* Validator
* Classe che permette la validazione di dati.
*
* @author Filippo Finke
* @version 22.09.2018
*/
class Validator {

	/**
	* Carattere usato per la separazione del file csv
	*/
	private $delimeter = ";";

	/**
	* Caratteri disabilitati per evitare csv injection.
	*/
	private $disabledCharsAtStart = array("@","+","=","-");

	/**
	* Metodo che permette di controllare se un
	* carattere sia contenuto in una stringa.
	*/
	public function containChar($string, $char)
	{
		if (strpos($string, $char) !== false) {
		    return true;
		}
		return false;
	}

	/**
	* Metodo che permette di controllare se un
	* stringa inizia con un determinato carattere.
	*/
	public function startsWith($string, $char)
	{
	     $length = strlen($char);
	     return (substr($string, 0, $length) === $char);
	}

	/**
	* Metodo di controllo base su stringhe.
	*/
	public function basic($string)
	{
		if(empty(trim($string)) || trim($string) != $string)
			return false;
		$tempstring = filter_var($string, FILTER_SANITIZE_STRING);
		if($tempstring != $string)
			return false;
		else
		{
			if($this->containChar($string,$this->delimeter))
				return false;
			else
			{
				foreach ($this->disabledCharsAtStart as $char) {
					if($this->startsWith($string, $char))
						return false;
				}
				return true;
			}
		}
	}

	/**
	* Metodo per la validazione del genere.
	*/
	public function gender($string)
	{
		if($string == "F" || $string == "M")
			return true;
		return false;
	}

	/**
	* Metodo per la validazione del numero di telefono.
	*/
	public function telephone($string)
	{
		$string = str_replace("+","",$string);
		if($this->basic($string))
		{
			$string = preg_replace('/\s+/', '', $string);
			if(preg_match("/^\+?\d{10,13}$/", $string))
				return true;
		}
		return false;
	}

	/**
	* Metodo di validazione del codice postale.
	*/
	public function nap($string)
	{
		if(strlen($string) == 4 || strlen($string) == 5)
		{
			if(preg_match("/^\d{4,5}$/", $string))
				return true;
		}
		return false;
	}

	/**
	* Metodo di validazione per la data di nascita.
	*/
	public function birthDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) === $date;
	}

	/**
	* Metodo di validazione per campi alfabetici.
	*/
	public function general($string)
	{
		if(strlen($string) <= 50 && preg_match("/^[a-zA-ZÀ-ÿ\x{00f1}\x{00d1}\s]*$/u", $string))
		{
		    return $this->basic($string);
		}
		return false;
	}

	/**
	* Metodo di validazione per il numero civico.
	*/
	public function street($string)
	{
		if(strlen($string) >= 1 && strlen($string) <= 4 && ctype_alnum($string))
		{
			return true;
		}
		return false;
	}

	/**
	* Metodo di validazione per l'indirizzo email.
	*/
	public function email($string)
	{
		if($this->basic($string) && filter_var($string, FILTER_VALIDATE_EMAIL))
		{
			return true;
		}
		return false;
	}

	/**
	* Metodo di validazioner per input con un testo di massimo
	* 500 caratteri.
	*/
	public function textArea($string)
	{
		if(strlen($string) > 0 && strlen($string) <= 500)
			return $this->basic($string);
		return false;
	}

}
