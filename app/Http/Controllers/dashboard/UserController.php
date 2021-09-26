<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
// use Dotenv\Validator;
// use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,User $users)
    {

        $q = $request->input('q');

        $active = 'Users';

        // didalam when dan seterusnya digunakan untuk mencari nama dan email pada dashboard user yang diambil dri DB 
        $users = $users->when($q, function($query) use ($q) {
            // LALU Didalamnya mereturn mencarian dari DATABASE
            return $query->where('name', 'like', '%'.$q.'%')
                         ->orWhere('email', 'like', '%'.$q.'%');
        })
        ->paginate(10);
       
        // UNTUK MENCARI SEARCH DAN MEMPERBAIKI LEBIH BAIK
        $request = $request->all();
        // dd($request);

        return view('dashboard/user/list', [
            'users' => $users, 
            'request' => $request,
            'active' => $active
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find digunakan untuk mencari nilai primaryKey
       $user = User::find($id);
       $active = 'Users';

    //    dd($user); 
       return view('dashboard/user/form', [
                                        'user' => $user, 
                                        'active' => $active
                                        
                                    ]);
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
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:App\Models\User,email,'.$id
        ]);

        if($validator->fails()) {
            return redirect('dashboard/user/edit/'. $id)
                    ->withErrors($validator)
                    ->withInput();
        } else {

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return redirect('dashboard/users');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('dashboard/users');
    }
}
