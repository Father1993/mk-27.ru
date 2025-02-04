<?php
// Админский принт
function pprint($mess, $vd = false):void
{
    global $USER;
    if (!$USER) $USER = new CUser();
    if ($USER->isAdmin() && ($USER->GetID() == 1 || $USER->GetID() == 5016))
    {
        echo "<pre>";
        
        if ($vd)
        {
            var_dump($mess);
        }
        else
        {
            print_r($mess);
        }
        
        echo "</pre>";
    }
}