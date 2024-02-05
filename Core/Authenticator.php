<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password): bool
    {
        // todo ?
        $user = App::resolve(Database::class)
            ->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            // check password hash
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email
                ]);

                return true;
            }
        }

        return false;
    }

    public function login($user): void
    {
        // set session to login, just by adding email in this case
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        // for security measures
        session_regenerate_id(true);
    }

    public function logout(): void
    {
        Session::destroy();
    }
}