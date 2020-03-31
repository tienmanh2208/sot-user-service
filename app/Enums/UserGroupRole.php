<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserGroupRole extends Enum
{
    const MEMBER = 1;
    const CONTENT_MANAGEMENT = 2;
}
