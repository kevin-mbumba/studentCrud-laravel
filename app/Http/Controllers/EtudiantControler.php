<?php

namespace App\Http\Controllers;

use App\Http\Requests\EtudiantRequest;
use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants=Etudiant::orderby("nom","asc")->paginate(5);
        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=Classe::all();
        return view('etudiants.create',compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EtudiantRequest $request)
    {
        try {

            Etudiant::create([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'classe_id' => $request->input('classe_id')
            ]);

            //return redirect()->route('etudiants.index');
            return back()->with("success","Etudiant ajouté avec succès");

        } catch (\Exception $ex) {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {   
        $classes=Classe::all();
        return view('etudiants.edit',compact('etudiant','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EtudiantRequest $request, Etudiant $etudiant)
    {
        try {
            $etudiant->update([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'classe_id' => $request->input('classe_id')
            ]);

            return back()->with("successUpdate","Etudiant modifié avec succès");

        } catch (\Exception $ex) {
            //throw $th;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        $nom_complet=$etudiant->nom ." ".$etudiant->prenom;
        $etudiant->delete();
        return back()->with("successDelete","L'Etudiant '$nom_complet' supprimé avec succès");
    }
}
