<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;     // hard-coded

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// check condition, abort if false
authorize($note['user_id'] === $currentUserId);

// condition is true, so continue: delete note
$db->query('delete from notes where id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
exit();
