<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoppingCart Project - Jack</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h4>Products</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Index</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Link</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require ("Product.php");
                require ("ShoppingCart.php");
                require ("ShoppingCartItem.php");
                require ('ProductsList.php');
                //sessions to save the state
                session_start();
                
                $productLists = array();

                if (empty($_SESSION['Cart'])){
                    $_SESSION['Cart'] = array();
                }
                $cart=new ShoppingCart();
           

                for ($i=0;$i<count($products);$i++){

                    //add new products into the array
                    array_push($productLists, new Product ($i,$products[$i]["name"],$products[$i]["price"]));                  
                    echo  "<tr>";
                    echo  '<th scope="row">' . $productLists[$i]->getid() . "</th>";
                    echo  "<td>" . $productLists[$i]->getProductName() . "</td>";
                    echo  "<td>" . number_format($productLists[$i]->getPrice(),2) . "</td>";//2 decimals
                    echo  '<td><a href="index.php?add&id='.$i.'">Add to cart</a></td>';
                    echo  "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</br>";
                echo "</br>";

                //shopping cart table start from here
                echo "<h4>Your shopping Cart</h4>";
                echo '<table class="table">
                <thead>
                <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Remove one item</th>
                </tr>
                </thead>
                <tbody>';
                
               
                if (isset($_GET['add']) && isset($_GET['id'])){
                    $cart->add($productLists[$_GET['id']],1);           
                }

                //still working with sessions........
                // if (isset($_GET['remove']) && isset($_GET['id'])){
                //     $cart->removeProduct($productLists[$_GET['id']],1);
                // }
                
                //assign the cart to mycart and render each element
                $myCart = $cart->getCartItems();
               
                
                if (!empty($myCart)){
                    for ($k=0;$k<Count($myCart);$k++){
                    echo "<tr>";
                    echo "<th>" . $myCart[$k]->getProduct()->getProductName()."</th>";
                    echo "<td>" . number_format($myCart[$k]->getProduct()->getPrice(),2)."</td>";//2 decimals
                    echo "<td>" . $myCart[$k]->getQuantity()."</td>";
                    echo "<td>" . number_format($myCart[$k]->getSubTotal (),2)."</td>";//2 decimals
                    echo '<td><a href="index.php?remove&id='.$k.'">Remove</a></td>';
                    echo "</tr>";
                    echo "</tbody>";
                    echo "</table>";
                    }
                }
                echo "</br>";
                echo "</br>";

                if (isset($_GET['clear'])){
                    $cart->clear();
                }
                //clear cart link
                echo '<a href="index.php?clear">Clear Cart</a>';
            ?>

</body>

</html>