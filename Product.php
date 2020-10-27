<?php

class Product{
    private String $productName; 
    private float $price;

    //constructor populates the attributes
    public function __construct($productName, $price)
    {
        $this->productName = $productName; 
        $this->price = $price;
    }

    
    /**
     * Get the value of productName
     */ 
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set the value of productName
     *
     * @return  self
     */ 
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}//end of the class

?>