<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = new Profile();
        $edit = FALSE;
        return view('pages.breadOperation.profileForm', ['profile'=>$profile,'edit'=>$edit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'body'=>'required'
        ],[
            'first_name.required' => 'First Name cannot be blank',
            'last_name.required' => 'Last Name cannot be blank',
            'body.required' => 'About section cannot be blank',
        ]);

        $input = $request->all();
        $profile = new Profile($input);
        $profile->user()->associate(Auth::user());
        $profile->save();

        return redirect()->route('home')->with('message','Profile created successfully !! ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= Auth::user();
        $profile= $user->profile;
        return view('pages.profile')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user, $profile)
    {
        $user = User::find($user);
        $profile = $user->profile;
        $edit = TRUE;

        return view('pages.breadOperation.profileForm',['profile'=>$profile,'edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user, $profile)
    {
        $input = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'body'=>'required'
        ],[
            'first_name.required' => 'First Name cannot be blank',
            'last_name.required' => 'Last Name cannot be blank',
            'body.required' => 'About section cannot be blank',
        ]);

       // $input = $request->all();
        $profile = Profile::find($profile);

        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->body = $request->body;

        $profile->save();

        return redirect()->route('home')->with('message','Profile updated successfully !! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
