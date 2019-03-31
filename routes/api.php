<?php

use App\Account;
use Illuminate\Http\Request;
use App\Users\UsersRepository;
use Illuminate\Support\Facades\Route;
use App\Organisations\OrganisationsRepository;
use App\Http\Resources\Account as AccountResource;

Route::get('accounts/{account}', function (Account $account, UsersRepository $users, OrganisationsRepository $organisations) {
    $embeds = explode(',', request()->get('include', ''));

    return (new AccountResource($account))
        ->embedUsers(in_array('users', $embeds), $users)
        ->embedOrganisations(in_array('organisations', $embeds), $organisations);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
