<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\categoria;
use App\Models\planta;

class PlantaController extends Controller
{
    public function index(){
      
        $plants = planta::with('categoria')->latest()->get();
        $cats = categoria::all();
      
        return view('admin.Plantas.homeCrud', compact('plants'),compact('cats'));
    }

    public function create(){
        return view('admin.Plantas.plantaCreate');
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2046',
            'descripcion' => 'required',
            'seleccion' => 'required|integer',
        ]);

        if($request->hasFile('imagen')){
            $imagePath = $request->file('imagen')->store('images', 'public');
        }else{
            print_r("golasada");
            die();
            return back()->withErrors(['imagen' => 'Error al subir la imagen']);
        }

        planta::create([
            'nombre' => $request->nombre,
            'imagen' => $imagePath,
            'descripcion' => $request->descripcion,
            'id_categoriaplanta' => $request->seleccion,
        ]);

        return redirect()->route('homeAdmin')->with('success', 'Planta agregada exitosamente');
    }

    public function show($id){
        $plant = planta::findOrFail($id);
        return view('admin.Plantas.plantaShow', compact('plant'));
    }

    public function edit($id){
        $plant = planta::findOrFail($id);
        return response()->json($plant);
    }
   

    public function update(Request $request, $id){
        $plant = planta::find($id);
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2046',
            'descripcion' => 'required',
        ]); 

        if($request->hasFile('imagen')){
            $imagePath = $request->file('imagen')->store('images', 'public');
        }else{
            
            return back()->withErrors(['imagen' => 'Error al subir la imagen']);
        }
        $plant->nombre = $request->nombre;
        $plant->imagen = $imagePath;
        $plant->descripcion = $request->descripcion;

        $plant->save();

        return redirect()->route('homeAdmin')->with('success', 'Categoría actualizada exitosamente');
    }

    
    public function destroy(String $id){
        $cat = planta::findOrFail($id);
        planta::where('id_categoriaplanta', $id)->delete();
        $cat->delete();
        return redirect()->back();
    }
}
