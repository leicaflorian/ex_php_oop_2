<?php

class CartProduct {
  private int $quatita = 1;
  private float $prezzoTotale = 0;
  private $prodotto;
  
  public function __construct($_prodotto, $_quantita = 1) {
    $this->setProdotto($_prodotto);
    $this->setQuatita($_quantita);
    
  }
  
  /**
   * @return int
   */
  public function getQuatita(): int {
    return $this->quatita;
  }
  
  /**
   * @param  int  $quatita
   */
  public function setQuatita(int $quatita): void {
    $this->quatita = $quatita;
    $this->prezzoTotale = $this->quatita * $this->getProdotto()->getPrezzo();
  }
  
  /**
   * @param  int  $quatita
   */
  public function incrementaQuantita(int $quatita = 1): void {
    $this->setQuatita($this->getQuatita() + $quatita);
  }
  
  /**
   * @return Prodotto|Alimento|Gioco
   */
  public function getProdotto() {
    return $this->prodotto;
  }
  
  /**
   * @param  mixed  $prodotto
   */
  public function setProdotto($prodotto): void {
    $this->prodotto = $prodotto;
  }
  
  /**
   * @return int
   */
  public function getPrezzoTotale(): int {
    return $this->prezzoTotale;
  }
}
