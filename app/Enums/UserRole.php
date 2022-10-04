<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static COMMUN_USER()
 * @method static static MODERATOR()
 * @method static static ADMIN()
 */
final class UserRole extends Enum
{
    const COMMON_USER = 1;
    const MODERATOR = 2;
    const ADMIN = 3;
}
