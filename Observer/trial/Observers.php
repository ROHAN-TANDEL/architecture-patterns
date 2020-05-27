<?php

interface IClients
{
    public function getUpdate($item1, $item2);
}

interface IItems
{
    public function setClients(IClients $Observer);
    public function removeClients(IClients $Observer);
    public function notifyClients();
}

class ItemUpdates implements IItems
{
    private $clientList = null;
    private $item1 = null;
    private $item2 = null;

    public function __construct()
    {
        $this->clientList = [];
    }

    public function setItem1(int $item1)
    {
        $this->item1 = $item1;
        $this->notifyClients();
    }

    public function setItem2(int $item2)
    {
        $this->item2 = $item2;
        $this->notifyClients();
    }

    public function setClients(IClients $addObserver)
    {
        $this->clientList[] = $addObserver;
    }

    public function removeClients(IClients $deleteObserver)
    {
        unset($this->clientList[array_search($deleteObserver, $this->clientList)]);
    }

    public function notifyClients()
    {
        foreach ($this->clientList as $eachCLient) {
            $eachCLient->getUpdate($this->item1, $this->item2);
        }
    }
}

class Clients implements IClients
{
    private $item1 = null;
    private $item2 = null;
    private $clientID = null;
    private $IItems = null;
    private static $clientIDTracker = 0;

    public function __construct(IItems $IItems)
    {
        $this->IItems = $IItems;
        $this->clientID = ++self::$clientIDTracker;

        $this->IItems->setClients($this);
        
        echo "<br> New Observer " . $this->clientID;
    }

    public function getUpdate($item1, $item2)
    {
        $this->item1 = $item1;
        $this->item2 = $item2;
        $this->printItems();
    }

    public function printItems()
    {
        echo "<br>item 1 - $this->item1";
        echo "<br>item 2 - $this->item2";
        echo "<br><br><br>";
    }
}


$Items = new ItemUpdates();
$clients = new Clients($Items);
$Items->setItem1(1);
