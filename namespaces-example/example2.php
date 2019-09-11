<?php
// This example demonstrates the use of namespaces to resolve naming conflicts
namespace NS1 {
    class Foo {
        function __construct() {
            print "Class " . __CLASS__ . " from " . __NAMESPACE__ . " instantiated.\n";
        }
    }
}

namespace NS2 {
    class Foo {
        function __construct() {
            print "Class " . __CLASS__ . " from " . __NAMESPACE__ . " instantiated.\n";
        }
    }
}

namespace MySpace {
    class Foo {
        function __construct() {
            print "Class " . __CLASS__ . " from " . __NAMESPACE__ . " instantiated.\n";
        }
    }

    print "This code is executing in " . __NAMESPACE__ . "\n";
    $foo  = new Foo;
    $foo1 = new \NS1\Foo;  // Fully Qualified Class Name (FQCN)
    $foo2 = new \NS2\Foo;
//    use \NS1\Foo;  // Fatal Error: Name Foo is already defined (in this namespace)
    use \NS1\Foo as Bar;  // Imports Foo from NS1 as Bar
    $foo3 = new Bar;
}

namespace {
    // global namespace
    // class Foo {}
    use \NS1\Foo;  // Same line as above, but it works fine because Foo is NOT defined in this namespace
    $foo4 = new Foo;
}
?>
