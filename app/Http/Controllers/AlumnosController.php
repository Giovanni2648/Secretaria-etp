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

/*$route = Route::current(); // Illuminate\Routing\Route
$name = Route::currentRouteName(); // string
$action = Route::currentRouteAction(); // string*/
class AlumnosController extends Controller
{
    public function index()
    {
        return view("components.index.index");
    }

    // --------------- Dashboard ---------------
    public function dashboard_alumnos(Request $request)
    {
        $alumnos = DB::table('alumnos')->paginate(10);
        foreach($alumnos as $alumno)
        {
            $id_tutor = $alumno->tutor;
            $nombre_tutor;
            $nombre_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('nombre');
            $apellido_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('apellido');
            $alumno->tutor =$nombre_tutor." ".$apellido_tutor;

            $id_curso = $alumno->cursos;
            $curso_cursos = DB::table('cursos')->where('id', '=', $id_curso)->value('curso');
            $div_cursos = DB::table('cursos')->where('id', '=', $id_curso)->value('division');
            $alumno->cursos = $curso_cursos."° ".$div_cursos."°";
        }
        return view('components.alumnos.dashboard')->with('alumnos', $alumnos);
    }

    public function buscador_alumnos(Request $request)
    {
        $nombre = $request->input('buscador_nombre');
        $apellido = $request->input('buscador_apellido');
        $dni = $request->input('buscador_dni');
        $curso = $request->input('buscador_curso');
        $division = $request->input('buscador_division');
        $nombre_ruta = Route::currentRouteName();
        $alumnos = DB::table('alumnos')->paginate(10);
        if(isset($nombre))
        {
            $alumnos = DB::table('alumnos')->where('nombre','=', $nombre)->paginate(10);
        }
        if(isset($apellido))
        {
            $alumnos = DB::table('alumnos')->where('apellido','=', $apellido)->paginate(10);
        }
        if(isset($dni))
        {
            $alumnos = DB::table('alumnos')->where('dni','=', $dni)->paginate(10);
        }
        if(isset($curso) && isset($division))
        {
            $id_curso = DB::table('cursos')->where('curso','=', $curso)->where('division','=', $division)->value('id');
            $alumnos = DB::table('alumnos')->where('cursos','=',$id_curso)->paginate(10);
        }
        foreach($alumnos as $alumno)
            {
                $id_tutor = $alumno->tutor;
                $nombre_tutor;
                $nombre_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('nombre');
                $apellido_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('apellido');
                $alumno->tutor =$nombre_tutor." ".$apellido_tutor;

                $id_curso = $alumno->cursos;
                $curso_cursos = DB::table('cursos')->where('id', '=', $id_curso)->value('curso');
                $div_cursos = DB::table('cursos')->where('id', '=', $id_curso)->value('division');
                $alumno->cursos = $curso_cursos."° ".$div_cursos."°";
            }
        return view('components.alumnos.dashboard-alumnos')->with('alumnos', $alumnos)->with('nombre_ruta', $nombre_ruta);
    }
    // --------------- Create ---------------

    public function store_alumno(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100|min:3',
            'apellido' => 'required|max:100|min:3',
            'dni' => 'required|unique:alumnos,dni|numeric|digits:8',
            'dni_t' => 'required|exists:tutor,dni|numeric|digits:8',
            'telefono' => 'required|numeric|digits:10',
            'nacimiento' => 'required',
            'curso' => 'required|exists:cursos|numeric',
            'division' => 'required_with:curso|exists:cursos,division|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard-alumnos')->withErrors($validator, 'usuario')->withInput();
        }
        //Alumnos
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $dni = $request->input('dni');
        $dni_t = $request->input('dni_t');
        $nacimiento = $request->input('nacimiento');
        $telefono = $request->input('telefono');

        //Tutor
        $tutor = DB::table('tutor')->where('dni','=',$dni_t)->value('id');
        //Curso
        $curso = $request->input('curso');
        $division = $request->input('division');
        $id_curso = 0;
        $id_curso = DB::table('cursos')->where('division','=',$division)->where('curso','=',$curso)->value('id');
        if($id_curso == 0)
        {
            DB::table('cursos')->insert([
                'curso' => $curso,
                'division' => $division
            ]);
            $id_curso = DB::table('cursos')->where('division','=',$division)->where('curso','=',$curso)->value('id');
        }

        $alumnos = 0;
        $alumnos = DB::table('alumnos')->where('dni','=',$dni)->value('id');
        if($alumnos == 0)
        {
            DB::table('alumnos')->insert([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'dni' => $dni,
                'telefono' => $telefono,
                'nacimiento' => $nacimiento,
                'tutor' => $tutor,
                'cursos' => $id_curso,
            ]);
        }
    }
    
    // --------------- Update ---------------

    public function show_update_alumno(string $id)
    {
        $alumnos = DB::table('alumnos')->where('id', '=', $id)->get();
        foreach($alumnos as $alumno)
        {
            $id_tutor = $alumno->tutor;
            $nombre_tutor;
            $nombre_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('nombre');
            $apellido_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('apellido');
            $alumno->tutor =$nombre_tutor." ".$apellido_tutor;
            $id_curso = $alumno->cursos;
            $cursos = DB::table('cursos')->where('id', '=', $id_curso)->value('curso');
            $divisiones = DB::table('cursos')->where('id', '=', $id_curso)->value('division');
        }
        return view('update.update_alumno')->with('alumnos', $alumnos)->with('cursos', $cursos)->with('divisiones', $divisiones);
    }

    public function update_alumno(Request $request)
    {
        $validated = $request->validate([
            'nombre' =>'required|max:100|min:3',
            'apellido' =>'required|max:100|min:3',
            'dni' => 'required|numeric|digits:8',
            'telefono' => 'required|numeric|digits:10',
            'nacimiento' => 'required',
            'curso' => 'required|exists:cursos,curso',
            'division' => 'required_with:curso||exists:cursos,division',
        ]);

        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $dni = $request->input('dni');
        $telefono = $request->input('telefono');
        $nacimiento = $request->input('nacimiento');

        $curso = $request->input('curso');
        $division = $request->input('division');
        $id_curso = DB::table('cursos')->where('curso','=',$curso)->where('division', '=', $division)->value('id');
        $id = $request->input('id');
        $alumno = DB::table('alumnos')->where('id', '=', $id)->update([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'telefono' => $telefono,
            'nacimiento' => $nacimiento,
            'cursos' => $id_curso,
        ]);
        return redirect()->route('dashboard-alumnos');
    }
    // --------------- Delete ---------------

    public function delete_alumno(string $id)
    {
        DB::table('alumnos')->where('id','=',$id)->delete();
        return redirect()->route('dashboard-alumnos');
    }
}