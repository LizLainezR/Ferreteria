<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Http\Requests\ModuleRequest;
use App\Http\Requests\SubmoduleRequest;
use App\Models\Submodule;

class ModuleController extends Controller
{
    //
    public function indexmodule(){
        $module=Module::all();
        return response()->json($module);
    }

    public function create_module(ModuleRequest $request){
        $data= $request->validated();
        $module=Module::create([
            'description'=>$data['description']
        ]);

        return [
          'module'=>$module
        ];
    }

    public function indexsubmodulos(){
        $submodule=Submodule::all();
        return response()->json($submodule);
    }


    public function create_submodule(SubmoduleRequest $request){
        $data= $request->validated();
        $submodule=Submodule::create([
            'description'=>$data['description'],
            'id_module'=>$data['id_module']
        ]);

        return [
          'submodule'=>$submodule
        ];
    }



}
