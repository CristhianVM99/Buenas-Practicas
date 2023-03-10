<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\Autor;
use App\Models\User;
use App\Models\Pais;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    const DIR_AVATAR = 'avatars';

    public function usuarios()
    {
        return view('admin.usuarios');
    }

    public function dataListaUsers()
    {
        $model = User::query()->with(
            [
                'pais:code,name', 
                'roles:name',
            ]);

        return DataTables::eloquent($model)
            // ->editColumn('logo', fn($reg) => '<img class="object-contain" style="height:50px" src="'.$reg->logo.'" alt="No Imagen"></img>')
            ->addColumn('actions', function($reg) {
                $data = [
                    'id'     => $reg->id,
                    'editar' => route('users.edit', $reg->id),
                    'delete' => route('user.delete'),
                ];
                return view('sections.acciones',$data);
            })
            ->rawColumns(['actions'])
            ->tojson();
    }

    public function store()
    {
        $extras = [
            'paises' => Pais::all(),
            'roles' => Role::all(),
        ];
        return view('admin.form_user', $extras);
    }

    public function edit(User $user)
    {
        $rol = false;
        if(!is_null($user->roles->first()))
        {
            $rol = $user->roles->first()->id;
        }
        $extras = [
            'paises' => Pais::all(),
            'roles' => Role::all(),
            'user'  => $user,
            'rolId' => $rol,
        ];
        return view('admin.form_user_edit', $extras);
    }
    
    public function create(UserCreateRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        try {
            DB::transaction( function() use ($data)
            {
                $rol    = $data['rol'];
                $avatar = $data['avatar'];
                unset($data['avatar']);
                $user   = User::create($data);
                $user->assignRole($rol);
                if( isset($data['autor']))
                {
                    $autor            = $data['autor'];
                    $autor['user_id'] = $user->id;
                    $autor            = Autor::create($autor);
                }
                if( isset($avatar))
                {
                    $url = $this->uploadImage($avatar, $user->id);
                    $user->update(['avatar' => $url]);
                }
                
            });
        } catch(Exception $e){
            logger('Error', $e);
            Session::flash('error','El Usuario. No se ha Creado!');
            return redirect()->route('users.list');
        }
        Session::flash('success','El Usuario. Se ha Creado!');
        return redirect()->route('users.list');
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        try {
            DB::transaction( function() use ($data, $user)
            {
                $user->fill($data);
                $user->save();
                if( Role::find($data['rol']) )
                {
                    if( $user->hasRole('autor') && $data['rol'] != Role::findByName('autor')->id)
                    {
                        Autor::where('user_id', '=', $user->id)->delete();
                    }
                    $user->roles()->sync($data['rol']);
                }
                if( isset($data['autor']))
                {
                    $autor = Autor::where('user_id', '=', $user->id)->first();
                    if($autor)
                    {
                        $autor->fill($data['autor']);
                        $autor->save();
                    }
                    else
                    {
                        $autor            = $data['autor'];
                        $autor['user_id'] = $user->id;
                        $autor            = Autor::create($autor);
                    }
                    $user->roles()->sync($data['rol']);
                }
                if( isset($data['avatar']))
                {
                    $url = $this->uploadImage($data['avatar'], $user->id);
                    $user->update(['avatar' => $url]);
                }
            });
        } catch(Exception $e){
            logger('Error', $e);
            Session::flash('error','El Usuario. No se ha Actualizado!');
            return redirect()->route('users.list');
        }
        Session::flash('success','Usuario Actualizado!');
        return redirect()->route('users.list');
    }

    private function uploadImage( $image, $id = null )
    {
        $fileName = is_null($id)? $image->getClientOriginalName(): $id.'.'.$image->extension();
        $url      = Storage::disk('public')->putFileAs(self::DIR_AVATAR, $image, $fileName);
        if(!$url)
        {
            Session::flash('error','Imagen:'.$fileName.' No se ha Guardado!');
        }
        return $url;
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            DB::transaction( function() use ($id)
            {
                $user = User::find($id);
                if( $user->hasRole('autor') )
                {
                    $autor = Autor::where('user_id', '=', $user->id)->first();
                    $autor->delete();
                }
                if( isset($user->avatar))
                {
                    Storage::disk('public')->delete($user->avatar);
                }
                $user->delete();
            });
        } catch(Exception $e){
            logger('Error', $e);
            $mensajes['registro'] = [
                'class'     =>'error',
                'mensaje'   =>'El Usuario. No se ha Eliminado!'
            ];
            return response( $mensajes, 404);
        }
        $mensajes['registro'] = [
            'class'     =>'success',
            'mensaje'   =>'Usuario Eliminado!'
        ];
        return response( $mensajes, 200);
    }
}
