<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.07.16.
 * Time: 17:11
 */

namespace Ethereal\User\Controllers;


use Ethereal\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return view('ethereal-user::admin.user.index', compact($users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ethereal-user::admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user.create')
                ->withErrors($validator)
                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('ethereal-user::admin.user.show', compact($user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('ethereal-user::admin.user.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return back()->with('message', 'A(z) ' . $id . ' azonosítójú felhasználó törlése sikerült!');
        } else {
            return back()->withError('A(z) ' . $id . ' azonosítójú felhasználó törlése nem sikerült!');
        }
    }

    /**
     * If the user not activated then activate the user
     *
     * @param $code
     * @return Response
     */
    public function activate($code)
    {

    }
}
