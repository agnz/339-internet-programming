<?php
namespace myspace;
include "ns1.php";
include "ns2.php";

// Simple example of using namespaces

function foo() {
    print("Function " . __FUNCTION__ . " from " . __NAMESPACE__ . " namespace.\n\n");
}

print("This code is executing in " . __NAMESPACE__ . " namespace\n\n");

foo();

\NS1\foo();

\NS2\foo();
