<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
if(request()->ajax()) {
return datatables()->of(Category::select('*'))
->addColumn('action', 'categories.action')
->rawColumns(['action'])
->addIndexColumn()
->make(true);
}
return view('categories.index');
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('categories.create');
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$request->validate([
'name' => 'required',

]);
$company = new Category;
$company->name = $request->name;
$company->save();
return redirect()->route('categories.index')
->with('success','Category has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\company  $company
* @return \Illuminate\Http\Response
*/
public function show(Category $company)
{

return view('categories.show',compact('company'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\Company  $company
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    $company = Category::find($id);
return view('categories.edit',compact('company'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\company  $company
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$request->validate([
'name' => 'required',

]);
$company = Category::find($id);
$company->name = $request->name;
$company->save();
return redirect()->route('categories.index')
->with('success','Category Has Been updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  \App\Company  $company
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
{

$com = Category::where('id',$request->id)->delete();
return Response()->json($com);
}
}
