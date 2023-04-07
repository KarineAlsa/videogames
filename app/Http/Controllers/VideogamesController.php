<?php

namespace App\Http\Controllers;

use App\Models\videogame;
use Illuminate\Http\Request;

class VideogamesController extends Controller
{
    public function index()
    {
        $videogame = videogame::orderBy('id')->paginate(15);
        return 
            $videogame
        ;
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cover' => 'required',
            'price' => 'required'
        ]);
        
        $fileName = time().'.'.$request->file("cover")->getClientOriginalExtension();  
        
        $path=$request->file('cover')->move(('../../frontend/public'), $fileName);
        
        
        
        $videogame = videogame::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'cover' => $path,
            'price' => $request->get('price'),
        ]);

        return [
            "status" => true,
            "data" => $videogame
        ];
    }

    public function destroy(videogame $videogame)
    {
        $videogame->delete();
        return [
            "status" => true   ,
            "data" => $videogame,
            "msg" => "videogame deleted successfully"
        ];
    }

    public function update($id,Request $request)
    {
        
        if($request->has('cover')){
            $fileName = time().'.'.$request->file("cover")->getClientOriginalExtension(); 
            $path=$request->file('cover')->move(('../../frontend/public'), $fileName);
        }

        $videogame=videogame::find($id);
        $videogame = videogame::find($id);
        $videogame->title = $request->has('title') ? $request->get('title') : $videogame->title;
        $videogame->description = $request->has('description') ? $request->get('description') : $videogame->description;
        $videogame->cover = $request->has('cover') ? $path : $videogame->cover;
        $videogame->price = $request->has('price') ? $request->get('price') : $videogame->price;
        $videogame->save();
        
        return [
            "status" => true,
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
