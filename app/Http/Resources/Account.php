<?php

namespace App\Http\Resources;

use App\Organisations\OrganisationsRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class Account extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function embedUsers(bool $shouldEmbed, \App\Users\UsersRepository $users): Account
    {
        if ($shouldEmbed) {
            $this->mergeAdditional([
                'included' => [
                    'users' => [
                        $this->resource->id => User::collection($users->getUsersOfAccount($this->resource)),
                    ],
                ],
            ]);
        }

        return $this;
    }

    public function embedOrganisations(bool $shouldInclude, OrganisationsRepository $organisations): Account
    {
        if ($shouldInclude) {
            $this->mergeAdditional([
                'included' => [
                    'organisations' => [
                        $this->resource->id => Organisation::collection($organisations->getOrganisationsForAccount($this->resource)),
                    ],
                ],
            ]);
        }

        return $this;
    }

    private function mergeAdditional(array $additional)
    {
        $this->additional(array_merge_recursive($this->additional, $additional));
    }
}
