<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view mutasi-tag-bin1']);
        Permission::create(['name' => 'delete mutasi-tag-bin1']);
        Permission::create(['name' => 'view mutasi-tag-bin2']);
        Permission::create(['name' => 'delete mutasi-tag-bin2']);
        Permission::create(['name' => 'view mutasi-tag-bin3']);
        Permission::create(['name' => 'delete mutasi-tag-bin3']);
        Permission::create(['name' => 'view mutasi-tag-bin4']);
        Permission::create(['name' => 'delete mutasi-tag-bin4']);

        Permission::create(['name' => 'view mutasi-cw1']);
        Permission::create(['name' => 'delete mutasi-cw1']);
        Permission::create(['name' => 'view mutasi-cw2']);
        Permission::create(['name' => 'delete mutasi-cw2']);
        Permission::create(['name' => 'view mutasi-cw3']);
        Permission::create(['name' => 'delete mutasi-cw3']);
        Permission::create(['name' => 'view mutasi-cw4']);
        Permission::create(['name' => 'delete mutasi-cw4']);

        Permission::create(['name' => 'view mutasi-d1']);
        Permission::create(['name' => 'delete mutasi-d1']);
        Permission::create(['name' => 'view mutasi-d2']);
        Permission::create(['name' => 'delete mutasi-d2']);
        Permission::create(['name' => 'view mutasi-d3']);
        Permission::create(['name' => 'delete mutasi-d3']);
        Permission::create(['name' => 'view mutasi-d4']);
        Permission::create(['name' => 'delete mutasi-d4']);

        Permission::create(['name' => 'view crystal-report1']);
        Permission::create(['name' => 'delete crystal-report1']);
        Permission::create(['name' => 'view crystal-report2']);
        Permission::create(['name' => 'delete crystal-report2']);
        Permission::create(['name' => 'view crystal-report3']);
        Permission::create(['name' => 'delete crystal-report3']);
        Permission::create(['name' => 'view crystal-report4']);
        Permission::create(['name' => 'delete crystal-report4']);

        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'edit role']);

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'edit user']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view mutasi-tag-bin4');
        $adminRole->givePermissionTo('delete mutasi-tag-bin4');
        $adminRole->givePermissionTo('view mutasi-cw4');
        $adminRole->givePermissionTo('delete mutasi-cw4');
        $adminRole->givePermissionTo('view mutasi-d4');
        $adminRole->givePermissionTo('delete mutasi-d4');
        $adminRole->givePermissionTo('view crystal-report4');
        $adminRole->givePermissionTo('delete crystal-report4');
        $adminRole->givePermissionTo('view user');

        $superadminRole = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule

        // create demo users
        
        $userAdmin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123abc')
        ]);
        $userAdmin->assignRole($adminRole);

        $userSuperAdmin = User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('abc123')
        ]);
        $userSuperAdmin->assignRole($superadminRole);
    }
}
