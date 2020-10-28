<?php

class ShoppingCartItem {

    private Product $product;
    private int $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
    
    /**
     * getSubTotal of the product in a row.
     *
     * @return \int
     */
    public function getSubTotal (){
        $sum = $this->quantity * $this->getProduct()->getPrice();
        return $sum;
    }

    /**
     * Get the value of product
     */ 
    public function getProduct():Product
    {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @return  self
     */ 
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}


?>