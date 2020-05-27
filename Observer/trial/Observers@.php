<?php


# # # # # # # # # # # # # # # # # # # # # # # # # # # # # ## # #
// push pull method
interface IObserverable
{
    public function work();
    public function notify();
}

class Observerable implements IObserverable
{
    private $IObserver = null;
    private $worker = null;

    public function __construct(IObserver $IObserver=null)
    {
        $this->IObserver = $IObserver;
    }

    public function work()
    {
        $this->worker = "<br>my watch shows this time" . date('Y-m-d-H-i-s');
        echo $this->worker;
    }

    public function notify()
    {
        $this->IObserver->status();
    }
}


interface IObserver
{
    public function status();
}


class ObserverOne implements IObserver
{
    private $IObserverable = null;

    public function __construct(IObserverable $IObserverable)
    {
        $this->IObserverable = $IObserverable;
    }

    public function status()
    {
        $this->IObserverable->work();
    }
}
$ObserverOne = new ObserverOne(new Observerable());
$Observerable = new Observerable($ObserverOne);

$Observerable->notify();
sleep(1);

sleep(1);

$Observerable->notify();
sleep(1);

$Observerable->notify();
$Observerable->notify();
sleep(1);

$Observerable->notify();
$ObserverOne1 = new ObserverOne(new Observerable());
$Observerable = new Observerable($ObserverOne1);
sleep(1);
$Observerable->notify();
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # ## # #
