<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use App\Models\Tutores;
use App\Models\Profesores;
use App\Models\Cursos;
use App\Models\Materias;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
class TutoresController extends Controller
{
    // --------------- Dashboard ---------------
    public function dashboard_tutores(Request $request)
    {
        $tutores = DB::table('tutor')->paginate($perPage = 10,$columns = ['*'] ,$pageName = "tutores");
        return view('components.tutores.dashboard')->with('tutores', $tutores);
    }

    // --------------- Buscador ---------------
    public function buscador_tutores(Request $request)
    {
        $nombre = $request->input('buscador_nombre');
        $apellido = $request->input('buscador_apellido');
        $dni = $request->input('buscador_dni');
        $nombre_ruta = Route::currentRouteName();

        $tutores = DB::table('tutor')->paginate(10);
        if(isset($nombre))
        {
            $tutores = DB::table('tutor')->where('nombre','=', $nombre)->paginate(10);
        }
        if(isset($apellido))
        {
            $tutores = DB::table('tutor')->where('apellido','=', $apellido)->paginate(10);
        }
        if(isset($dni))
        {
            $tutores = DB::table('tutor')->where('dni','=', $dni)->paginate(10);
        }
        return view('components.tutores.dashboard')->with('tutores', $tutores)->with('nombre_ruta', $nombre_ruta);
    }

    // --------------- Create ---------------
    public function store_tutor(Request $request)
    {
            $validator = Validator::make($request->all(),[
                'nombre' =>'required|max:100|min:3',
                'apellido' =>'required|max:100|min:3',
                'dni' => 'required|unique:tutor,dni|numeric|digits:8',
                'telefono' => 'required|numeric|digits:10',
            ]);

            if ($validator->fails()) {
                return redirect()->route('dashboard-tutores')->withErrors($validator, 'tutor')->withInput();
            }
            //Tutor
            $nombre = $request->input('nombre');
            $apellido = $request->input('apellido');
            $dni = $request->input('dni');
            $telefono = $request->input('telefono');
            DB::table('tutor')->insert([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'dni' => $dni,
                'telefono' => $telefono,
            ]);
            return redirect()->route('dashboard-tutores');
    }

 
    // --------------- Update ---------------
    public function show_update_tutor(string $id)
    {
        $tutores = DB::table('tutor')->where('id', '=', $id)->get();
        return view('update.update_tutor')->with('tutores', $tutores);
    }

    public function update_tutor(Request $request)
    {
        $validated = $request->validate([
            'nombre' =>'required|max:100|min:3',
            'apellido' =>'required|max:100|min:3',
            'dni' => 'required|numeric|digits:8',
            'telefono' => 'required|numeric|digits:10',
        ]);
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $dni = $request->input('dni');
        $telefono = $request->input('telefono');
        $tutor = DB::table('tutor')->where('id', '=', $id)->update([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'telefono' => $telefono,
        ]);
        return redirect()->route('dashboard-tutores');
    }

    // --------------- Delete ---------------
    public function delete_tutor(string $id)
    {
        DB::table('tutor')->where('id','=',$id)->delete();
        return redirect()->route('dashboard-tutores');
    }
}
