<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserGroupPermission extends Enum
{
    const ONLY_VIEW = 1;
    const CAN_POST_QUESTION = 2;
    const CAN_REPLY = 3;
    const CAN_DO_ANYTHING = 4;
}
