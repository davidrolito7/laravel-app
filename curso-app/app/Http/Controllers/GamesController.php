<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videogame;
use App\Models\Category;
use App\Http\Requests\StoreVideogame;

class GamesController extends Controller
{
    //
    public function index()
    {
        //return "Bienvenido a la web que listara los juegos comprados";
        //aca se retorna una vista
        //$videogames=array('Fifa 22','NBA 22','Mario kart','Super Mario');
        $videogames = Videogame::orderBy('id', 'desc')->get();
        //dd($videogames);
        return view('index', ['games' => $videogames]);

    }

    public function create()
    {
        $categorias = Category::all();
        return view('create', ['categorias' => $categorias]);
    }

    public function help($name_game, $categoria = null)
    {
        $date = Now();
        return view('show', ['nameVideoGame' => $name_game, 'categoryGame' => $categoria, 'fecha' => $date]);
        /*
        if ($categoria) {
            return "Bienvenido a la web del juego " . $name_game . " que pertenece a la categoria " . $categoria;
        }else{
            return "Bienvenido a la página del juego: ".$name_game;
        }
        */
    }

    public function storeVideogame(StoreVideogame $request)
    {

        //return $request->all();
        /*
        $request->validate([
            'name_game'=>'required|min:5|max:10'
        ]);
        */
        
        $game = new Videogame;
        $game->name = $request->name;
        $game->category_id = $request->category_id;
        $game->active =1;
        $game->save();
        return redirect()->route('games');
/*
        Videogame::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('games');
*/
        /*
        Videogame::create([
            'name'=> $request->name,
            'category_id'=>$request->category_id,


        ]);
        */
        /*
        Videogame::create($request->all());
        return redirect()->route('games');
        */
    }


    public function view($game_id)
    {
        $game = Videogame::find($game_id);
        $categorias = Category::all();
        return view('update', ['categorias' => $categorias, 'game' => $game]);

    }

    public function updateVideogame(Request $request)
    {

        $game = Videogame::find($request->game_id);
        $game->name = $request->name_game;
        $game->category_id = $request->categoria_id;
        $game->active = 1;
        $game->save();

        return redirect()->route('games');
    }

    public function delete($game_id){
        $game = Videogame::find($game_id);
        $game->delete();
        return redirect()->route('games');
        
    }
}