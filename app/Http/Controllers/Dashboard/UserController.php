<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

public function __construct(){

  $this->middleware(['permission:users_read'])->only('index');
  $this->middleware(['permission:users_create'])->only('create');
  $this->middleware(['permission:users_update'])->only('edit');
  $this->middleware(['permission:users_delete'])->only('dstroy');

}


public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

            });

        })->latest()->paginate(5);

        return view('dashboard.users.index', compact('users'));

    }//end of index


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required|unique:users',
          'image' => 'image',
          'password' => 'required|confirmed',
          'permissions' => 'required|min:1'
      ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions','image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('users.index');
        // return redirect('/dashboard/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id),],
            'image' =>'image',
            'permissions' =>'required|min=1',
        ]);

        if ($request->image) {

           if ($user->image != 'default.png') {

               Storage::disk('public_uploads')->delete('/user_images/' . $user->image);

           }//end of inner if

           Image::make($request->image)
               ->resize(300, null, function ($constraint) {
                   $constraint->aspectRatio();
               })
               ->save(public_path('uploads/user_images/' . $request->image->hashName()));

           $request_data['image'] = $request->image->hashName();

       }//end of external if



        $request_data = $request->except(['permissions' , 'image']);
        $user->update($request_data);
        $user->syncpermissions($request->permissions);
        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       if ($user->image != 'default.png') {

           Storage::disk('public_uploads')->delete('/user_images/' . $user->image);

       }//end of if

       $user->delete();
       session()->flash('success', __('site.deleted_successfully'));
       return redirect()->route('dashboard.users.index');

   }//end of destroy
}
