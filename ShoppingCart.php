<?php

Class ShoppingCart{

     /**
     * @var ShoppingCartItem[]
     */
    private array $cartItems = [];
   
    /**default constructor
     * __construct
     */
    public function __construct(){}

    /**
     * Find the product in our cart.
     * if not found, we add new product to our cart.
     * if found,
     * we will increase the amount of quantity, default is 1.
     * return the updated array.
     * 
     * @param  Product $product
     * @param  int $amount
     * @return void
     */
    public function add(Product $product, int $amount = 1)
    {   

        $expectedID = $this->findItem($product->getId());
        
        if ($expectedID == null){
            $shoppingCartItem = new ShoppingCartItem ($product,1);
            array_push($this->cartItems, $shoppingCartItem);
        } 
        //if found
        else{
            $this->cartItems[$expectedID]->setQuantity($this->cartItems[$expectedID]->getQuantity()+$amount);
        }
    }

    
    /**
     * removeProduct
     * find the product from our cart.
     * If the quantity of cart item is more than 1,
     * quantity will minus the value of amount default is 1.
     * Else will delete the element.
     *
     * @param  Product $product
     * @param  int $amount
     * @return void
     */
    public function removeProduct(Product $product, int $amount = 1)
    {
        
        $index = $this->findItem($product->getId());
        $chosenCartItem = $this->cartItems[$index];

        if ($chosenCartItem->getQuantity()>1){
            $chosenCartItem->setQuantity($chosenCartItem->getQuantity()-$amount);
        }
        else{
            unset($this->cartItems[$index]);
        }    
    }
    
    /**
     * findCartItem
     * Iterate all the items inside of the cart.
     * If the item has the same name as the product we choose,
     * then return the product,
     * otherwise return null
     *
     * @param  String $ProductName
     * @return \Product
     */
    public function findItem (int $productID){

        foreach ($this->cartItems as $item){
            if ($item->getProduct()->getId() === $productID){
                return $productID;
            }
        }
        return null;
    }
    
    /**
     * empty cart
     *
     * @return void
     */
    public function clear (){
        
        $this->cartItems = array();
    }

        
    /**
     * getTotalQuantity of all the products in the cart.
     *
     * @return \int
     */
    public function getTotalQuantity()
    {
        $sum = 0;
        
       foreach ($this->cartItems as $item){
           $sum += $item->getQuantity();
       }

       return $sum;
    }

        
    /**
     * getTotalSum
     * add up all the row subtotals
     * 
     * @return \int
     */
    public function getTotalSum()
    {
        $totalSum = 0;
        
        foreach ($this->cartItems as $item){
            $totalSum += $item->getSubTotal();
        }
 
        return $totalSum;
    }

    /**
     * Get the value of cartItems
     *
     * @return  ShoppingCartItem[]
     */ 
    public function getCartItems()
    {
        return $this->cartItems;
    }


    /**
     * Set the value of cartItems
     *
     * @param  ShoppingCartItem[]  $cartItems
     *
     * @return  self
     */ 
    public function setCartItems($cartItems)
    {
        $this->cartItems = $cartItems;

        return $this;
    }
}
?>