/**
* PreventBackHistory
* Permette di prevenire l'utilizzo del tasto "indietro" all'interno dei browsers.
*
* @author Filippo Finke
* @version 03.11.2018
*/
history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};