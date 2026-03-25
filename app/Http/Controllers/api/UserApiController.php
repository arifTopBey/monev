<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
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
}
