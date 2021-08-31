<?php

namespace jossc\particles\command;

use jossc\particles\Main;
use jossc\particles\storage\ParticlesStorage;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class HeartParticlesCommand extends Command {

    /*** @var ParticlesStorage */
    private $storage;

    public function __construct() {
        parent::__construct(
            'hparticles',
            'Generates a heart particle when walking.',
            '/hparticles',
            ['hearparticles']
        );

        $this->storage = Main::getInstance()->getStorage();
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!($sender instanceof Player)) {
            $sender->sendMessage(TextFormat::RED . 'Please use this command in-game!');

            return false;
        }

        $player = $sender->getPlayer();

        $storage = $this->storage;

        if ($storage->contains($player->getName())) {
            $storage->remove($player->getName());

            $sender->sendMessage(TextFormat::RED . 'You have deactivated the particle of hearts!');

        } else {
            $storage->add($player->getName());

            $sender->sendMessage(TextFormat::GREEN . 'You have activated the particle of hearts!');
        }

        return true;
    }
}