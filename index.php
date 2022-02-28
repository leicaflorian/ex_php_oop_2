<?php

require_once __DIR__ . "/classes/Gioco.php";
require_once __DIR__ . "/classes/Alimento.php";
require_once __DIR__ . "/classes/User.php";

$osso       = new Gioco("Osso di plastica", 4.50, "cani");
$palla      = new Gioco("Palla di plastica", 2.50, "cani");
$crocchette = new Alimento("Crocchette al tonno", 3.50, "gatti", "2023-07-02");

$utente = new User();
$utente->addToCart($osso);
$utente->addToCart($osso);
$utente->addToCart($palla);
$utente->addToCart($crocchette);
$utente->addToCart($crocchette);
$utente->addToCart($crocchette);

// Imposta l'utente come registrato. In fase di conclusione dell'ordine verrà calcolato lo sconto
// In fase di registrazione imposta anche il nome e cognome utente.
$utente->registra("Mario", "Rossi");

// Imposto i dati dell'utente e poi creo la carta di credito sfruttando il nome dell'utente
//$utente->setNome("Mario");
//$utente->setCognome("Rossi");
//$utente->setCartaCredito("776887686238762874638", "876", "2023-10-20");

// Non imposto i dati dell'utente ma specifico il nome dell'intestatario della carta di credito
$utente->setCartaCredito("776887686238762874638", "876", "2023-10-20", "Giuseppe Verdi");


var_dump($utente);

// ritora true se tutto va bene altrimenti false
var_dump($utente->concludiOrdine());
