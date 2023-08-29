<?php

namespace App\Enums;


enum UserTypeEnum: string
{
    case ADMIN = 'admin';
    case ARTIST = 'artist';
    case USER = 'user';
}
