<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAvatarRequest;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Monolog\Handler\IFTTTHandler;

class AvatarController extends Controller
{
//    public function update(Request $request) 
   public function update(UpdateAvatarRequest $request): RedirectResponse
  //  Er ekki að fá þetta fall til að virka, fæ alltaf 403 villu, "403 THIS ACTION IS UNAUTHORIZED"
    {

      if($oldAvatar = $request->user()->avatar){
        Storage::disk('public')->delete($oldAvatar);
      }
      // Leið 1
       $path = $request->file('avatar')->store('avatars', 'public');
      // Leið 2 - fæ ekki til að virka.
//      $path = Storage::disk('local')->put('avatars', $request->file('avatar'));

//     dd($path);
      
        auth()->user()->update(['avatar' => $path]) ;

      return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
