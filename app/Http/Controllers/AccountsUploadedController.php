<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsUploadedController extends Controller
{
    public function index(Request $request)
    {
        return view('accounts.uploaded', [
            'account' => $request->user()
        ]);
    }
}
