<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:users-manage');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $users = User::query()->with('roles');
            return Datatables::of($users)
                ->setTotalRecords($users->count())
                ->addColumn('roles', function ($user) {
                    return view('admin.users.partials.roles', compact('user'));
                })
                ->editColumn('created_at', function ($user) {
                    return view('admin.users.partials.created_at', compact('user'));
                })
                ->editColumn('wallet', function ($user) {
                    return view('admin.users.partials.wallet', compact('user'));
                })
                ->addColumn('actions', function ($user) {
                    return view('admin.users.partials.actions', compact('user'));
                })
                ->rawColumns(['created_at', 'roles', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles      = Role::pluck('display_name', 'id');
        return view()->first(['admin.users.create', 'user::create'], compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUser $request
     * @return Response
     */
    public function store(StoreUser $request)
    {
        $user_data = [
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'name'          => $request->input('first_name') . ' ' . $request->input('last_name'),
            'password'      => bcrypt($request->input('password')),
            'email'         => $request->input('email'),
            'mobile'        => to_latin_numbers($request->input('mobile')),
            'national_code' => to_latin_numbers($request->input('national_code')),
           'password'      => Hash::make($request->input('password')),
        ];

        $user = User::create($user_data);

        $role = Role::find($request->input('role'));
        if($role) {
            $user->syncRoles([$role->name]);
        }

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "کاربر $user->name ایجاد شد."
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user           = User::findOrFail($id);
        $roles          = Role::pluck('display_name', 'id');
        $provinces      = Province::with('cities')->get();
        $userAddress    = $user->latestAddress();

        return view()->first(['admin.users.edit', 'user::edit'], compact('user', 'roles', 'provinces', 'userAddress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUser $request
     * @param integer $id
     * @return Response
     */
    public function update(UpdateUser $request, $id)
    {
        $user   = User::findOrFail($id);

        $user->first_name       = $request->input('first_name');
        $user->last_name        = $request->input('last_name');
        $user->name             = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->email            = $request->input('email');
        $user->mobile           = to_latin_numbers($request->input('mobile'));
        $user->national_code    = to_latin_numbers($request->input('national_code'));
        $user->password    = Hash::make($request->input('password'));
        $user->save();

        $role = Role::find($request->input('role'));
        $userRoles = [];
        if($role) {
            $userRoles = [$role->name];
        }
        $user->syncRoles($userRoles);

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "کاربر $user->name آپدیت شد."
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request  $request
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);

        if ( isset($data['delete'] ))
        {
            $user->delete();
        }

        success();
        return redirect()->route('admin.users.index');
    }
}
