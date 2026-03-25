<?php

namespace App\Repository;

use App\Interface\UserInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserRepositoryInterface implements UserInterface {

   public function getAll(?string $search, ?int $limit, bool $execute)
    {

        $query = User::where('role_id', '!=', 1) // Tambahkan baris ini
        ->where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

       
        $query->orderByDesc('id');

        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginate(?string $search, ?int $rowPerPage)
    {

        $query = $this->getAll($search, $rowPerPage, false);

        return $query->paginate($rowPerPage);
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {

        

            $user = new User();
            $user->username = $data['username'];
            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->mobile_no = $data['mobile_no'];
            $user->role_id = $data['role_id'];

            $user->is_active = 1;
            $user->is_admin = 1;
            $user->is_active = 1;
            $user->is_supper = 0;

            if(isset($data['image'])){
                $user->image = $data['image']->store('users', 'public');
            }

        
            $user->password = bcrypt($data['password']);
            $user->email = $data['email'];

            $user->save();

            DB::commit();

            return $user;
        } catch (Exception $exception) {

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function getById($id)
    {

        $user = User::where('id', $id)->first();

        return $user;
    }

     public function update(array $data, int $id){

         DB::beginTransaction();

        try {

        

            $user = User::where('id', $id)->first();

            if(isset($data['username'])){
                $user->username = $data['username'];
            }
            if(isset($data['firstname'])){
                $user->firstname = $data['firstname'];
            }
            if(isset($data['lastname'])){
                $user->lastname = $data['lastname'];
            }
            if(isset($data['mobile_no'])){
                $user->mobile_no = $data['mobile_no'];
            }
            if(isset($data['role_id'])){
                $user->role_id = $data['role_id'];
            }
            if(isset($data['password'])){
                $user->password = bcrypt($data['password']);
            }
            if(isset($data['email'])){
                $user->email = $data['email'];
            }
            if(isset($data['image'])){

                Storage::disk('public')->delete($user->image);
                $user->image = $data['image']->store('users', 'public');
            }

            $user->is_active = 1;
            $user->is_admin = 1;
            $user->is_active = 1;
            $user->is_supper = 0;

            $user->save();

            DB::commit();

            return $user;
        } catch (Exception $exception) {

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }

     }

     public function delete(int $id){

         DB::beginTransaction();

        try {

            $user = User::where('id', $id)->first();

            if($user->image){
                  Storage::disk('public')->delete($user->image);
            }
            $user->delete();

            DB::commit();

            return $user;
        } catch (Exception $exception) {

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }

     }

}