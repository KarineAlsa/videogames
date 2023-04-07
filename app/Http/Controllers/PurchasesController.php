<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use App\Http\Controllers\VideogamesController;

use Illuminate\Http\Request;

class PurchasesController extends Controller
{

    public function index()
    {
        $purchase = purchase::orderBy('id')->paginate(50);

        $videocontroller = new VideogamesController();
        
        foreach($purchase as $row) {

            $videogamepurchase = $videocontroller->show($row['id_videogame']);
            
            $result[] = [
                'id' => $row['id'],
                'buyername' => $row['buyername'],
                'email' => $row['email'],
                'games' => [
                    'id' => $videogamepurchase['videogame']['id'],
                    'title' => $videogamepurchase['videogame']['title'],
                    'cover' => $videogamepurchase['videogame']['cover'],
                    'price' => $videogamepurchase['videogame']['price']
                ],
            ];
        }

        return [
          "data"=>$result
        ];
        //return view('purchase.index', compact('videogame'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buyername' => 'required',
            'email' => 'required',
            'id_videogame' => 'required',
        ]);
        $purchase = purchase::create($request->all());
        return [
            "status" => 1,
            "data" => $purchase,
        ];
    }

    public function destroy(purchase $purchase)
    {
        $purchase->delete();
        return [
            "status" => 1,
            "data" => $purchase,
            "msg" => "videogame deleted successfully"
        ];
    }

    public function update(Request $request, purchase $purchase)
    {
        $request->validate([
            'buyername' => 'required',
            'email' => 'required',
            'id_videogame' => 'required',

        ]);
 
        $purchase->update($request->all());
 
        return [
            "status" => 1,
            "data" => $purchase,
            "msg" => "videogame updated"
        ];
    }

   /*public function show($id)
    {

        $purchase= purchase::find($id);
        return view('libro.show', ['libro'=>$purchase]);

    }
*/
    public function show($id)
    {

        $purchase= purchase::find($id);
        return ['purchases'=>$purchase];

    }
}
