<?php

class UserController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            return Redirect::to('/');
        }
        return View::make('frontend.user.login');
    }

    public function login_post()
    {
        $input = Input::all();
        $values = array(
            'email' => 'required',
            'password' => 'required'
        );
        $validate = Validator::make($input, $values);

        if ($validate->fails()) {
            return Redirect::to('login')->withErrors($validate)->withInput(Input::except('password'));;
        } else {
            $remember = (Input::has('remember')) ? true : false;
            $credentials = array('email' => $input['email'], 'password' => $input['password']);
            if (Auth::attempt($credentials, $remember)) {
                if (empty($input['url'])) {
                    if (Auth::user()->role == 1) {
                        return Redirect::to('/admin/order');
                    } else {
                        return Redirect::to('/');
                    }
                } else {
                    return Redirect::to($input['url']);
                }
            } else {
                return Redirect::to('login')->withErrors('Email hoặc mật khẩu không đúng');
            }
        }
    }

    public function signup()
    {
        if (Auth::check()) {
            return Redirect::to('/');
        }
        return View::make('frontend.user.signup');
    }

    public function signup_post()
    {
        $input = Input::all();
        $values = array(
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        );
        $messages = [
            'email.unique' => 'Email này đã có người đăng ký.',
            'email.required' => 'Vui lòng nhập email đăng ký.',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự.',
        ];
        $validator = Validator::make($input, $values, $messages);
        if ($validator->fails()) {
            return Redirect::to('/dang-ky')->withErrors($validator);
        } else {
            $user = new User();
            $user->role = 2;
            $user->name = $input['name'];
            $user->mobile = $input['mobile'];
            $user->email = $input['email'];
            $user->password = Hash::make($input['password']);
            $user->save();
//            Mail::send('emails.welcome', array('firstname' => $input['firstname'], 'email' => Input::get('email'), 'password' => Input::get('password')), function ($message) {
//                $message->to(Input::get('email'), Input::get('firstname') . ' ' . Input::get('lastname'))->subject($this->subject);
//            });

            Auth::loginUsingId($user->id);
            return Redirect::to('/');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return Redirect::to('/');
    }
}
