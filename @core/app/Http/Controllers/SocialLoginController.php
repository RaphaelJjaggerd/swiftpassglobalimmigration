<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Psy\Util\Str;
use App\Http\Controllers\UserLocationController;


class SocialLoginController extends Controller {

  public function facebook_redirect() {
    return Socialite::driver('facebook')->redirect();
  }

  public function facebook_callback() {
    try {

      $user_fb_details = Socialite::driver('facebook')->user();

      $user_details = User::where('email', $user_fb_details->getEmail())->first();
      if ($user_details) {
        Auth::login($user_details);
        return redirect()->intended('user-home/#');
      } else {
        $new_user = User::create([
          'username' => 'fb_' . explode('@', $user_fb_details->getEmail())[0],
          'name' => $user_fb_details->getName(),
          'email' => $user_fb_details->getEmail(),
          'facebook_id' => $user_fb_details->getId(),
          'password' => Hash::make(\Illuminate\Support\Str::random(8))
        ]);

        // // Fetch user location using UserLocationController
        // $locationController = new UserLocationController();
        // $userLocation = $locationController->getUserInfo(request());

        // // Update the user's location
        // $new_user->location = $userLocation;
        // $new_user->save();

        Auth::login($new_user);
        return redirect()->intended('user-home/#');
      }
    } catch (\Exception $e) {
      return redirect()->intended('login/#')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
    }
  }

  public function google_redirect() {
    return Socialite::driver('google')->redirect();
  }

  public function google_callback() {
    try {

      $user_fb_details = Socialite::driver('google')->user();

      $user_details = User::where('email', $user_fb_details->getEmail())->first();
      if ($user_details) {
        Auth::login($user_details);
        return redirect()->intended('user-home/#');
      } else {
        $new_user = User::create([
          'username' => 'fb_' . explode('@', $user_fb_details->getEmail())[0],
          'name' => $user_fb_details->getName(),
          'email' => $user_fb_details->getEmail(),
          'google_id' => $user_fb_details->getId(),
          'password' => Hash::make(\Illuminate\Support\Str::random(8))
        ]);

        // // Fetch user location using UserLocationController
        // $locationController = new UserLocationController();
        // $userLocation = $locationController->getUserInfo(request());

        // // Update the user's location
        // $new_user->location = $userLocation;
        // $new_user->save();

        Auth::login($new_user);
        return redirect()->intended('user-home/#');
      }
    } catch (\Exception $e) {
      return redirect()->intended('login/#')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
    }
  }
}
