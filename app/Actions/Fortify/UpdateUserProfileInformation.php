<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;


class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'birthdate' => ['nullable','date'],
            'name_artistic' => ['nullable', 'string', 'max:255'],
            'cnpj' => ['nullable', 'string', 'max:255'],
            'corporativename' => ['nullable', 'string', 'max:255'],
            'phone'=> ['required', 'string'],
            'fantasyname'=> ['required', 'string'],
            'branch'=> ['required', 'string'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            /*-----Redes Sociais------*/
            'instagram'=> ['nullable', 'string'],
            'twitter'=> ['nullable', 'string'],
            'tiktok'=> ['nullable', 'string'],
            'kwai'=> ['nullable', 'string'],
            'twitch'=> ['nullable', 'string'],
            'facebook'=> ['nullable', 'string'],
            'youtube'=> ['nullable', 'string'],
            'nimo'=> ['nullable', 'string'],
            'trovo'=> ['nullable', 'string'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (isset($input['name_artistic'])) {
            $user->forceFill([
                'name_artistic' => $input['name_artistic'],
            ])->save();
        }

        if (isset($input['birthdate'])) {
            $user->forceFill([
                'birthdate' => $input['birthdate'],
            ])->save();
        }

        if (isset($input['cnpj'])) {
            $user->forceFill([
                'cnpj' => $input['cnpj'],
            ])->save();
        }

        if (isset($input['corporativename'])) {
            $user->forceFill([
                'corporativename' => $input['corporativename'],
            ])->save();
        }

        if (isset($input['phone'])) {
            $user->forceFill([
                'phone' => $input['phone'],
            ])->save();

        }if (isset($input['fantasyname'])) {
            $user->forceFill([
                'fantasyname' => $input['fantasyname'],
            ])->save();

        }if (isset($input['branch'])) {
            $user->forceFill([
                'branch' => $input['branch'],
            ])->save();

            /*-----Redes Sociais------*/
        }if (isset($input['instagram'])) {
            $user->forceFill([
                'instagram' => $input['instagram'],
            ])->save();
        }if (isset($input['twitter'])) {
            $user->forceFill([
                'twitter' => $input['twitter'],
            ])->save();
        }if (isset($input['tiktok'])) {
            $user->forceFill([
                'tiktok' => $input['tiktok'],
            ])->save();
        }if (isset($input['kwai'])) {
            $user->forceFill([
                'kwai' => $input['kwai'],
            ])->save();
        }if (isset($input['twitch'])) {
            $user->forceFill([
                'twitch' => $input['twitch'],
            ])->save();
        }if (isset($input['facebook'])) {
            $user->forceFill([
                'facebook' => $input['facebook'],
            ])->save();
        }if (isset($input['youtube'])) {
            $user->forceFill([
                'youtube' => $input['youtube'],
            ])->save();
        }if (isset($input['nimo'])) {
            $user->forceFill([
                'nimo' => $input['nimo'],
            ])->save();
        }if (isset($input['trovo'])) {
            $user->forceFill([
                'trovo' => $input['trovo'],
            ])->save();
        }
        /*-------------------------*/

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
