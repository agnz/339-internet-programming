<?php
namespace proj1;

// MyClass2 is defined in proj1 namespace so must be instantiated as \proj1\MyClass2.php unless aliased using use command

class MyClass2 {
    function __construct() {
        print("Executing " . __CLASS__ . " constructor\n\n");
    }
    function __toString() {
        return __CLASS__ . " instantiated and working!\n\n";
    }    
}
?>
