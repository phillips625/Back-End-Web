<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
          <title>Overriding Methods in the Parent Class</title>
            <link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
            <h1>Overriding Methods in the Parent Class</h1>
 
               <?php
          
                 class Fruit {
/*
Notice how the overridden methods, peel() and slice(), are called for the Grape object, 
whereas the parent class’s peel() and slice() methods are called for the Fruit object.
*/
                    public function peel() {
                      echo "<p>I'm peeling the fruit...</p>";
                    }
                    public function slice() {
                      echo "<p>I'm slicing the fruit...</p>";
                    }
                    public function eat() {
                      echo "<p>I'm eating the fruit. Yummy!</p>";
                    }
                    public function consume() {
                      $this->peel();
                      $this->slice();
                      $this->eat();
                    } 
                  }

                  class Grape extends Fruit {

                    public function peel() {
                      echo "<p>No need to peel a grape!</p>";
                    }
                    public function slice() {
                      echo "<p>No need to slice a grape!</p>";
                    } 
                  }
/*
Preserving the Functionality of the Parent Class
Occasionally you want to override the method of a parent class in your child class, but 
also use some of the functionality that is in the parent class’s method. You can do this 
by calling the parent class’s overridden method from within the child class’s method. To 
call an overridden method, you write parent:: before the method name:

Taking the previous Fruit and Grape example, say you want to create a Banana class that 
extends the Fruit class. Generally, you consume a banana like any other fruit, but you also 
need to break the bana off from a bunch of bananas first. So within your Banana class, you 
can override the parent’s consume method to include functionality to break off a banana, 
then call the overridden consume() method fro within the Banana class’s consume() method 
to finish the consumption process:
*/
                    class Banana extends Fruit {

                    public function consume() {
                      echo "<p>I'm breaking off a banana...</p>";
                      parent::consume();
                    } 
                  }

                  echo "<h2>Consuming an apple...</h2>";
                  $apple = new Fruit;
                  $apple->consume();
                  
                  echo "<h2>Consuming a grape...</h2>";
                  $grape = new Grape;
                  $grape->consume();

                  $banana = new Banana;
                  $banana->consume();
              ?>
        
        </body>
  </html>