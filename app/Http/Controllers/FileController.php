<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function manualdeusuario(){
        return response()->download(public_path('ManualdeUsuario.pdf'),'ManualDeUsuario.pdf');
    }
    public function manualdeprogramador(){
        return response()->download(public_path('ManualdeProgramador.pdf'),'ManualDeProgramador.pdf');
    }
}
