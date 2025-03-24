<?php

use App\Features;
use App\Subfeatures;
use App\UserAccessModule;

function checkRoles($role_id, $name="")
{
    $subfeatures = Subfeatures::where('subfeature_name', $name)->first();
    
    if ($subfeatures)
    {
        $module = UserAccessModule::where('role_id', $role_id)->where('subfeature_id', $subfeatures->id)->first();
        if ($module)
        {
            return true;
        }
    }
    
    return false;
}
function checkModule($role_id, $name="")
{
    $feature = Features::where('feature', $name)->first();
    
    if ($feature)
    {
        $module = UserAccessModule::where('role_id', $role_id)->where('feature_id', $feature->id)->first();
        if ($module)
        {
            return true;
        }
    }
    
    return false;
}