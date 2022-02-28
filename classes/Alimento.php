<?php

require_once __DIR__ . "/Prodotto.php";

class Alimento extends Prodotto {
  private string $scadenza;
  private array $ingredienti;
  /**
   * Tipologia di animali a cui questo prodotto è diretto.
   *
   * @var string
   */
  private string $catDestinazione;
  
  public function __construct($_titolo, $_prezzo, $_catDestinazione, $_scadenza) {
    parent::__construct($_titolo, $_prezzo);
    
    $this->setCatDestinazione($_catDestinazione);
    $this->setScadenza($_scadenza);
  }
  
  /**
   * @return string
   */
  public function getScadenza(): string {
    return $this->scadenza;
  }
  
  /**
   * @param  string  $scadenza
   */
  public function setScadenza(string $scadenza): void {
    $this->scadenza = $scadenza;
  }
  
  /**
   * @return array
   */
  public function getIngredienti(): array {
    return $this->ingredienti;
  }
  
  /**
   * @param  array  $ingredienti
   */
  public function setIngredienti(array $ingredienti): void {
    $this->ingredienti = $ingredienti;
  }
  
  /**
   * @return string
   */
  public function getCatDestinazione(): string {
    return $this->catDestinazione;
  }
  
  /**
   * @param  string  $catDestinazione
   */
  public function setCatDestinazione(string $catDestinazione): void {
    $this->catDestinazione = $catDestinazione;
  }
}
