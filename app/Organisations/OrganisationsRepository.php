<?php

namespace App\Organisations;

use App\Account;
use Illuminate\Database\Eloquent\Collection;

class OrganisationsRepository
{
    public function getOrganisationsForAccount(Account $account): Collection
    {
        return $account->organisations()->get();
    }

    public function getOrganisationsForAccountsKeyedByAccountId(Collection $accounts): Collection
    {
        return $accounts
            ->load('organisations')
            ->mapWithKeys(function ($account) {
                return [$account->id => $account->organisations];
            });
    }
}
