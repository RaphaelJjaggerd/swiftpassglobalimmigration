<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\UserLocationController;

class RegisterController extends Controller {
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  public function redirectTo() {
    return route('user.home');
  }
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('guest');
    $this->middleware('guest:admin');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data) {
    return Validator::make($data, [
      'name' => ['required', 'string', 'max:191'],
      // 'captcha_token' => ['required'],
      'username' => ['required', 'string', 'string', 'max:255', 'unique:users'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
      // 'captcha_token.required' => __('google captcha is required'),
      'name.required' => __('Name is required'),
      'name.max' => __('Name must be between 191 character'),
      'username.required' => __('Username is required'),
      'username.max' => __('Username must be between 191 character'),
      'username.unique' => __('Username is already taken'),
      'email.unique' => __('Email is already taken'),
      'email.required' => __('Email is required'),
      'password.required' => __('Password is required'),
      'password.confirmed' => __('Passwords do not match'),
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  protected function create(array $data) {
    $user = User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'country' => $data['country'],
      'city' => $data['city'],
      'username' => $data['username'],
      'password' => Hash::make($data['password']),
    ]);

    // // Fetch user location using UserLocationController
    // $locationController = new UserLocationController();
    // $userLocation = $locationController->getUserInfo(request());

    // // Update the user's location
    // $user->location = $userLocation['location'];
    // $user->save();

    return $user;
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  protected function createAdmin(Request $request) {
    $this->adminValidator($request->all())->validate();
    Admin::create([
      'name' => $request['name'],
      'username' => $request['username'],
      'email' => $request['email'],
      'password' => Hash::make($request['password']),
    ]);
    return redirect()->route('admin.home');
  }

  /**
   * Show the application registration form.
   *
   * @return \Illuminate\Http\Response
   */
  public function showRegistrationForm() {
    return view('frontend.user.register');
  }
}
