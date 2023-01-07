<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class customAuthController extends Controller
{
    public function index():View{
        return view('customAuth.index');
    }


    public function indexSite():View{
        return view('customAuth.site');
    }


    public function indexAdmin():View{
        return view('customAuth.dashboard');
    }

    public function loginPage():View{
        if (Auth::check()) {
            return view('customAuth.dashboard');
        }else{
            return view('customAuth.login');
        }

    }

    public function checkAdmin(Request $request):RedirectResponse
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt($validatedData)) {
            return redirect()->intended('/admin');
        }

        return back()->withInput($request->only('email'));

    }
}
