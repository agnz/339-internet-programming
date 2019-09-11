<?php
namespace proj1;

// MyClass1 is defined in proj1 namespace so must be instantiated as \proj1\MyClass2.php unless aliased using use command

class MyClass1 {
    function __construct() {
        print("Executing " . __CLASS__ . " constructor\n\n");
    }

    function __toString() {
        return __CLASS__ . " instantiated and working!\n\n";
    }
}
?>
