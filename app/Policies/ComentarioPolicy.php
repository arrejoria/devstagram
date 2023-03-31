<?php

namespace App\Policies;

use App\Models\Comentario;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComentarioPolicy
{
    use HandlesAuthorization;

   
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Comentario $comentario)
    {
        return $user->id === $comentario->user_id;
    }

}
