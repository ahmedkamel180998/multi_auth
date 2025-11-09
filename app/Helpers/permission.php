<?php

function permission($permission)
{
    return Auth::guard('admin')->user()->hasAnyPermission($permission);
}
