<?php

namespace Core\Middleware;

class Guest
{
    public function handle(): void
    {
        // (not used?)
        if ($_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}