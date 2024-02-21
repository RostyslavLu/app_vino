<?php

/**
 * Mail Language Lines
 */

return [
    'reset_password' => [
        'subject' => 'Reset Password Notification',
        'greeting' => 'Hello!',
        'action' => 'Reset Password',
        'text' => 'This password reset link will expire in :count minutes.',
        'outro' => 'If you did not request a password reset, no further action is required.',
    ],
];

// -- template email (corp de l'email)
// app_vino\vendor\laravel\framework\src\Illuminate\Auth\Notifications\ResetPassword.php
// -- template email (entête et pied de page de l'email)
// app_vino\vendor\laravel\framework\src\Illuminate\Notifications\resources\views\email.blade.php
