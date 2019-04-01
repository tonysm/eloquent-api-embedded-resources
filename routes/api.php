<?php

use App\Account;
use Illuminate\Http\Request;
use App\Users\UsersRepository;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\AccountCollection;
use App\Organisations\OrganisationsRepository;
use App\Http\Resources\Account as AccountResource;

Route::get('accounts', function (UsersRepository $users, OrganisationsRepository $organisations) {
    $embeds = explode(',', request()->get('include', ''));

    $accounts = Account::query()->paginate();

    return (new AccountCollection($accounts))
        ->embedUsersIf(in_array('users', $embeds), $users)
        ->embedOrganisationsIf(in_array('organisations', $embeds), $organisations);
});

Route::get('accounts/{account}', function (Account $account, UsersRepository $users, OrganisationsRepository $organisations) {
    $embeds = explode(',', request()->get('include', ''));

    return (new AccountResource($account))
        ->embedUsersIf(in_array('users', $embeds), $users)
        ->embedOrganisationsIf(in_array('organisations', $embeds), $organisations);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
