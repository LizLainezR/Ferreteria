<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Submodule;
use App\Models\Permission;
use App\Http\Requests\ModuleRequest;
use App\Http\Requests\SubmoduleRequest;


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
/////////////////PERSMISOS
public function getMenuByRole($roleId)
    {
        $permissions = Permission::where('id_role', $roleId)->get(['id_submodule']);
        $submoduleIds = $permissions->pluck('id_submodule');

        $submodules = Submodule::whereIn('id_submodule', $submoduleIds)->get(['id_submodule as id', 'description', 'id_module','url']);
        $moduleIds = $submodules->pluck('id_module')->unique();

        $modules = Module::whereIn('id_module', $moduleIds)->get(['id_module as id', 'description']);
        foreach ($modules as $module) {
            $module->submodule = $submodules->where('id_module', $module->id)->values();
        }

        return response()->json($modules);
    }


}
