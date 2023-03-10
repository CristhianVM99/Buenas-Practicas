<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Pais;
use App\Models\IdeaProyecto;
use App\Models\User;
use App\Services\FileService;

class ProfileController extends Controller
{
    const DIR_AVATAR        = 'avatars';
    const DEFAULT_AVATAR    = 'images/default-user.png';

    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        
        return view('perfil.edit', [
            'imgDefault'=> self::DEFAULT_AVATAR,
            'paises'    => Pais::all(),
            'registros' => IdeaProyecto::where('created_by', Auth()->user()->id)->get(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function setAvatar(Request $request, User $user)
    {
        $url = FileService::storeFile($request->avatar,  self::DIR_AVATAR, $user->id);
        if( $url )
        {
            if( is_null($user->avatar) || $user->avatar != $url)
            {
                $user->avatar = $url;
                $user->save();
            }
            return response('Imagen Actualizada!', 200);
        }
        return response('Error al guardar la Imagen', 404);
    }

    public function getAvatar(User $user)
    {
        $url = FileService::getUrl( $user->avatar );
        return $url? response()->file( $url ): null;
    }
}
