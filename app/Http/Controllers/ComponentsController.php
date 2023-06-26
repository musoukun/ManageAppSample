<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class ComponentsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // $companies = Company::orderBy('id','desc')->paginate(5);
        return view('sample.component', compact('companies'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    // public function create()
    // {
    //     return view('sample.create');
    // }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'address' => 'required',
    //     ]);

    //     Company::create($request->post());

    //     return redirect()->route('sample.index')->with('success','Company has been created successfully.');
    // }

    // /**
    // * Display the specified resource.
    // *
    // * @param  \App\company  $company
    // * @return \Illuminate\Http\Response
    // */
    // public function show(Company $company)
    // {
    //     return view('sample.show',compact('company'));
    // }

    // /**
    // * Show the form for editing the specified resource.
    // *
    // * @param  \App\Company  $company
    // * @return \Illuminate\Http\Response
    // */
    // public function edit(Company $company)
    // {
    //     return view('sample.edit',compact('company'));
    // }

    // /**
    // * Update the specified resource in storage.
    // *
    // * @param  \Illuminate\Http\Request  $request
    // * @param  \App\company  $company
    // * @return \Illuminate\Http\Response
    // */
    // public function update(Request $request, Company $company)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'address' => 'required',
    //     ]);

    //     $company->fill($request->post())->save();

    //     return redirect()->route('sample.index')->with('success','Company Has Been updated successfully');
    // }

    // /**
    // * Remove the specified resource from storage.
    // *
    // * @param  \App\Company  $company
    // * @return \Illuminate\Http\Response
    // */
    // public function destroy(Company $company)
    // {
    //     $company->delete();
    //     return redirect()->route('sample.index')->with('success','Company has been deleted successfully');
    // }
}
