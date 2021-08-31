<?php

namespace jossc\particles\listener;

use jossc\particles\Main;
use jossc\particles\storage\ParticlesStorage;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener {

    /*** @var ParticlesStorage */
    private $storage;

    /*** EventListener constructor.*/
    public function __construct()
    {
        $this->storage = Main::getInstance()->getStorage();
    }

    /*** @param PlayerQuitEvent $event */
    public function onQuit(PlayerQuitEvent $event): void {
        $player = $event->getPlayer();

        $storage = $this->storage;

        if ($storage->contains($player->getName())) {
            $storage->remove($player->getName());
        }
    }
}