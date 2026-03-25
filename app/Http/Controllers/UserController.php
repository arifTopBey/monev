<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\UserApiStoreRequest;
use App\Http\Requests\UserApiUpdateRequest;
use App\Interface\UserInterface;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
     private UserInterface $userInterface;


    public function __construct(UserInterface $userInterface){
        $this->userInterface = $userInterface;
    }

    public function index(Request $request){

        $search = $request->input('search');

        $perPage = $request->input('row_per_page', 10);

       

        $data = $this->userInterface->getAllPaginate($search ?? null, $perPage);
        $data->appends($request->all());


        return view('admin.users.index', compact('data'));
    }

    public function create(){

        $roles = Role::all();

        return view('admin.users.add', compact('roles'));
    }

    public function store(UserApiStoreRequest $request){

        $validated = $request->validated();

         try{

            $user = $this->userInterface->create($validated);

            return redirect()->route('super.user.list')->with('success', 'Data User berhasil ditambah');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $exception->getMessage()]);
         }
    }

    public function show($id){

        $roles = Role::all();
        $user = $this->userInterface->getById($id);

        if(!$user){
            return redirect()->route('super.user.list')->withErrors(['error' => 'Data tidak ditemukan']);
        }


        return view('admin.users.detail', compact('user', 'roles'));
    }

    public function update(UserApiUpdateRequest $request, $id){

         $validated = $request->validated();

         try{

            $user = $this->userInterface->update($validated, $id);

            return redirect()->route('super.user.list')->with('success', 'Data User berhasil diubah');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $exception->getMessage()]);
         }
    }

    public function destroy(int $id){


         try{

            $this->userInterface->delete($id);

            return redirect()->route('super.user.list')->with('success', 'Data User berhasil dihapus');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal menghapus data: ' . $exception->getMessage()]);
         }

    }
}
