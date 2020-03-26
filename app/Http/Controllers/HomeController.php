<?php

namespace App\Http\Controllers;

use App\Library\Scrapper;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){

        return view('admin.dashboard');
    }

    public function profile(){
        $dados = array(
            'user'=> Auth::user(),
        );
        return view('admin.profile', $dados);
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function setLoja($id){
        session()->put('loja', $id);
        return redirect()->back();
    }
}
