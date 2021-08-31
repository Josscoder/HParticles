<?php

namespace jossc\particles\storage;

class ParticlesStorage {

    /*** @var array */
    private $sessions = [];

    /*** @return array */
    public function getSessions(): array
    {
        return $this->sessions;
    }

    /**
     * @param string $userName
     * @return bool
     */
    public function contains(string $userName): bool {
        return isset($this->sessions[$userName]);
    }

    /*** @param string $userName */
    public function add(string $userName): void {
        $this->sessions[$userName] = $userName;
    }

    /*** @param string $userName */
    public function remove(string $userName): void {
        unset($this->sessions[$userName]);
    }
}