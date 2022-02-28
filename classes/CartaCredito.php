<?php

class CartaCredito {
  private string $numero;
  private string $cvv;
  private DateTime $scadenza;
  private string $intestatario;
  
  public function __construct($_numero, $_cvv, $_scadenza, $_intestatario) {
    $this->setNumero($_numero);
    $this->setCvv($_cvv);
    $this->setScadenza($_scadenza);
    $this->setIntestatario($_intestatario);
  }
  
  /**
   * @return string
   */
  public function getNumero(): string {
    return $this->numero;
  }
  
  /**
   * @param  string  $numero
   */
  public function setNumero(string $numero): void {
    $this->numero = $numero;
  }
  
  /**
   * @return string
   */
  public function getCvv(): string {
    return $this->cvv;
  }
  
  /**
   * @param  string  $cvv
   */
  public function setCvv(string $cvv): void {
    $this->cvv = $cvv;
  }
  
  /**
   * @return DateTime
   */
  public function getScadenza(): DateTime {
    return $this->scadenza;
  }
  
  /**
   * @param  string  $scadenza
   */
  public function setScadenza(string $scadenza): void {
    $this->scadenza = date_create($scadenza);
  }
  
  /**
   * @return string
   */
  public function getIntestatario(): string {
    return $this->intestatario;
  }
  
  /**
   * @param  string  $intestatario
   */
  public function setIntestatario(string $intestatario): void {
    $this->intestatario = $intestatario;
  }
  
  /**
   * @return bool
   */
  public function isValid(): bool {
    return $this->getScadenza() > date_create();
  }
}
