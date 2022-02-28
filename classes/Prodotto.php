<?php

class Prodotto {
  private string $id;
  private float $prezzo;
  private string $titolo;
  private string $descrizione;
  private string $marca;
  
  public function __construct($_titolo, $_prezzo) {
    $this->setTitolo($_titolo);
    $this->setPrezzo($_prezzo);
    
    $this->id = uniqid();
  }
  
  /**
   * @return string
   */
  public function getId(): string {
    return $this->id;
  }
  
  /**
   * @return string
   */
  public function getTitolo(): string {
    return $this->titolo;
  }
  
  /**
   * @param  string  $titolo
   */
  public function setTitolo(string $titolo): void {
    $this->titolo = $titolo;
  }
  
  /**
   * @return string
   */
  public function getDescrizione(): string {
    return $this->descrizione;
  }
  
  /**
   * @param  string  $descrizione
   */
  public function setDescrizione(string $descrizione): void {
    $this->descrizione = $descrizione;
  }
  
  /**
   * @return float
   */
  public function getPrezzo(): float {
    return $this->prezzo;
  }
  
  /**
   * @param  float  $prezzo
   */
  public function setPrezzo(float $prezzo): void {
    $this->prezzo = $prezzo;
  }
  
  /**
   * @return string
   */
  public function getMarca(): string {
    return $this->marca;
  }
  
  /**
   * @param  string  $marca
   */
  public function setMarca(string $marca): void {
    $this->marca = $marca;
  }
}
