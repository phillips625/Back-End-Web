<?php
    // The script starts by calling session_start() to create a new session, or pick up an existing session if one exists for this user.
      session_start();
    
    // Then the script defines a Product class to hold the products in the store, and a global $products array containing three Product objects, keyed by the numeric product IDs of the products. (In a real-world scenario you’d probably store the products in a database.)
      class Product {
          
        private $productId;
        private $productName;
        private $price;
          
        public function __construct( $productId, $productName, $price ) {
          $this->productId = $productId;
          $this->productName = $productName;
          $this->price = $price;
        }
          
        public function getId() {
          return $this->productId;
        }
        public function getName() {
          return $this->productName;
        }
        public function getPrice() {
          return $this->price;
        }
      }
    
      $products = array(
                        1 => new Product( 1, "SuperWidget", 19.99 ),
                        2 => new Product( 2, "MegaWidget", 29.99 ),
                        3 => new Product( 3, "WonderWidget", 39.99 )
                    );
    
    // The code then initializes the user’s cart to an empty array if it doesn’t yet exist. The array is stored as an element, cart, inside the $_SESSION superglobal. As with the $products array, this array will hold the products selected by the user, keyed by product ID.
      if ( !isset( $_SESSION["cart"] ) ) $_SESSION["cart"] = array();
    
    // The next few lines of code form the main decision logic of the script, calling addItem() if the user chose to add an item to his cart, removeItem() if the user opted to remove a product, or displayCart() if neither option was chosen by the user:
      if ( isset( $_GET["action"] ) and $_GET["action"] == "addItem" ) {
        addItem();
      }
    
      elseif ( isset( $_GET["action"] ) and $_GET["action"] == "removeItem" ) {
        removeItem();
      }
    
      else {
        displayCart();
      }
    
    // The addItem() function looks for a productId field in the query string and, if present and valid, adds the corresponding Product object to the user’s cart by inserting an array element into the $_SESSION[“cart“] array, keyed by product ID. It then sends a Location: header to reload the shopping cart
    function addItem() {
  
        global $products;
        
        if ( isset( $_GET["productId"] ) and $_GET["productId"] >= 1 and $_GET["productId"] <= 3 ) {
    
            $productId = (int) $_GET["productId"];
    
            if ( !isset( $_SESSION["cart"][$productId] ) ) {
      
                $_SESSION["cart"][$productId] = $products[$productId];
            }
        }
        session_write_close();
        header( "Location: shopping_cart.php" );
    }
    
    function removeItem() {
  
        global $products;
  
        if ( isset( $_GET["productId"] ) and $_GET["productId"] >= 1 and $_GET["productId"] <= 3 ) {
    
            $productId = (int) $_GET["productId"];
    
            if ( isset( $_SESSION["cart"][$productId] ) ) {
      
                unset( $_SESSION["cart"][$productId] );
            }
        }
  
        // Note that the function calls the PHP function session_write_close() just before sending the Location: header. This forces the data in the $_SESSION array to be written to the session file on the server’s hard disk. Although PHP usually does this anyway when the script exits, it’s a good idea to call session_write_close() before redirecting or reloading the browser to ensure that the $_SESSION data is written to disk and available for the next browser request.
        session_write_close();
        header( "Location: shopping_cart.php" );
    }
 
// Finally, displayCart() displays the user’s cart, as well as the list of available products. After displaying an XHTML page header, the function loops through each item in the cart, displaying the product name, price, and a Remove link that allows the user to remove the product from his cart. It also totals the prices of all the products in the cart as it goes, then displays the total below the cart.
    function displayCart() {
  
        global $products;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>A shopping cart using sessions</title>
    <link rel="stylesheet" type="text/css" href="common.css" />
  </head>

  <body>
    <h1>Your shopping cart</h1>

// The displayCart() function then lists the available products, along with their prices. Each product has a corresponding Add Item link that the shopper can use to add the product to his cart.
   <dl>

    <?php

        $totalPrice = 0;

        foreach ( $_SESSION["cart"] as $product ) {
  
            $totalPrice += $product->getPrice();
        ?>

      <dt><?php echo $product->getName() ?></dt>
      <dd>$<?php echo number_format( $product->getPrice(), 2 ) ?>

      <a href="shopping_cart.php?action=removeItem&productId=<?php echo $product->getId() ?>">Remove</a></dd>
    <?php
        }
        ?>

      <dt>Cart Total:</dt>
      <dd><strong>$<?php echo number_format( $totalPrice, 2 ) ?></strong></dd>

   </dl>

    <h1>Product list</h1>
    <dl>

    <?php foreach ( $products as $product ) {
    ?>
      <dt><?php echo $product->getName() ?></dt>
      <dd>$<?php echo number_format( $product->getPrice(), 2 ) ?>
      <a href="shopping_cart.php?action=addItem&amp;productId=<?php echo $product->getId() ?>">Add Item</a></dd>
    <?php
        }
        ?>
   </dl>

    <?php }
        ?>
  </body>
</html>
