<?php

namespace App\Http\Controllers;

use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avatar;
use Exception;

class AvatarController extends Controller
{
    public function update(Request $request) 
    {
        $request->validate([
            'avatar' => ['required','mimes:jpeg,jpg,png','between:1,7000']
        ]);
        
        $avatar = $request->avatar->getRealPath();
        try {
            $response = (new UploadApi(config("app.cloudinary_url")))->upload($avatar, array('folder' => 'yeet'));
        }
        catch(Exception $e) {
            return back()->with('error', 'an error occured');
        }

        $avatarUrl = $response['secure_url'];
        $newPublicId = $response['public_id'];
        $currentAvatar = Avatar::firstWhere('user_id', Auth::id());
            
        if(!$currentAvatar) {
            Avatar::create([
                'url' => $avatarUrl,
                'public_id' => $newPublicId,
                'user_id' => Auth::id()
            ]);
        }
        else {
            if($currentAvatar->public_id) {
                (new UploadApi(config("app.cloudinary_url")))->destroy($currentAvatar->public_id);
            }
            $currentAvatar->url = $avatarUrl;
            $currentAvatar->public_id = $newPublicId;
            $currentAvatar->save();
        }

        return back()->with('message', 'Avatar updated successfully');
    }
}
