<?php

namespace Core\Middleware;

class Authenticated
{
    public function handle(): void
    {
        // if no session, redirect to home page
        if (! $_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}