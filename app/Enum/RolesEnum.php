<?php

namespace App\Enum;

enum RolesEnum: String
{
    case Admin = 'Admin';

    case Manager = 'Manager';

    case SuperAdmin = 'SuperAdmin';

    case Sales = 'Sales';

    case User = 'User';
}
