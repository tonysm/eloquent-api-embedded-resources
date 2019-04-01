<?php

namespace App\Http\Resources;

use App\Organisations\OrganisationsRepository;
use App\Users\UsersRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AccountCollection extends ResourceCollection
{
    private $includes = [];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (! empty($this->includes)) {
            $this->additional(['included' => $this->includes]);
        }

        return parent::toArray($request);
    }

    public function embedUsersIf(bool $shouldEmbed, UsersRepository $users): AccountCollection
    {
        if ($shouldEmbed) {
            $this->includes['users'] = $users->getUsersOfAccountsKeyedByAccountId($this->accountsCollection())
                ->map(function($users) {
                    return User::collection($users);
                });
        }

        return $this;
    }

    private function accountsCollection(): Collection
    {
        return Collection::wrap($this->collection->map->resource->all());
    }

    public function embedOrganisationsIf(bool $shouldEmbed, OrganisationsRepository $organisations): AccountCollection
    {
        if ($shouldEmbed) {
            $this->includes['organisations'] = $organisations->getOrganisationsForAccountsKeyedByAccountId($this->accountsCollection())
                ->map(function ($organisations) {
                    return Organisation::collection($organisations);
                });
        }

        return $this;
    }
}
