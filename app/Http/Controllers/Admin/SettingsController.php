<?php

namespace App\Http\Controllers\Admin;

use App\Settings;

use App\Http\Requests\StoreAdmin;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function social()
    {
        return view('admin.social');
    }

    public function update(StoreAdmin $request, Settings $settings)
    {
        $settings = Settings::make(storage_path('app/settings.json'));
        $settings->put([
            'meta_title' => $request->get('meta_title'),
            'meta_description' => $request->get('meta_description'),
            'author' => $request->get('author'),
            'email' => $request->get('email'),
            'url' => $request->get('url'),
            'robots' => $request->get('robots')
        ]);

        return redirect('admin/settings/')->with('success', 'Ustawienia zostały zaktualizowane');
    }

    public function socialupdate(Request $request, Settings $settings)
    {

        $settings = Settings::make(storage_path('app/settings.json'));
        $settings->put([
            'social_fb' => $request->get('social_fb'),
            'social_yt' => $request->get('social_yt'),
            'social_insta' => $request->get('social_insta'),
            'social_lin' => $request->get('social_lin'),
            'social_tw' => $request->get('social_tw')
        ]);

        return redirect('admin/settings/social/')->with('success', 'Ustawienia zostały zaktualizowane');
    }
}
