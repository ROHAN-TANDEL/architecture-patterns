<?php

# Stratergy without open and close principle
class BuildCars implements ICarMoment, ICarSeats
{
    private $carMoment = null;
    private $carSeats = null;
    public function __construct(ICarMoment $CarMoment, ICarSeats $carSeats =null)
    {
        $this->carMoment = $CarMoment;
        $this->carSeats = $carSeats;
    }

    public function carMoment()
    {
        $this->carMoment->carMoment();
    }

    public function carSeats()
    {
        $this->carSeats->carSeats();
    }

    public function execute()
    {
        $this->carMoment();
        $this->carSeats();
    }
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
interface ICarMoment
{
    public function carMoment();
    public function execute();
}

class FastMoment implements ICarMoment
{
    public function carMoment()
    {
        echo "<br>I move Fast<br>";
    }

    public function execute()
    {
        $this->carMoment();
    }
}

class MediumMoment implements ICarMoment
{
    public function carMoment()
    {
        echo "<br>I move Medium<br>";
    }

    public function execute()
    {
        $this->carMoment();
    }
}

class SlowMoment implements ICarMoment
{
    public function carMoment()
    {
        echo "<br> I move slow <br>";
    }

    public function execute()
    {
        $this->carMoment();
    }
}

class NoMoment implements ICarMoment
{
    public function carMoment()
    {
        echo "<br>I do NOT move<br>";
    }

    public function execute()
    {
        $this->carMoment();
    }
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
interface ICarSeats
{
    public function carSeats();
    public function execute();
}

class RacingSeats implements IcarSeats
{
    public function carSeats()
    {
        echo "<br>I have only single seat<br>";
    }

    public function execute()
    {
        $this->carSeats();
    }
}

class CommuteSeats implements IcarSeats
{
    public function carSeats()
    {
        echo "<br>I have only four seat<br>";
    }

    public function execute()
    {
        $this->carSeats();
    }
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
interface ICarEdition
{
    public function carEdition();
    public function execute();
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
interface ICarDoors
{
    public function carDoors();
    public function execute();
}

class SingleDoor extends BuildCars implements ICarDoors
{
    public function carDoors()
    {
        echo "<br>I have onlh 1 door<br>";
    }

    public function execute()
    {
        $this->carDoors();
    }
}

class MultiDoor extends BuildCars implements ICarDoors
{
    public function carDoors()
    {
        echo "<br>I have multi door<br>";
    }

    public function execute()
    {
        $this->carDoors();
    }
}

// dynamic clients
echo "<br># # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #<br>";
echo "toy car";
$toyCar = (new BuildCars(new NoMoment(), new CommuteSeats()))->execute();
echo "<br># # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #<br>";

echo "<br># # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #<br>";
echo "super car";
$superCar = (new BuildCars(new FastMoment(), new RacingSeats()))->execute();
echo "<br># # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #<br>";


echo "<br># # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #<br>";
echo "office car";
$officeCar = (new BuildCars(new MediumMoment(), new CommuteSeats()))->execute();
// dynamic clients
echo "<br># # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #<br>";
echo "custom car";
$oldCar = (new BuildCars(new FastMoment(), new CommuteSeats()))->execute();
echo "<br># # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #<br>";

// static clients
echo "<br><br><br><br><br># # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #<br>";
echo "old car";
$oldCar = (new BuildCars(new SlowMoment(), new CommuteSeats()))->execute();
echo "<br># # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #<br>";
