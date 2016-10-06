<?php
/**
 * Created by IntelliJ IDEA.
 * User: smorken
 * Date: 7/15/14
 * Time: 9:35 AM
 */
return [
    'to'         => explode('|', env('ERROR_EMAIL', 'destroyersdenlarp@gmail.com')),
    'master'     => 'smorken/views::errors.master',
    'email_view' => 'smorken/errors::errors.email',
    'mailer'     => Smorken\Errors\Emailer::class,
    'routes' => [
        'enabled' => false,
        'prefix'  => 'error',
    ],
];
