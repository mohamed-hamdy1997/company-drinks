<?php

function checkType($user, $type)
{
    if ($user->type === $type)
        return back()->with('error', 'Your not Authorize to take this action');
}
