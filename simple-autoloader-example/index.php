<?php
require_once "simple_autoloader.php";

// Alias \proj1\MyClass1 name to MyClass1 (same as "use \proj1\MyClass1 as MyClass1")
use \proj1\MyClass1; // Now can refer to \proj1\MyClass1 simply as MyClass1

print("About to instantiate MyClass1\n\n");
$a = new MyClass1();
print($a);

print("About to instantiate MyClass2\n\n");
try {
    $b = new MyClass2(); // this will not work as MyClass2 is in proj1 namespace
} catch (Error $e) {
    print("$e\n\n");
    print("MyClass2 NOT instantiated\n\n");
}

print("About to instantiate MyClass2 proper\n\n");
$b = new \proj1\MyClass2();
print($b);