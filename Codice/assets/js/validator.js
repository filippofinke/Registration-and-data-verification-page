/**
* Classe Validator.
* @author Filippo Finke
* @version 24.10.2018
*/
var Validator = class Validator {

    /**
     * Metodo costruttore vuoto.
     */
    constructor() {
        this.delimiter = ";";
        this.disabledCharsAtStart = ["@", "+", "=", "-"];
    }

    /**
     * Metodo che permette di controllare se un carattere sia presente all'interno di una stringa.
     *
     * @param string La stringa nel quale cercare il carattere.
     * @param char Il carattere da cercare.
     * @returns {boolean} True se il carattere è stato trovato.
     */
    containChar(string, char) {
        if (string.indexOf(char) > -1) {
            return true;
        }
        return false;
    }

    /**
     * Metodo di controllo basilare su stringhe, controllo stringhe vuote, xss e csv injection.
     * @param string La stringa da controllare.
     * @returns {boolean} True se la stringa è valida.
     */
    basic(string) {
        if (string.trim() == "" || string.trim() != string) {
            return false;
        }
        if (this.containChar(string, this.delimiter)) {
            return false
        }
        else {
            this.disabledCharsAtStart.forEach(function (char) {
                if (string.startsWith(char)) {
                    return false;
                }
            });
            return true;
        }
    }

    /**
     * Metodo che permette di verificare che il formato del genere sia corretto.
     *
     * @param string La stringa da controllare.
     * @returns {boolean} True se la stringa è valida.
     */
    gender(string) {
        if (string == "M" || string == "F") {
            return true;
        }
        return false;
    }

    /**
     * Metodo che permette di verificare che il formato del numero di telefono sia corretto.
     * Formato con 10 o 13 cifre numeriche.
     *
     * @param string La stringa da controllare.
     * @returns {boolean} {boolean} True se la stringa è valida.
     */
    telephone(string) {
        string = string.replace("+", "");
        if (this.basic(string)) {
            string = string.split(" ").join("");
            if (/^\+?\d{10,13}$/.test(string)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Metodo che permette di verificare che il nap sia nel formato corretto.
     *
     * @param string La stringa da controllare.
     * @returns {boolean} {boolean} True se la stringa è valida.
     */
    nap(string) {
        if (string.length == 4 || string.length == 5) {
            if (/^\d{4,5}$/.test(string)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Metodo che permette di verificare che una data di nascita sia valida.
     *
     * @param string La stringa da controllare.
     * @returns {boolean} {boolean} True se la stringa è valida.
     */
    birthDate(string) {
        var regEx = /^\d{4}-\d{2}-\d{2}$/;
        if (!string.match(regEx)) {
            return false;
        }
        var d = new Date(string);
        if (Number.isNaN(d.getTime())) {
            return false;
        }
        if(d > new Date())
          return false;

        return d.toISOString().slice(0, 10) === string;
    }

    /**
     * Metodo generale per la verifica di campi nel quale il limite è di 50 caratteri e
     * contengano solo caratteri alfabetici.
     *
     * @param string La stringa da controllare.
     * @returns {boolean} {boolean} True se la stringa è valida.
     */
    general(string) {
        if (string.length <= 50 &&
          /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+([.-]{1})?([a-zA-ZÀ-ÿ\u00f1\u00d1\s]+)?$/g.test(string)) {
            return this.basic(string);
        }
        return false;
    }

    /**
     * Metodo che permette di verificare che il formato del numero civico sia corretto.
     * ES: 12C, 132A
     *
     * @param string La stringa da controllare.
     * @returns {boolean} {boolean} True se la stringa è valida.
     */
    civicnumber(string) {
        if (string.length >= 1 && string.length <= 4 && /^[0-9]{1,3}([0-9]|([a-zA-Z]{1}))?$/.test(string)) {
            return true;
        }
        return false;
    }

    /**
     * Metodo che permette di verificare che il formato della email inserita sia valido.
     *
     * @param string La stringa da controllare.
     * @returns {boolean} {boolean} True se la stringa è valida.
     */
    email(string) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (this.basic(string) && re.test(string)) {
            return true;
        }
        return false;
    }

    /**
     * Metodo che permette di verificare il formato del testo delle textArea.
     *
     * @param string La stringa da controllare.
     * @returns {boolean} {boolean} True se la stringa è valida.
     */
    textArea(string) {
        if (string.length > 0 && string.length <= 500 && !/<(.*)>/.test(string)) {
            return this.basic(string);
        }
        return false;
    }
};
