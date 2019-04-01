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

    public function getUsersOfAccountsKeyedByAccountId(Collection $accounts): Collection
    {
        return $accounts
            ->load('users')
            ->mapWithKeys(function (Account $account) {
                return [$account->id => $account->users];
            });
    }
}
