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

    public  function buscador(Request $request)
    {
        //Tutor
        $nombre_tutor = $request->input('buscador_nombre_tutor');
        $apellido_tutor = $request->input('buscador_apellido_tutor');

        if($nombre_tutor  !=  NULL && $apellido_tutor != NULL)
        {
            $tutor = DB::table('tutor')->where('nombre', '=', $nombre_tutor)->where('apellido','=', $apellido_tutor)->paginate();
        }
        else
        {
            $tutor = DB::table('tutor')->paginate(10);
        }

        //Profesor
        $nombre_profesor = $request->input('buscador_profesor_nombre');
        $apellido_profesor = $request->input('buscador_profesor_apellido');

        if($nombre_profesor != NULL && $apellido_profesor != NULL)
        {
            $profesores = DB::table('profesores')->where('nombre', '=', $nombre_profesor)->where('apellido','=', $apellido_profesor)->paginate();
        }
        else
        {
            $profesores = DB::table('profesores')->paginate(10);
        }
            return view('components.alumnos.dashboard-alumnos')->with('alumnos', $alumno)->with('tutor', $tutor)->with('profesores', $profesores);
    }
    // --------------- Dashboards ---------------
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

    public function dashboard_tutores(Request $request)
    {
        $tutores = DB::table('tutor')->paginate($perPage = 10,$columns = ['*'] ,$pageName = "tutores");
        return view('components.tutores.dashboard')->with('tutores', $tutores);
    }

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

    public function dashboard_profesores(Request $request)
    {
        $materias = DB::table('materias')->orderBy('materia')->simplePaginate($perPage = 5,$columns = ['*'] ,$pageName = "materias");
        $profesores = DB::table('profesores')->paginate($perPage = 10,$columns = ['*'] ,$pageName = "profesores");
        return view('components.profesores.dashboard')->with('profesores', $profesores)->with('materias', $materias);
    }

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
        if ($validator->fails()) {
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

    public function delete_alumno(string $id)
    {
        DB::table('alumnos')->where('id','=',$id)->delete();
        return redirect()->route('dashboard-alumnos');
    }

    public function delete_tutor(string $id)
    {
        DB::table('tutor')->where('id','=',$id)->delete();
        return redirect()->route('dashboard-tutores');
    }

    public function delete_profesor(string $id)
    {
        DB::table('profesores')->where('id','=',$id)->delete();
        return redirect()->route('dashboard-profesores');
    }
}