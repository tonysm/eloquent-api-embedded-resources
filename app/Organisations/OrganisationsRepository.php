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
}
