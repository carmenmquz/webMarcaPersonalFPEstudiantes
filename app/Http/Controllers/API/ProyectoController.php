<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Http\Resources\ProyectoResource;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$busqueda = $request->input('filter');
/*         $registrosProyectos = ($busqueda && array_key_exists('q', $busqueda))
            ? Proyecto::where('nombre', 'like', '%' .$busqueda['q'] . '%')->get()
            : Proyecto::all(); */
            //$registrosProyectos = searchByField(array('nombre'), Proyecto::class);
            //return response($registrosProyectos)->header('X-Total-Count', Proyecto::count());
        return response(Proyecto::all())->header('X-Total-Count', Proyecto::count());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $proyecto = json_decode($request->getContent(), true);

        $proyecto = Proyecto::create($proyecto);

        return new ProyectoResource($proyecto);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        $proyecto->users;
        $proyecto->teacher;
        return response($proyecto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $proyectoData = json_decode($request->getContent(), true);
        $proyecto->update($proyectoData);

        return $proyecto;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
    }

    public function attachEstudiantes(Request $request, $id)
    {
        $payload = json_decode($request->getContent(), true);
        $alumno = $payload['alumno'];
        //$idproyecto = $payload['proyecto'];
        $proyecto=Proyecto::findOrFail($id);

        $proyecto->users()->attach($alumno);

    }
    public function detachEstudiantes(Request $request, $id)
    {
        $payload = json_decode($request->getContent(), true);
        $alumno = $payload['alumno'];
        //$idproyecto = $payload['proyecto'];
        $proyecto=Proyecto::findOrFail($id);

        $proyecto->users()->detach($alumno);

    }
}
