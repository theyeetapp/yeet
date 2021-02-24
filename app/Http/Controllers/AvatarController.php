<?php

namespace App\Http\Controllers;

use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avatar;

class AvatarController extends Controller
{
    public function update(Request $request) 
    {
        $request->validate([
            'avatar' => ['required','mimes:jpeg,jpg,png','between:1,7000']
        ]);

        $avatar = $request->avatar->getRealPath();
        $response = (new UploadApi())->upload($avatar, array('folder' => 'yeet'));
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
            (new UploadApi())->destroy($currentAvatar->public_id);
            $currentAvatar->url = $avatarUrl;
            $currentAvatar->public_id = $newPublicId;
            $currentAvatar->save();
        }

        return back()->with('message', 'avatar updated successfully');
    }
}
