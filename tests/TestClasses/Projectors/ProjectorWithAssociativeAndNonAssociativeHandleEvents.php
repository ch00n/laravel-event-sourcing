<?php

namespace Spatie\EventSourcing\Tests\TestClasses\Projectors;

use Spatie\EventSourcing\Projectors\Projector;
use Spatie\EventSourcing\Projectors\ProjectsEvents;
use Spatie\EventSourcing\Tests\TestClasses\Events\MoneyAddedEvent;
use Spatie\EventSourcing\Tests\TestClasses\Events\MoneySubtractedEvent;

class ProjectorWithAssociativeAndNonAssociativeHandleEvents implements Projector
{
    use ProjectsEvents;

    protected array $handlesEvents = [
        MoneyAddedEvent::class,
        MoneySubtractedEvent::class => 'onMoneySubtracted',
    ];

    public function onMoneyAddedEvent(MoneyAddedEvent $event)
    {
        $event->account->addMoney($event->amount);
    }

    public function onMoneySubtracted(MoneySubtractedEvent $event)
    {
        $event->account->subtractMoney($event->amount);
    }
}
