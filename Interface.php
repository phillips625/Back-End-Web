<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Creating and Using an Interface</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	<h1>Creating and Using an Interface</h1>
 
          		 <?php
               // This script creates an interface, Sellable, that contains three method declarations
  				        Interface Sellable {

                    public function addStock($numItems);
                    public function sellItem();
                    public function getStockLevel();
                  }

                  /**
                  * Next, two classes — Television and TennisBall — are created. These classes are unrelated and contain quite different properties and methods; for example, Television contains a private $_screenSize property and methods to access it, whereas TennisBall contains a private $_color property with associated methods. However, both classes implement the Sellable interface. This means that they must provide the code to implement the three methods — addStock(), sellItem(), and getStockLevel() — declared in Sellable. This they do. Notice, by the way, that each class has a different way of recording its stock; Television records the stock level in a $_stockLevel property, whereas TennisBall has a $_ballsLeft property. This doesn’t matter at all; from the perspective of the outside world, the important thing is that the classes correctly implement the three methods in the Sellable interface.
                  */
                  class Television implements Sellable
                  {
                      private $_screenSize;
                      private $_stockLevel;
                   
                      public function getScreenSize() {
                        return $this->_screenSize;
                      }
                      public function setScreenSize($screenSize)
                      {
                        $this->_screenSize = $screenSize;
                      }
                     
                      public function addStock($numItems)
                      {
                        $this->_stockLevel += $numItems; 
                      }     
                      public function sellItem()
                      {
                        if ($this->_stockLevel > 0) {
                          
                          $this->_stockLevel--;
                          return true;
                        } 
                        else {
                          return false;
                        }                      
                      }
                      public function getStockLevel()
                      {
                        return $this->_stockLevel;
                      }
                  }

                  class TennisBall implements Sellable {

                      private $_color;
                      private $_ballsLeft;
                      
                      public function getColor() {
                          return $this->_color;
                      }
                      public function setColor( $color ) {
                          $this->_color = $color;
                      }
        
                      public function addStock( $numItems ) {
                          $this->_ballsLeft += $numItems;
                      }
                      public function sellItem() {
                          if ( $this->_ballsLeft > 0 ) {
                              $this->_ballsLeft--;
                              return true;
                          } 
                          else {
                              return false;
                          }
                      }
                      public function getStockLevel() {
                          return $this->_ballsLeft;
                      } 
                    }

                    /*
                        Next, the script creates a StoreManager class to store and handle products for sale in the online store. This class contains a private $_productList array to store different types of products; an addProduct() method to add product objects to the product list; and a stockUp() method that iterates through the product list, adding 100 to the stock level of each product type.                       
                        stockUp() calls the addStock() method of each object to add the stock; it knows that such a method must exist because the objects it deals with implement the Sellable interface. Notice that addProduct() uses type hinting to ensure that all objects that it is passed implement the Sellable interface (you can use type hinting with interface names as well as class names)
                    */
                    class StoreManager {
                        
                        private $_productList = array();

                        public function addProduct( Sellable $product ) {
                            $this->_productList[] = $product;
                        }
                        public function stockUp() {
                          foreach ( $this->_productList as $product ) { // 'array' as 'single item'
                            $product->addStock( 100 );
                          }
                        } 
                      }

                    /*
                      Finally, the script tests the interface and classes. It creates a new Television object, $tv, and sets its screen size to 42 inches. Similarly, it creates a TennisBall object, $ball, and sets its color to yellow. Then the script creates a new StoreManager object, $manager, and adds both the $tv and $ball product types to the stock list using the addProduct() method. Once the products are added, $manager->stockUp() is called to fill the warehouse with 100 units of each item. It then displays information about each product, calling functions specific to the Television and TennisBall classes (getScreenSize() and getColor(), respectively) as well as the getStockLevel() function declared by the Sellable interface.
                      The script then sells some stock by calling the sellItem() method of both the $tv and $ball objects — again, remember that this method is required by the Sellable interface — and redisplays information about both products, including their new stock levels.
                      You can see from this example that interfaces let you unify quite unrelated classes in order to use them for a specific purpose — in this case, to sell them in an online store. You could also define other interfaces; for example, you could create a Shippable interface that tracks the shipping of products, a make both Television and TennisBall implement that interface too. Remember that a class can implement many interfaces at the same time.
                    */
                    $tv = new Television;
                    $tv->setScreenSize( 42 );

                    $ball = new TennisBall;
                    $ball->setColor( "yellow" );

                    $manager = new StoreManager();
                    $manager->addProduct( $tv );
                    $manager->addProduct( $ball );
                    $manager->stockUp();

                    echo "<p>There are ". $tv->getStockLevel() . " " . $tv->getScreenSize();
                    echo "-inch televisions and " . $ball->getStockLevel() . " " . $ball->getColor();
                    echo " tennis balls in stock.</p>";
                    echo "<p>Selling a television...</p>";
  
                    $tv->sellItem();
                    echo "<p>Selling two tennis balls...</p>";

                    $ball->sellItem();
                    $ball->sellItem();
                    echo "<p>There are now ". $tv->getStockLevel() . " " . $tv->getScreenSize();
                    echo "-inch televisions and " . $ball->getStockLevel() . " " . $ball->getColor();
                    echo " tennis balls in stock.</p>";
           		?>
        
        </body>
	</html>