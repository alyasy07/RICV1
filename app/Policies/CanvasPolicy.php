<?php

namespace App\Policies;

use App\Models\Canvas;
use App\Models\User;

class CanvasPolicy
{
    public function view(User $user, Canvas $canvas)
    {
        return $user->userID === $canvas->user_id;
    }

    public function update(User $user, Canvas $canvas)
    {
        return $user->userID === $canvas->user_id;
    }

    public function delete(User $user, Canvas $canvas)
    {
        return $user->userID === $canvas->user_id;
    }
}