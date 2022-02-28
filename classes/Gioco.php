<?php

require_once __DIR__ . "/Prodotto.php";

class Gioco extends Prodotto {
  /**
   * Tipologia di animali a cui questo prodotto è diretto.
   *
   * @var string
   */
  private string $catDestinazione;
  private array $materiali;
  
  public function __construct($_titolo, $_prezzo, $_catDestinazione) {
    parent::__construct($_titolo, $_prezzo);
    
    $this->setCatDestinazione($_catDestinazione);
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
  
  /**
   * @return array
   */
  public function getMateriali(): array {
    return $this->materiali;
  }
  
  /**
   * @param  array  $materiali
   */
  public function setMateriali(array $materiali): void {
    $this->materiali = $materiali;
  }
}
