<?php

/** There is no allowed to use namespace "interface" before the 8.0 version PHP **/
namespace App\Interfaces;
interface MessageInterface
{
    public function sendMessage(string $receiverEmail): bool;
}


