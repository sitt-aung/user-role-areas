<?php

namespace App\Enums;

enum RoleEnum: int
{
    case STUDENT = 1;
    case TEACHER = 2;
    case ADMIN = 3;
}