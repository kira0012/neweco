<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => bcrypt('eco@dmin'),
            'remember_token' => str_random(60)
        ]);

        DB::table('payment_types')->insert([
            'type' => 'Cash'
        ]);

        DB::table('payment_types')->insert([
            'type' => 'Cheque'
        ]);

        DB::table('payment_types')->insert([
            'type' => 'Direct Deposit'
        ]);

        DB::table('payment_types')->insert([
            'type' => 'Cash Advance'
        ]);

        DB::table('payment_types')->insert([
            'type' => 'Withholding Tax'
        ]);

        

        Permission::create(['name' => 'Inventory']);
        Permission::create(['name' => 'Customers']);
        Permission::create(['name' => 'Payments']);
        Permission::create(['name' => 'Reports']);
        Permission::create(['name' => 'Construction']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $admin = User::findorfail('1');

        $admin->assignRole('admin');

    }
}
