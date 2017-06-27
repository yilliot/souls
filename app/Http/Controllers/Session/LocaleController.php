<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocaleController extends Controller
{

    public function zh(Request $request)
    {
        session(['locale' => 'zh']);
        return back()->with('success', 'success')->with('message', '语言设置成中文');
    }

    public function en()
    {
        session(['locale' => 'en']);
        return back()->with('success', 'success')->with('message', 'Language setting to English');
    }
}