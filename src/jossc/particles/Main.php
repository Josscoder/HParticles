<?php

namespace jossc\particles;

use jossc\particles\command\HeartParticlesCommand;
use jossc\particles\listener\EventListener;
use jossc\particles\storage\ParticlesStorage;
use jossc\particles\task\ParticlesTask;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

    /*** @var Main */
    private static $instance;

    /*** @var ParticlesStorage */
    private $storage;

    public function onEnable()
    {
        parent::onEnable();

        self::$instance = $this;
        $this->storage = new ParticlesStorage();

        $this->getServer()->getCommandMap()->register(
            'particles',
            new HeartParticlesCommand()
        );

        $this->getServer()->getPluginManager()->registerEvents(
            new EventListener(),
            $this
        );

        $this->getScheduler()->scheduleRepeatingTask(
            new ParticlesTask(),
            5
        );

        $this->getLogger()->info(TextFormat::GREEN . 'This plugin has been enabled!');
    }

    public function onDisable()
    {
        parent::onDisable();

        $this->getLogger()->info(TextFormat::RED . 'This plugin has been disabled!');
    }

    /*** @return Main */
    public static function getInstance(): Main
    {
        return self::$instance;
    }

    /*** @return ParticlesStorage */
    public function getStorage(): ParticlesStorage
    {
        return $this->storage;
    }
}