<?php

namespace App\Users;

use App\Account;
use Illuminate\Database\Eloquent\Collection;

class UsersRepository
{
    public function getUsersOfAccount(Account $account): Collection
    {
        return $account->users()->get();
    }
}
