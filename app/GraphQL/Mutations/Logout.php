<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;

final class Logout
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args): ?User
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return $user;
    }
}
