<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index() {
        return view('GeneradorContraseñas.index', [
            'longitud' => 12,
            'opciones' => [
                'minusculas' => true,
                'mayusculas' => true,
                'numeros' => true,
                'especiales' => false,
            ],
        ]);
    }

    public function generar(Request $request) {
        $datos = $request->validate(['longitud' => 'required|integer|min:6|max:29']);
        $opciones = [
            'minusculas' => $request->boolean('minusculas'),
            'mayusculas' => $request->boolean('mayusculas'),
            'numeros' => $request->boolean('numeros'),
            'especiales' => $request->boolean('especiales'),
        ];

        $conjuntos = [];
        if ($opciones['minusculas']) $conjuntos[] = 'abcdefghijklmnopqrstuvwxyz';
        if ($opciones['mayusculas']) $conjuntos[] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($opciones['numeros']) $conjuntos[] = '0123456789';
        if ($opciones['especiales']) $conjuntos[] = '@=&*+-_#"%!()[]{}<>;.,';

        if ($conjuntos === []) {
            return back()->withErrors('Debes seleccionar al menos un tipo de carácter.')->withInput();
        }
        //desde aqui, se garantiza que la contraseña tenga al menos algun caracter elegido, y luego completa lo demas con caracteres aleatorios.
        $password = array_map(fn($c) => $c[random_int(0, strlen($c) - 1)], $conjuntos);
        $todos = implode('', $conjuntos);
        $longitud = $datos['longitud'];

        while (count($password) < $longitud) {
            $password[] = $todos[random_int(0, strlen($todos) - 1)];
        }

        for ($i = count($password) - 1; $i > 0; $i--) {
            $j = random_int(0, $i);
            [$password[$i], $password[$j]] = [$password[$j], $password[$i]];
        }

        return view('GeneradorContraseñas.index', [
            'password' => implode('', $password),
            'longitud' => $longitud,
            'opciones' => $opciones,
        ]);
    }
}
