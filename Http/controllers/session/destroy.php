<?php

use Core\Authenticator;

(new Authenticator)->logout();  // shorthand

header('location: /');
exit();