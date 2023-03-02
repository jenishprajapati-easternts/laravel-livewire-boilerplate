<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserComment;
use App\Models\UserGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function create()
    {

        return view('create-user');
    }


    public function viewUsers()
    {

        return view('livewire.users-list');
    }


    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->all();
        /* common code for user data insert into database */
        $this->commonUserInsert($data, $request->gallery, $request->hobby, []);
        return response()->json(['message' => 'User Created Successfully.'], 200);
    }


    /**
     * commonUserInsert
     *
     * @param  mixed $userData
     * @param  mixed $galleries
     * @param  mixed $hobbies
     * @param  mixed $comments
     * @return void
     */
    public static function commonUserInsert($userData, $galleries, $hobbies, $comments)
    {

        $userData['user_type'] = '1'; // User type id author or sub admin
        $userData = User::create($userData);
        $userId = $userData->id;
        /* Insert multiple user galleries */
        if (!empty($galleries)) {

            $realPath = 'user/' . $userId . '/';
            foreach ($galleries as $image) {
                $path = $userData->uploadOne($image, '/public/' . $realPath);
                UserGallery::create(['user_id' => $userId, 'filename' => $realPath . pathinfo($path, PATHINFO_BASENAME)]);
            }
        }

        /* Insert multiple hobbies */
        if (!empty($hobbies)) {
            $userData->hobbies()->attach($hobbies); //this executes the insert-query
        }

        /* Insert multiple user comments */
        if (!empty($comments)) {
            foreach ($comments as $key => $value) {
                UserComment::create(['user_id' => $userId, 'comment' => $comments[$key]]);
            }
        }
    }
}
