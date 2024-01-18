<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LanguageController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

    */

    public function index()

    {
        return view('lang');
    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

    */

    public function switchLanguage(Request $request)
    {
        // dd($request->all());
        $locale = $request->input('locale');
        if (in_array($locale, ['en', 'ms'])) {
            session(['locale' => $locale]);
        }

        return redirect()->back();
    }
}