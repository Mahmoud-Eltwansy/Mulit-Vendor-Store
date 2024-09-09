<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit(){
        $user=Auth::user(); // return authintecated
        return view('dashboard.profile.edit',[
            'user'=>$user,
            'countries'=>Countries::getNames(),
            'locales'=>Languages::getNames(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name'=>['required','string','max:255'],
            'last_name'=>['required','string','max:255'],
            'birthday'=>['nullable','date','before:today'],
            'gender'=>['in:male,female'],
            'country'=>['required','string','size:2'],
        ]);
        $user = $request->user(); // return authintecated user
        $user->profile->fill( $request->all() )->save();
        return redirect()->route('dashboard.profile.edit')
                ->with('success','Profile Updated!');

        // can not use $profile,$profile->user_id in the condition because i added withDefault with profile relation ,
        // so if the user hasnot a profile ,
        // the relation will not return null, but return an empty object , so i can't check on $profile, or any foriegn key
        // if($profile->first_name){
        //     $profile->update( $request->all() );
        // }else{
        //     // $request->merge([
        //     //     'user_id'=>$user->id,
        //     // ]);
        //     // Profile::create( $request->all() );
        //     $user->profile()->create( $request->all() );
        // }
    }
}
