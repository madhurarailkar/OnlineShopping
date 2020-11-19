<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
if(request()->ajax()) {
return datatables()->of(Product::select('*'))
->addColumn('action', 'products.action')
->rawColumns(['action'])
->addIndexColumn()
->make(true);
}
return view('products.index');
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    $category = Category::pluck('name', 'id');
return view('products.create',compact('category'));
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
'title' => 'required',
'category_id'=>'required',
'description'=>'required',
'price'=>'required',
'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

]);
if ($files = $request->file('image')) {
    $destinationPath = public_path().'/image/'; // upload path
    $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
    $files->move($destinationPath, $profileImage);
    }
$company = new Product;
$company->title = $request->title;
$company->category_id = $request->category_id;
$company->description = $request->description;
$company->image = "$profileImage";
$company->price = $request->price;

$company->save();
return redirect()->route('products.index')
->with('success','Category has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\company  $company
* @return \Illuminate\Http\Response
*/
public function show(Product $company)
{

return view('products.show',compact('company'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\Company  $company
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    $company = Product::find($id);
    $category = Category::pluck('name', 'id');
return view('products.edit',compact('company','category'));
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
        'title' => 'required',
        'category_id'=>'required',
        'description'=>'required',
        'price'=>'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($files = $request->file('image')) {
            $destinationPath = public_path().'/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            }
$company = Product::find($id);
$company->title = $request->title;
$company->category_id = $request->category_id;
$company->description = $request->description;
$company->image =  "$profileImage";
$company->price = $request->price;
$company->save();
return redirect()->route('products.index')
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

$com = Product::where('id',$request->id)->delete();
return Response()->json($com);
}
}
