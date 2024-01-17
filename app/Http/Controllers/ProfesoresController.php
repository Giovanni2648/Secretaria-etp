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

class ProfesoresController extends Controller
{
    // --------------- Dashboard ---------------
    public function dashboard_profesores(Request $request)
    {
        $materias = DB::table('materias')->orderBy('materia')->simplePaginate($perPage = 5,$columns = ['*'] ,$pageName = "materias");
        $profesores = DB::table('profesores')->paginate($perPage = 10,$columns = ['*'] ,$pageName = "profesores");
        return view('components.profesores.dashboard')->with('profesores', $profesores)->with('materias', $materias);
    }

    // --------------- Buscador ---------------
    public function buscador_profesores(Request $request)
    {
        $nombre = $request->input('buscador_nombre');
        $apellido = $request->input('buscador_apellido');
        $dni = $request->input('buscador_materia');
        $nombre_ruta = Route::currentRouteName();
        $materias = DB::table('materias')->orderBy('materia')->simplePaginate($perPage = 5,$columns = ['*'] ,$pageName = "materias");

        $profesores = DB::table('profesores')->paginate(10);
        if(isset($nombre))
        {
            $profesores = DB::table('profesores')->where('nombre','=', $nombre)->paginate(10);
        }
        if(isset($apellido))
        {
            $profesores = DB::table('profesores')->where('apellido','=', $apellido)->paginate(10);
        }
        return view('components.profesores.dashboard')->with('profesores', $profesores)->with('nombre_ruta', $nombre_ruta)->with('materias', $materias);
    }

    // --------------- Create ---------------
    public function store_profesor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_p' =>'required|max:100|min:3',
            'apellido_p' =>'required|max:100|min:3',
            'dni_p' => 'required|numeric|digits:8',
            'telefono_p' => 'required|numeric|digits:10',
            'curso_p' => 'required|exists:cursos,curso',
            'division_p' => 'required_with:curso|exists:cursos,division',
            'titulo' => 'required|min:1',
        ]);
        if ($validator->fails()) 
        {
            return redirect()->route('dashboard-profesores')->withErrors($validator, 'profesor')->withInput();
        }
        $nombre = $request->input('nombre_p');
        $apellido = $request->input('apellido_p');
        $dni = $request->input('dni_p');
        $telefono = $request->input('telefono_p');
        $titulos = $request->input('titulo');
        $materias = $request->input('materias_p');

        $cursos = $request->input('curso_p');
        $divisiones = $request->input('division_p');
        //insertar profesor

        $profesor = 0;
        $profesor = DB::table('profesores')->where('dni','=',$dni)->where('nombre','=',$nombre)->where('apellido','=',$apellido)->value('id');

        if($profesor == 0)
        {
            DB::table('profesores')->insert([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'dni' => $dni,
                'telefono' => $telefono,
            ]);
            $profesor = DB::table('profesores')->where('dni','=',$dni)->where('nombre','=',$nombre)->where('apellido','=',$apellido)->value('id');
        }

        //insertar Curso - Profesor
        if (!empty($cursos)) {
            $cursos = array_filter($cursos, static function ($item) {
                return !empty($item);
            });
        }
        if (!empty($divisiones)) {
            $divisiones = array_filter($divisiones, static function ($item) {
                return !empty($item);
            });
        }

        $id_cursos = array();

        foreach ($cursos as $indice_curso => $curso) {
            foreach ($divisiones as $indice_division => $division) {
                if($indice_curso == $indice_division)
                {    
                    $id_curso = DB::table('cursos')->where('curso', '=', $curso)->where('division', '=', $division)->value('id');
                    $id_cursos[] = $id_curso;
                }
            }
        }

        $curso_profesor = 0;
        $curso_profesor = DB::table('pivot_cursos_profesores')->where('cursos', '=', $id_curso)->where('profesores', '=', $profesor)->value('id');
        if($curso_profesor == 0)
        {
            foreach($id_cursos as $id_curso)
            {
                DB::table('pivot_cursos_profesores')->insert([
                    'cursos' => $id_curso,
                    'profesores' => $profesor,
                ]);
            }

        }

        //Insertar Titulos
        if (!empty($titulos)) {
            $titulos = array_filter($titulos, static function ($item) {
                return !empty($item);
            });
        }
        foreach($titulos as $titulo)
        {
            $profesor = DB::table('profesores')->where('dni','=',$dni)->where('nombre','=',$nombre)->where('apellido','=',$apellido)->value('id');
            DB::table('pivot_titulos_profesores')->insert([
                'titulo' => $titulo,
                'profesores' => $profesor
            ]); 
        }

        //Insertar Materias
        if(is_array($materias))
        {
            foreach($materias as $m)
            {
                $profesor = DB::table('profesores')->where('dni','=',$dni)->where('nombre','=',$nombre)->where('apellido','=',$apellido)->value('id');
                DB::table('pivot_materias_profesores')->insert([
                    'materias' => $m,
                    'profesores' => $profesor
                ]);
            }
        }
        else
        {
            $profesor = DB::table('profesores')->where('dni','=',$dni)->where('nombre','=',$nombre)->where('apellido','=',$apellido)->value('id');
                DB::table('pivot_materias_profesores')->insert([
                    'materias' => $materias,
                    'profesores' => $profesor
                ]);
        }
        return redirect()->route('dashboard-profesores');
    }

    // --------------- Update ---------------
    public function show_update_profesor(string $id)
    {
        $profesores = DB::table('profesores')->where('id', '=', $id)->get();
        return view('update/update_profesor')->with('profesores', $profesores);
    }

    public function update_profesor(Request $request)
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
        $profesor = DB::table('profesores')->where('id', '=', $id)->update([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'telefono' => $telefono,
        ]);
        return redirect()->route('dashboard-profesores');
    }

    // --------------- Delete ---------------
    public function delete_profesor(string $id)
    {
        DB::table('profesores')->where('id','=',$id)->delete();
        return redirect()->route('dashboard-profesores');
    }
}
