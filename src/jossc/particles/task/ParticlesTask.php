<?php

namespace jossc\particles\task;

use jossc\particles\Main;
use jossc\particles\storage\ParticlesStorage;
use pocketmine\level\particle\HeartParticle;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class ParticlesTask extends Task {

    /*** @var ParticlesStorage */
    private $storage;

    /*** @var Server */
    private $server;

    /*** ParticlesTask constructor.*/
    public function __construct() {
        $main = Main::getInstance();

        $this->storage = $main->getStorage();
        $this->server = $main->getServer();
    }

    /*** @param int $currentTick */
    public function onRun(int $currentTick) {
        foreach ($this->storage->getSessions() as $value) {
            $player = $this->server->getPlayer($value);

            if (is_null($player)) {
                continue;
            }

            $player->getLevel()->addParticle(
                new HeartParticle(
                    $player->asVector3()->subtract(0, 1)
                )
            );
        }
    }
}