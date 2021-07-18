<?php

// function check_access($role_id, $permission_id)
// {
//     $usersModel = new \App\Models\UsersModel();

//     return $usersModel->groupPermissions($role_id, $permission_id);
// }

function getActivityLogAutoId()
{
    $log_model =  new \App\Models\log_model();
    $maxValId   = $this->log_model->getMaxId();
    $number     = $maxValId['log_id'];
    $codeCount  = ($number + 1);
    $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
    return $codeAuto;
}
