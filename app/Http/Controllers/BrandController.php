<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Marca;
use App\Repositories\MarcaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    private Brand $marca;

    public function __construct(Brand $marca)
    {
        $this->marca = $marca;
    }

    public function index(Request $request)
    {
        $marcaRepository = new MarcaRepository($this->marca);

        // condição de busca por atributos do modelo
        if ($request->has('atributos_modelos')) {
            $atributos_modelos = 'modelos:id,'. $request->atributos_modelos;
            $marcaRepository->selectAtributosRegistrosRelacionados($atributos_modelos);
        
        } else {
            $marcaRepository->selectAtributosRegistrosRelacionados('modelos');
        }

        // condição de busca com filtro
        if ($request->has('filtro')) {
            $marcaRepository->filtro($request->filtro);
        }

        // condição de busca por atributos do marca
        if ($request->has('atributos')) {
            $marcaRepository->selectAtributos($request->atributos);
        }

        return response()->json($marcaRepository->getResultado(), 200);
    }

    public function store(Request $request)
    {
        //$marca = Marca::create($request->all());
        $request->validate($this->marca->rules(), $this->marca->feedback());

        $image = $request->file('image');
        $imageEndpoint = $image->store('images/users', 'public');

        $marca = $this->marca->create(
            [
                'name' => $request->nome,
                'email'  => $request->email,
                'password'  => $request->password,
                'permission'  => $request->permission,
                'image' => $imageEndpoint
            ]
        );

        return response()->json($marca, 201);
    }

    public function show($id)
    {
        // adicionando o relacionamento - uma marca tem muito modelos
        $marca = $this->marca->with('modelos')->find($id);

        if ($marca === null) {
            return response()->json(['success' => false], 404);
        }

        return response()->json($marca, 200);
    }

    public function update(Request $request, $id)
    {
        //$marca->update($request->all());
        $marca = $this->marca->find($id);

        if ($marca === null) {
            return response()->json(['success' => false], 404);
        }

        if ($request->method() === 'PATCH') {
            $dinamicsRules = array();

            foreach ($marca->rules() as $input => $rule) {

                if (array_key_exists($input, $request->all())) {
                    $dinamicsRules[$input] = $rule;
                }

            }
            $request->validate($dinamicsRules, $this->marca->feedback());
        }

        if ($request->method() === 'PUT') {
            $request->validate($this->marca->rules(), $this->marca->feedback());
        }

        // Remove o arquivo antigo caso um novo seja enviado no request
        if ($request->file('imagem')) {
            Storage::disk('public')->delete($marca->imagem);
        }
        
        $image = $request->file('imagem');
        $imageEndpoint = $image->store('imagens', 'public');

        // Preencher objeto $marca com os dados da request
        $marca->fill($request->all());
        $marca->imagem = $imageEndpoint;
        $marca->save();

        return response()->json($marca, 200);
    }

    public function destroy($id)
    {
        $marca = $this->marca->find($id);

        if ($marca === null) {
            return response()->json(['success' => false], 404);
        }

        // Remove o arquivo antigo
        Storage::disk('public')->delete($marca->imagem);

        $marca->delete();
        return response()->json(['success' => true], 200);
    }
}
