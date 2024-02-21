<?php

/**
 * Mail Language Lines
 */

return [
    'reset_password' => [
        'subject' => 'Réinitialisation du mot de passe',
        'greeting' => 'Bonjour!',
        'action' => 'Réinitialiser le mot de passe',
        'text' => 'Ce lien de réinitialisation du mot de passe expirera dans :count minutes.',
        'outro' => 'Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune autre action n\'est requise.',
    ],
];
// -- template email (corp de l'email)
// app_vino\vendor\laravel\framework\src\Illuminate\Auth\Notifications\ResetPassword.php
// -- template email (entête et pied de page de l'email)
// app_vino\vendor\laravel\framework\src\Illuminate\Notifications\resources\views\email.blade.php
