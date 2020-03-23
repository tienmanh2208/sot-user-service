<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GroupPrivacy extends Enum
{
    const PUBLIC = 1;
    const PROTECTED = 2;
    const PRIVATE = 3;
}
