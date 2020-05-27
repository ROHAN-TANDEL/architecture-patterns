<?php

echo "<h1>SINGLETON</h1><pre>";
echo "# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #";
////////////////////////////////////////////////////////////////////////

/**
 * Singleton class
 */
class Singleton
{
    /**
     * instance variable
     *
     * @var [null]
     */
    private static $instance = null;
    
    /**
     * __construct function
     */
    private function __construct()
    {
    }
    
    /**
     * __clone function
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * getInstance function
     *
     * @return object
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            $current_class = static::class;
            self::$instance = new $current_class();
        }

        return self::$instance;
    }
}



$obj1 = Singleton::getInstance();
$obj2 = Singleton::getInstance();

var_dump($obj2);
var_dump($obj1);

if ($obj1 === $obj2) {
    echo "<br>singleton  eual objs<br>";
} else {
    // never executes
    echo "<br>singleton are not eql<br>";
}
echo "# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #";




////////////////////////////////////////////////////////////////////////
/// non singleton
/**
 * ClassX class
 */
class ClassX
{
    /**
     * instance variable
     *
     * @var [null]
     */
    public $instance = null;
    
    /**
     * __construct function
     */
    public function __construct()
    {
        $this->instance = 1;
    }
}


$objX1 = new ClassX();
$objX2 = new ClassX();

var_dump($objX1);
var_dump($objX2);
if ($objX1 === $objX2) {
    echo "<br>non-single ton are eual too<br>";
} else {
    echo "<br> no non-singleton classes are not equal<br>";
}
echo "# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #";

////////////////////////////////////////////////////////////////////////

// calling singelton with classx

/**
 * SingletonWithClassX class
 */
class SingletonWithClassX
{
    /**
     * classX variable
     *
     * @var [null]
     */
    private static $classX = null;
    
    /**
     * instance variable
     *
     * @var [null]
     */
    private static $instance = null;
    
    /**
     * __construct function
     */
    private function __construct()
    {
    }
    
    /**
     * __clone function
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * getInstance function
     *
     * @return object
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            $current_class = static::class;
            self::$instance = new $current_class();
        }

        if (self::$classX == null) {
            self::$classX = new ClassX();
        }

        return self::$instance;
    }

    /**
     * returnClassX function
     *
     * @return object
     */
    public function returnClassX()
    {
        return self::$classX;
    }
}


$objSx1 = SingletonWithClassX::getInstance();
$objSx2 = SingletonWithClassX::getInstance();

var_dump($objSx1);
var_dump($objSx2);

if ($objSx1->returnClassX() === $objSx2->returnClassX()) {
    echo "<br> returned classX with static keyword is equal<br>";
} else {
    echo "<br> returned classX with static keyword is NOT equal<br>";
}

echo "# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #";


// calling singelton with classx

/**
 * SingletonWithClassXnoStat class
 */
class SingletonWithClassXnoStat
{
    /**
         * classX variable
         *
         * @var [null]
         */
    private $classX = null;
    
    /**
     * instance variable
     *
     * @var [null]
     */
    private static $instance = null;
    
    /**
     * __construct function
     */
    private function __construct()
    {
    }
    
    /**
     * __clone function
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * getInstance function
     *
     * @return object
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            $current_class = static::class;
            self::$instance = new $current_class();
        }

        return self::$instance;
    }

    /**
     * returnClassX function
     *
     * @return object
     */
    public function returnClassX()
    {
        return $this->classX = new ClassX();
    }
}


$objSx11 = SingletonWithClassXnoStat::getInstance();
$objSx22 = SingletonWithClassXnoStat::getInstance();

var_dump($objSx11);
var_dump($objSx22);

if ($objSx11->returnClassX() === $objSx22->returnClassX()) {
    echo "<br> returned classX with non static keyword is equal<br>";
} else {
    echo "<br> returned classX with non static keyword is NOT equal<br>";
}
echo "# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #";

////////////////////////////////////////////////////////////////////////

/**
 * NonSingleTonwithStaticObj class
 */
class NonSingleTonwithStaticObj
{
    /**
     * instance variable
     *
     * @var [null]
     */
    private static $instance = null;
    
    /**
     * getInstance function
     *
     * @return object
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            $current_class = static::class;
            self::$instance = new $current_class();
        }

        return self::$instance;
    }
}


$objNSJ1 = NonSingleTonwithStaticObj::getInstance();
$objNSJ2 = new NonSingleTonwithStaticObj();

var_dump($objNSJ1);
var_dump($objNSJ2);

if ($objNSJ1 === $objNSJ2) {
    echo "<br>statically and non statically created objs are same<br>";
} else {
    echo "<br>statically and non statically created objs are NOT same<br>";
}
echo "# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #";

$objNSJ3 = new NonSingleTonwithStaticObj();
$objNSJ4 = NonSingleTonwithStaticObj::getInstance();

var_dump($objNSJ3);
var_dump($objNSJ4);

if ($objNSJ4 === $objNSJ3) {
    echo "<br>reverse order createion - statically and non statically created objs are same<br>";
} else {
    echo "<br>reverse order create- statically and nonstatically created objs are NOT same<br>";
}
echo "# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #";
