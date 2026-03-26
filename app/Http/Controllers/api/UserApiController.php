<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\UserApiStoreRequest;
use App\Http\Requests\UserApiUpdateRequest;
use App\Http\Resources\UserResource;
use App\Interface\UserInterface;
use Exception;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    
    
     private UserInterface $userInterface;


    public function __construct(UserInterface $userInterface){
        $this->userInterface = $userInterface;
    }


    public function index(Request $request){
        
     try{
            $user = $this->userInterface->getAll($request->search, $request->limit, true);
           
            return ResponseHelper::jsonResponse(true, 'Data User berhasil diambil', UserResource::collection($user), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

        public function store(UserApiStoreRequest $request){

            $validated = $request->validated();
            try{

                $user = $this->userInterface->create($validated);

                return ResponseHelper::jsonResponse(true, 'Berhasil membuat data user',  new UserResource($user), 201);

            }catch(Exception $exception){

                return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

            }
        }

        public function show($id){

        try{

            $user = $this->userInterface->getById($id);

            if(!$user){
                return ResponseHelper::jsonResponse(false, 'Data user tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data user',  new UserResource($user), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

     public function update(UserApiUpdateRequest $request, $id){

         $validated = $request->validated();

         try{

             $user = $this->userInterface->getById($id);

            if(!$user){
                return ResponseHelper::jsonResponse(false, 'Data user tidak ditemukan', null, 404);
            }

            $user = $this->userInterface->update($validated, $id);

            return ResponseHelper::jsonResponse(true, 'Berhasil memperbarui user',  new UserResource($user), 200);

         }catch(Exception $exception){
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
         }
    }

    public function destroy(int $id){

         try{

          $user = $this->userInterface->getById($id);

            if(!$user){
                return ResponseHelper::jsonResponse(false, 'Data user tidak ditemukan', null, 404);
            }

            $this->userInterface->delete($id);

            return ResponseHelper::jsonResponse(true, 'Berhasil menghapus User', null, 200);

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal menghapus data: ' . $exception->getMessage()]);
         }
    }



}
