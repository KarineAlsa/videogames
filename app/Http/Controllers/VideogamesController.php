<?php

namespace App\Http\Controllers;

use App\Models\videogame;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;

class VideogamesController extends Controller
{
    public function index()
    {
        $videogame = videogame::orderBy('id')->paginate(15);
        return [
            "data" => $videogame
        ];
        
        //return view('videogame.index', compact('videogame'));
    }

    public function store(Request $request)
    {

        $fileName = time().'.'.$request->file("cover")->getClientOriginalExtension();  
        
        $path=$request->file('cover')->move(('uploads'), $fileName);
        
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
 
        $videogames = videogame::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'cover' => $path,
            'price' => $request->get('price'),
        ]);

        return [
            "status" => true,
            "data" => $videogames
        ];
    }

    public function destroy(videogame $videogame)
    {
        $videogame->delete();
        return [
            "status" => 1,
            "data" => $videogame,
            "msg" => "videogame deleted successfully"
        ];
    }

    public function update($id,Request $request)
    {
        
        $videogame=videogame::find($id);
        $videogame = videogame::find($id);
        $videogame->title = $request->has('title') ? $request->get('title') : $videogame->title;
        $videogame->description = $request->has('description') ? $request->get('description') : $videogame->description;
        $videogame->cover = $request->has('cover') ? $request->get('cover') : $videogame->cover;
        $videogame->price = $request->has('price') ? $request->get('price') : $videogame->price;
        $videogame->save();
        
        return [
            "status" => 1,
            "data" => $videogame,
            "msg" => "videogame updated"
        ];
        
    }

    public function show($id)
    {

        $videogame= videogame::find($id);
        return ['videogame'=>$videogame];

    }

    
}
