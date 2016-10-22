<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Person;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Person::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\PersonRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        $person = new Person(['name' => $request->name]);
        $person->save();
        return response($person);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Person::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, $id)
    {
        $person = Person::findOrFail($id);
        $person->name = $request->name;
        $person->save();
        return response($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Person::findOrFail($id)->delete();
        return response('', 204);
    }
}
