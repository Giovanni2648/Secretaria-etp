<?php

namespace App\Http\Controllers;
use App\Models\alumnos;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

use Illuminate\Support\Arr;
class AlumnosController extends Controller
{

    public function eliminar()
    {
        return "";
    }

    public function index(Request $request)
    {
        $alumnos = DB::table('alumnos')->paginate(15);
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
        $materias = DB::table('materias')->orderBy('materia')->simplePaginate($perPage = 5,$columns = ['*'] ,$pageName = "materias");
        $tutor = DB::table('tutor')->paginate($perPage = 5,$columns = ['*'] ,$pageName = "tutores");
        $profesores = DB::table('profesores')->paginate($perPage = 5,$columns = ['*'] ,$pageName = "profesores");
        return view('welcome')->with('alumnos', $alumnos)->with('tutor', $tutor)->with('profesores', $profesores)->with('materias', $materias)->fragmentIf($request->hasHeader('HX-Request'),'dashboard_alumnos');
    }

    public  function buscador(Request $request)
    {
        //Alumno
        $nombre_alumno = $request->input('buscador_alumno_nombre');
        $apellido_alumno = $request->input('buscador_alumno_apellido');
        $curso_alumno = $request->input('buscador_alumno_curso');
        $division_alumno = $request->input('buscador_alumno_division');
        if($nombre_alumno != NULL && $apellido_alumno != NULL && $curso_alumno != NULL && $division_alumno != NULL)
        {
            $id_curso = 0;
            $id_curso = DB::table('cursos')->where('curso','=', $curso_alumno)->where('division', '=', $division_alumno)->value('id');
            if($id_curso != 0)
            {
                $alumno = DB::table('alumnos')->where('nombre','=',$nombre_alumno)->where('apellido','=',$apellido_alumno)->where('cursos','=',$id_curso)->paginate();
            }
            foreach($alumno as $a)
            {
                $id_tutor = $a->tutor;
                $nombre_tutor;
                $nombre_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('nombre');
                $apellido_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('apellido');
                $a->tutor =$nombre_tutor." ".$apellido_tutor;

                $id_curso = $a->cursos;
                $curso_cursos = DB::table('cursos')->where('id', '=', $id_curso)->value('curso');
                $div_cursos = DB::table('cursos')->where('id', '=', $id_curso)->value('division');
                $a->cursos = $curso_cursos."° ".$div_cursos."°";
            }
        }
        else
        {
            $alumno = DB::table('alumnos')->paginate(10);
        }

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
        return view('welcome')->with('alumnos', $alumno)->with('tutor', $tutor)->with('profesores', $profesores);
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
            return redirect()->route('index')->withErrors($validator, 'usuario')->withInput();
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
            return  $nombre;
        }
    }

    public function store_tutor(Request $request)
    {
            $validator = Validator::make($request->all(),[
                'nombre_t' =>'required|max:100|min:3',
                'apellido_t' =>'required|max:100|min:3',
                'dni_t' => 'required|unique:tutor,dni|numeric|digits:8',
                'telefono_t' => 'required|numeric|digits:10',
            ]);

            if ($validator->fails()) {
                return redirect()->route('index')->withErrors($validator, 'tutor')->withInput();
            }
            //Tutor
            $nombre_t = $request->input('nombre_t');
            $apellido_t = $request->input('apellido_t');
            $dni_t = $request->input('dni_t');
            $telefono_t = $request->input('telefono_t');

            $tutor = 0;
            $tutor = DB::table('tutor')->where('dni', $dni_t)->value('id');
            if($tutor == 0)
            {
                DB::table('tutor')->insert([
                    'nombre' => $nombre_t,
                    'apellido' => $apellido_t,
                    'dni' => $dni_t,
                    'telefono' => $telefono_t,
                ]);
                $tutor = DB::table('tutor')->where('dni', $dni_t)->value('id');
            }
            else
            {
                 return "el alumno ya esta en el sistema";
            }
    }
    public function store_profesor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_p' =>'required|max:100|min:3',
            'apellido_p' =>'required|max:100|min:3',
            'dni_p' => 'required|numeric|digits:8',
            'telefono_p' => 'required|numeric|digits:10',
            'curso_p' => 'required|exists:cursos,curso',
            'division_p' => 'required_with:curso||exists:cursos,division',
            'titulo' => 'required|min:5',
        ]);
        if ($validator->fails()) {
            return redirect()->route('index')->withErrors($validator, 'profesor')->withInput();
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
        }
    
    // --------------- Update ---------------

    public function show_update_alumno(Request $request)
    {
        $id = $request->get('id');
        $alumno = DB::table('alumnos')->where('id', '=', $id)->get();
        foreach($alumno as $a)
        {
            $id_tutor = $a->tutor;
            $nombre_tutor;
            $nombre_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('nombre');
            $apellido_tutor = DB::table('tutor')->where('id', '=', $id_tutor)->value('apellido');
            $a->tutor =$nombre_tutor." ".$apellido_tutor;
        }
        return view('update_alumno')->with('alumno', $alumno);
    }

    public function update_alumno(Request $request)
    {
        $validated = $request->validate([
            'nombre' =>'required|max:100|min:3',
            'apellido' =>'required|max:100|min:3',
            'edad' => 'required|numeric',
            'dni' => 'required|numeric|digits:7',
            'telefono' => 'required|numeric|digits:10',
            'nacimiento' => 'required',
            'curso' => 'required|exists:cursos,curso',
            'division' => 'required_with:curso||exists:cursos,division',
        ]);

        $nombre = $request->input('nombre_a');
        $apellido = $request->input('apellido_a');
        $dni = $request->input('dni_a');
        $telefono = $request->input('telefono_a');
        $edad = $request->input('edad_a');
        $nacimiento = $request->input('nacimiento_a');

        $curso = $request->input('curso_a');
        $division = $request->input('division_a');
        $id_curso = DB::table('cursos')->where('curso','=',$curso)->where('division', '=', $division)->value('id');
        $id = $request->input('id');
        $alumno = DB::table('alumnos')->where('id', '=', $id)->update([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'telefono' => $telefono,
            'edad' => $edad,
            'nacimiento' => $nacimiento,
            'cursos' => $id_curso,
        ]);
        return redirect()->route('index');
    }

    public function show_update_tutor(Request $request)
    {
        $id = $request->get('id');
        $tutor = DB::table('tutor')->where('id', '=', $id)->get();
        return view('update_tutor')->with('tutor', $tutor);
    }

    public function update_tutor(Request $request)
    {
        $validated = $request->validate([
            'nombre_t' =>'required|max:100|min:3',
            'apellido_t' =>'required|max:100|min:3',
            'edad_t' => 'required|numeric',
            'dni_t' => 'required|numeric|digits:7',
            'telefono_t' => 'required|numeric|digits:10',
        ]);
        $id = $request->input('id');
        $nombre = $request->input('nombre_t');
        $apellido = $request->input('apellido_t');
        $dni = $request->input('dni_t');
        $telefono = $request->input('telefono_t');
        $tutor = DB::table('tutor')->where('id', '=', $id)->update([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'telefono' => $telefono,
        ]);
        return redirect()->route('index');
    }

    public function show_update_profesor(Request $request)
    {
        $id = $request->get('id');
        $profesor = DB::table('profesores')->where('id', '=', $id)->get();
        return view('update_profesor')->with('profesor', $profesor);
    }

    public function update_profesor(Request $request)
    {
        $validated = $request->validate([
            'nombre' =>'required|max:100|min:3',
            'apellido' =>'required|max:100|min:3',
            'edad' => 'required|numeric',
            'dni' => 'required|numeric|digits:7',
            'telefono' => 'required|numeric|digits:10',
            'nacimiento' => 'required',
            'curso' => 'required|exists:cursos,curso',
            'division' => 'required_with:curso||exists:cursos,division',
        ]);
        $id = $request->input('id');
        $nombre = $request->input('nombre_p');
        $apellido = $request->input('apellido_p');
        $dni = $request->input('dni_p');
        $telefono = $request->input('telefono_p');
        $profesor = DB::table('profesores')->where('id', '=', $id)->update([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'telefono' => $telefono,
        ]);
        return redirect()->route('index');
    }
    // --------------- Delete ---------------

    public function delete_alumno(Request $request)
    {
        $id = $request->input('id');
        DB::table('alumnos')->where('id','=',$id)->delete();
        return redirect()->route('index');
    }

    public function delete_tutor(Request $request)
    {
        $id = $request->input('id');
        DB::table('tutor')->where('id','=',$id)->delete();
        return redirect()->route('index');
    }

    public function delete_profesor(Request $request)
    {
        $id = $request->input('id');
        DB::table('profesores')->where('id','=',$id)->delete();
        return redirect()->route('index');
    }
}