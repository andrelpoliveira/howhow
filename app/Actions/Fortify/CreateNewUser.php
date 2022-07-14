<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     * Data validation and storage
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'birthdate'=> ['required', 'date'],
            'phone'=> ['required', 'string', 'max:15'],
            'genre'=> ['required', 'string'],
            'name'=> ['required', 'string', 'max:255'],
            'name_artistic'=> ['required', 'string', 'max:255'],
            'layout'=> [],
            'language'=> [],
            'agency'=> [],
            'instagram'=> [],
            'twitter'=> [],
            'tiktok'=> [],
            'kwai'=> [],
            'twitch'=> [],
            'facebook'=> [],
            'youtube'=> [],
            'nimo'=> [],
            'trovo'=> [],
            'engament'=> [],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'birthdate' => $input['birthdate'],
                'phone' => $input['phone'],
                'genre' => $input['genre'],
                'name' => $input['name'],
                'name_artistic' => $input['name_artistic'],
                'layout' => $input['layout'],
                'language' => $input['language'],
                'agency' => $input['agency'],
                'instagram' => $input['instagram'],
                'twitter' => $input['twitter'],
                'tiktok' => $input['tiktok'],
                'kwai' => $input['kwai'],
                'twitch' => $input['twitch'],
                'facebook' => $input['facebook'],
                'youtube' => $input['youtube'],
                'nimo' => $input['nimo'],
                'trovo' => $input['trovo'],
                'engament'=> $input['engament'],
            ]),

                function (User $user) {
                $this->createTeam($user);

            });
        });
    }



    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
