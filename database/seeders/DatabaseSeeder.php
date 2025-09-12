<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Test@1234'),
                'status' => 'active',
                'email_verified_at'=>Carbon::now(),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ]);



        $role = Role::create(['name' => 'super-admin','guard_name'=>'web']);
        $HqRole = Role::create(['name' => 'hq','guard_name'=>'web']);
        $branchRole = Role::create(['name' => 'branch','guard_name'=>'web']);

        $user = User::find(1);
        $strRole = Role::where('id', 1)->pluck('name')->first();  
        $user->assignRole(strtolower($strRole));

    }
}
