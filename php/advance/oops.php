<?php

//class and objects
class students{
    public $name;
    public $age;

    function set_name($name){
         $this->name = $name;
    }
   //  function get_name(){
   //      return $this->name;
   //  }
}

$stu1 = new students();
$stu1->set_name("vishv");
echo $stu1->name;
echo "<br>";


//INHERITANCE---------------------------------------------------------
 class student1{
    public $name;
    public $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
    protected function intro(){
        echo "student name is {$this->name} and age is {$this->age}.". "\n";
    }
}
class Vishv extends student1{
    public function quote(){
        // Call protected method from within derived class
        $this->intro();
        echo "no flowers can grow without rain, and no man can grow without pain". "<br>";
    }
}
$vishv = new Vishv("vishv", 21);
// $vishv->intro();
$vishv->quote();//quote() is public and it calls intro() (which is protected) from within the derived class


//CLASS CONSTANT---------------------------------------------
class hello{
    const GREETING = "Hello". "<br>";
    
    public function greet(){// for use inside the class
        echo self::GREETING;
    }
}
$obj = new hello();
$obj->greet();
// echo hello::GREETING; //for use outside the class


//ABSTRACT CLASS------------------------------------------------------
abstract class parentClass{
    abstract protected function prefix($name);
}

class childClass extends parentClass{
    // The child class may define optional arguments that are not in the parent's abstract method
    public function prefix($name, $separator = ".", $greet = "Dear")
    {
        if($name == "vishv"){
            $preFix = "Mr";
        }   elseif ($name == "vishwa") {
            $preFix = "Mrs";
        }   else{
            $preFix = "";
        }
        return "{$greet} {$preFix}{$separator} {$name}";
    } 
}

$obj = new childClass();
echo $obj->prefix("vishv"). "<br>";
echo $obj->prefix("vishwa"). "<br>";

//STATIC PROPERTIES---------------------------------------
class a1{
    public static $staticProp = "vishv". "<br>";

    public function staticVal(){
        return self::$staticProp;
    }
}

// echo a1::$staticProp;
$obj = new a1();
echo $obj -> staticVal();

//polymorphism
interface Machine {
      public function calcTask();
   }
   class Circle implements Machine {
      private $radius;
      public function __construct($radius){
         $this -> radius = $radius;
      }
      public function calcTask(){
         return $this -> radius * $this -> radius * pi(). "<br>";
      }
   }
   class Rectangle implements Machine {
      private $width;
      private $height;
      public function __construct($width, $height){
         $this -> width = $width;
         $this -> height = $height;
      }
      public function calcTask(){
         return $this -> width * $this -> height. "<br>";
      }
   }
   $mycirc = new Circle(3);
   $myrect = new Rectangle(3,4);
   echo $mycirc->calcTask();
   echo $myrect->calcTask();

   //ABSTRACT CLASS
   abstract class car{
      public $name;
      public function __construct($name)
      {
         $this->name = $name;
      }
      abstract public function intro(): string;
   }

   class bmw extends car{
      public function intro(): string{
         return "im bmw". "<br>";
      }
   }

   $obj = new bmw("bmw");
    echo $obj-> intro();
