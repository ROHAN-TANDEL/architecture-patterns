<?php
echo "<h1>Strategy</h1>";

/**
 * BuildCars class
 * Stratergy with non (not) open and close principle
 * this is Client
 */
abstract class BuildCars implements ICarMoment, ICarSeats
{
    /**
     * carMoment variable
     *
     * @var [null]
     */
    private $carMoment = null;

    /**
     * carSeats variable
     *
     * @var [null]
     */
    private $carSeats = null;

    /**
     * __construct function
     * Dependancy Injection without
     * holding the injected object life cycle
     *
     * @param ICarMoment $CarMoment
     * @param ICarSeats $carSeats
     */
    public function __construct(ICarMoment $CarMoment, ICarSeats $carSeats =null)
    {
        $this->carMoment = $CarMoment;
        $this->carSeats = $carSeats;
    }

    /**
     * carMoment function
     *
     * @return void
     */
    public function carMoment()
    {
        $this->carMoment->carMoment();
    }

    /**
     * carSeats function
     *
     * @return void
     */
    public function carSeats()
    {
        $this->carSeats->carSeats();
    }

    /**
     * execute function
     * encapsulation
     * @return void
     */
    abstract public function execute();
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

/**
 * ICarMoment interface
 */
interface ICarMoment
{
    public function carMoment();
    public function execute();
}

/**
 * FastMoment class
 */
class FastMoment implements ICarMoment
{
    /**
     * carMoment function
     *
     * @return void
     */
    public function carMoment()
    {
        echo "<br>I move Fast<br>";
    }

    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carMoment();
    }
}

/**
 * MediumMoment class
 */
class MediumMoment implements ICarMoment
{
    /**
     * carMoment function
     *
     * @return void
     */
    public function carMoment()
    {
        echo "<br>I move Medium<br>";
    }

    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carMoment();
    }
}

/**
 * SlowMoment class
 */
class SlowMoment implements ICarMoment
{
    /**
     * carMoment function
     *
     * @return void
     */
    public function carMoment()
    {
        echo "<br> I move slow <br>";
    }

    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carMoment();
    }
}


/**
 * NoMoment class
 */
class NoMoment implements ICarMoment
{
    /**
     * carMoment function
     *
     * @return void
     */
    public function carMoment()
    {
        echo "<br>I do NOT move<br>";
    }

    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carMoment();
    }
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
/**
 * ICarSeats interface
 * Structure for Alog 2
 */
interface ICarSeats
{
    public function carSeats();
    public function execute();
}

/**
 * RacingSeats class
 * Algorithm 2
 */
class RacingSeats implements IcarSeats
{
    /**
     * carSeats function
     *
     * @return void
     */
    public function carSeats()
    {
        echo "<br>I have only single seat<br>";
    }

    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carSeats();
    }
}

/**
 * CommuteSeats class
 */
class CommuteSeats implements IcarSeats
{
    /**
     * carSeats function
     *
     * @return void
     */
    public function carSeats()
    {
        echo "<br>I have only four seat<br>";
    }

    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carSeats();
    }
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
#   non dynamic clients
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
/**
 * ToyCar class
 */
class ToyCar extends BuildCars
{
    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carMoment();
        $this->carSeats();
    }
}

/**
 * FastCar class
 */
class FastCar extends BuildCars
{
    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carMoment();
        $this->carSeats();
    }
}

/**
 * OfficeCar class
 */
class OfficeCar extends BuildCars
{
    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carMoment();
        $this->carSeats();
    }
}

/**
 * CustomCar class
 */
class CustomCar extends BuildCars
{
    /**
     * execute function
     * encapsulation
     * @return void
     */
    public function execute()
    {
        $this->carMoment();
        $this->carSeats();
    }
}

function main()
{
    echo "<br># # # # # # # # # # # # #  #r<br>";
    echo "toy car";
    $toyCar = (new ToyCar(new NoMoment(), new CommuteSeats()))->execute();
    echo "<br># # # # # # # # # # # # #  #o<br>";

    echo "<br> # # # # # # # # # # # # # #h<br>";
    echo "super car";
    $superCar = (new FastCar(new FastMoment(), new RacingSeats()))->execute();
    echo "<br> # # # # # # # # # # # # # #a<br>";


    echo "<br> # # # # # # # # # # # # # #n<br>";
    echo "Custom car";
    $officeCar = (new OfficeCar(new FastMoment(), new RacingSeats()))->execute();
    /** call flow - FastMoment - __construct ------>CommuteSeats - __construct ------>BuildCars - __construct ------>officeCar execute ------>BuildCars - carMoment ------>FastMoment - __carMoment (I move Fast) ------>BuildCars - carSeats ------>CommuteSeats - carSeats (I have only four seat) */
    echo "<br> # # # # # # # # # # # # # #<br>";
}

main();
