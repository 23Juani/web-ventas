<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\UpdatePresentacioneStore;
use App\Models\Caracteristica;
use App\Models\Presentacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresentacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get();
        return view('Presentacione.index', ['presentaciones' => $presentaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presentacione.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaracteristicaRequest $request)
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->presentacione()->create([
                'caracteristica_id' => $caracteristica->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('presentaciones.index')->with('success', 'Presentacion registrada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presentacione $presentacione)
    {
        return view('presentacione.edit', ['presentacione' => $presentacione]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentacioneStore $request, Presentacione $presentacione)
    {
        Caracteristica::where('id', $presentacione->caracteristica->id)
            ->update($request->validated());

        return redirect()->route('presentaciones.index')->with('success', 'Presentacion actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)     
    {
       $mesage = '';
        $presentacione = Presentacione::find($id);
        if ($presentacione->caracteristica->estado == 1) {
            Caracteristica::where('id', $presentacione->caracteristica->id)
                ->update(['estado' => 0]);
            $mesage = 'Presentacion desactivada';
        } else {
            Caracteristica::where('id', $presentacione->caracteristica->id)
                ->update(['estado' => 1]);
            $mesage = 'Presentacion restaurada';
        }

        return redirect()->route('presentaciones.index')->with('success', $mesage);
    }
}
