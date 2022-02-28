<?php

require_once __DIR__ . "/CartProduct.php";
require_once __DIR__ . "/CartaCredito.php";

class User {
  private bool $registrato = false;
  private string $nome;
  private string $cognome;
  private string $email;
  private array $indirizzo = [
    "via"       => "",
    "num"       => "",
    "citta"     => "",
    "provincia" => "",
    "nazione"   => "",
  ];
  /**
   * @var array<CartProduct>
   */
  private array $cart = [];
  private float $cartTotal = 0;
  /**
   * @var CartaCredito|null
   */
  private ?CartaCredito $cartaCredito = null;
  
  /**
   * Sconto da applicare agli utenti regisrtati
   *
   * @var int
   */
  private int $scontoRegistrati = 20;
  
  
  function __construct() {
  
  }
  
  /**
   * @return bool
   */
  public function getRegistrato(): bool {
    return $this->registrato;
  }
  
  /**
   * @param $nome
   * @param $cognome
   *
   * @return void
   */
  public function registra($nome, $cognome): void {
    $this->registrato = true;
    
    $this->setNome($nome);
    $this->setCognome($cognome);
  }
  
  /**
   * @return string
   */
  public function getNome(): string {
    return $this->nome;
  }
  
  /**
   * @param  string  $nome
   */
  public function setNome(string $nome): void {
    $this->nome = $nome;
  }
  
  /**
   * @return string
   */
  public function getCognome(): string {
    return $this->cognome;
  }
  
  /**
   * @param  string  $cognome
   */
  public function setCognome(string $cognome): void {
    $this->cognome = $cognome;
  }
  
  /**
   * @return string
   */
  public function getFullName(): string {
    return $this->getNome() . " " . $this->getCognome();
  }
  
  /**
   * @return string
   */
  public function getEmail(): string {
    return $this->email;
  }
  
  /**
   * @param  string  $email
   */
  public function setEmail(string $email): void {
    $this->email = $email;
  }
  
  /**
   * @return array|string[]
   */
  public function getIndirizzo(): array {
    return $this->indirizzo;
  }
  
  /**
   * @param  array|string[]  $indirizzo
   */
  public function setIndirizzo(array $indirizzo): void {
    $this->indirizzo = $indirizzo;
  }
  
  /**
   * @return int
   */
  public function getSconto(): int {
    return $this->registrato ? $this->scontoRegistrati : 0;
  }
  
  /**
   * @return CartProduct[]
   */
  public function getCart(): array {
    return $this->cart;
  }
  
  /**
   * @return float
   */
  public function getCartTotal(): float {
    if ($this->registrato) {
      return $this->cartTotal - (($this->cartTotal * $this->getSconto()) / 100);
    }
    
    return $this->cartTotal;
  }
  
  /**
   * @return CartaCredito|null
   */
  public function getCartaCredito(): ?CartaCredito {
    return $this->cartaCredito;
  }
  
  /**
   * @param  string       $numero
   * @param  string       $cvv
   * @param  string       $scadenza
   * @param  string|null  $intestatario
   *
   * @return void|false
   */
  public function setCartaCredito(string $numero, string $cvv, string $scadenza, string $intestatario = null) {
    // Se non è ancora stato impostato il nome e il cognome dell'utente e non viene nemmeno
    // fornito un intestatario come argomento, non posso creare la carta di credito
    if (( !isset($this->nome) || !isset($this->cognome)) && is_null($intestatario)) {
      return false;
    }
    
    // se non viene specificato un intestatario, usa quello corrente.
    $this->cartaCredito = new CartaCredito($numero, $cvv, $scadenza, $intestatario ?? $this->getFullName());
  }
  
  /**
   * Return the index of the product if present, otherwise false.
   *
   * @param  string  $needleId
   *
   * @return bool|int
   */
  private function prodAlreadyInCart(string $needleId) {
    $found = false;
    
    foreach ($this->getCart() as $key => $cartProduct) {
      $prodId = $cartProduct->getProdotto()->getId();
      
      if ($prodId === $needleId) {
        $found = $key;
        
        break;
      }
    }
    
    return $found;
  }
  
  /**
   * @param  Prodotto|Gioco|Alimento  $prodotto
   *
   * @return void
   */
  public function addToCart($prodotto) {
    // prima controllo se il prodotto esiste già nel carrello.
    $existing = $this->prodAlreadyInCart($prodotto->getId());
    
    // se esiste già, incremento la quantità
    // altrimenti lo aggiungo al carrello
    if ($existing !== false) {
      $this->cart[$existing]->incrementaQuantita();
    } else {
      $cartProduct = new CartProduct($prodotto);
      
      $this->cart[] = $cartProduct;
    }
    
    $this->updateCartPrice();
  }
  
  /**
   * @return bool
   */
  public function concludiOrdine(): bool {
    // se non esiste una carta di credito, blocco l'operazione
    if ( !$this->getCartaCredito() || !$this->getCartaCredito()->isValid()) {
      return false;
    }
    
    var_dump($this->getCartTotal());
    
    return true;
  }
  
  /**
   * Aggiorna il prezzo totale del carrello in base ai prodotti interni
   *
   * @return void
   */
  private function updateCartPrice() {
    $sum = 0;
    
    foreach ($this->getCart() as $product) {
      $sum += $product->getPrezzoTotale();
    }
    
    $this->cartTotal = $sum;
  }
}
