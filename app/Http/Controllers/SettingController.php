<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin']);
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('dashboard.setting.index', compact('setting'));
    }

    public function general(Request $request)
    {
        $data = $request->validate([
            'app_name' => ['required', 'string', 'min:3', 'max:255'],
            'app_logo' => ['nullable'],
            'app_favicon' => ['nullable'],
            'app_description'=> ['required'],
        ]);
        $setting = Setting::first();

        if($request->has('app_logo')){
            $data['app_logo'] = $request->file('app_logo')->store('images/logo','public');
        }
        if($request->has('app_favicon')){
            $data['app_favicon'] = $request->file('app_favicon')->store('images/logo','public');
        }
        $setting->update($data);
        return back()->with('status', 'General Seeting has been updated');
    }


    public function update_env($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));
        }
    }
}
