<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\OldPasswordRule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(['role:super-admin|admin']);

        //  $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:user-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $roles = Role::all();
        $users = User::with('roles')->get();

        return view('dashboard.user.index', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all();
        return view('dashboard.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        // dd($request);
        $data = $request->validate([
            'user_name' => ['required', 'string', 'min:3', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'min:3', 'max:255', 'unique:users'],
            'contact_no' => ['nullable', 'string','max:255'],
            'password' => ['required', 'string', 'min:3', 'max:255'],
            'role' => ['required'],

        ]);
        $user = new User();

        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->contact_no = $request->contact_no;
        $user->slug = Str::slug($request->user_name);


        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole($request->role);
        return redirect()->route('user.index')->with('status', 'A New User has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {


        return view('dashboard.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::with('roles')->findOrFail($id);
        return view('dashboard.user.edit', compact('user','roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $data = $request->validate([
            'user_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'min:3', 'max:255'],

            'contact_no' => ['nullable', 'string','max:255'],
            'password' => ['required', 'string', 'confirmed'],
            'role' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->slug = Str::slug($request->user_name);
        // $user->password = Hash::make($request->password);
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->roles()->sync($request->role);
        // $user->update($data);
        return redirect()->route('user.index')->with('status', 'A New User has been created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

            $user->delete();
        return redirect()->route('user.index')->with('status', 'A User has been deleted');

    }

    public function profile_edit()
    {
        return view('dashboard.user.profile');
    }
    public function profile_update(Request $request)
    {
        // dd($request);
        $user = auth()->user();
        $data = $request->validate([
            'user_name' => ['required', 'min:3' , 'max:30', Rule::unique('users')->ignore($user)],
            'user_image' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'contact_no' => ['required', 'string','max:255'],
        ]);
        if($request->has('user_image')){

            $data['user_image'] = $request->file('user_image')->store('images/users','public');

        }

        $user->update($data);
        return redirect()->route('home')->with('status', 'Your Profile has been updated');
    }

    public function change_password_edit()
    {
        return view('dashboard.user.change-password');
    }
    public function change_password_update(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new OldPasswordRule],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['same:password'],
        ]);
        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            'password'=> Hash::make($request->password)
        ]);
        return redirect()->route('home')->with('status', 'Your Password has changed');
    }

    // public function profile_delete(Request $request)
    // {

    // }
}
