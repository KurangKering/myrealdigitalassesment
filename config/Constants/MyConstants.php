<?php

class USER_STATUS
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    public static function all()
    {
        $refl = new ReflectionClass(USER_STATUS::class);
        return $refl->getConstants();
    }
}

class TASK_STATUS
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    public static function all()
    {
        $refl = new ReflectionClass(TASK_STATUS::class);
        return $refl->getConstants();
    }
}
