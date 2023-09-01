<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Material;
use App\Models\Setting;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FreshStart extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'admin-dashboard'
            ],
            [
                'name' => 'create-role',
            ],
            [
                'name' => 'view-role',
            ],
            [
                'name' => 'update-role',
            ],
            [
                'name' => 'delete-role',
            ],
            [
                'name' => 'crud-role',
            ],
            [
                'name' => 'create-permission',
            ],
            [
                'name' => 'view-permission',
            ],
            [
                'name' => 'update-permission',
            ],
            [
                'name' => 'delete-permission',
            ],
            [
                'name' => 'crud-permission',
            ],
            [
                'name' => 'create-user',
            ],
            [
                'name' => 'view-user',
            ],
            [
                'name' => 'update-user',
            ],
            [
                'name' => 'delete-user',
            ],
            [
                'name' => 'crud-user',
            ],
            [
                'name' => 'create-supplier',
            ],
            [
                'name' => 'view-supplier',
            ],
            [
                'name' => 'update-supplier',
            ],
            [
                'name' => 'delete-supplier',
            ],
            [
                'name' => 'crud-supplier',
            ],
            [
                'name' => 'create-customer',
            ],
            [
                'name' => 'view-customer',
            ],
            [
                'name' => 'update-customer',
            ],
            [
                'name' => 'delete-customer',
            ],
            [
                'name' => 'crud-customer',
            ],
            [
                'name' => 'create-material',
            ],
            [
                'name' => 'view-material',
            ],
            [
                'name' => 'update-material',
            ],
            [
                'name' => 'delete-material',
            ],
            [
                'name' => 'crud-material',
            ],
            [
                'name' => 'create-purchase',
            ],
            [
                'name' => 'view-purchase',
            ],
            [
                'name' => 'update-purchase',
            ],
            [
                'name' => 'delete-purchase',
            ],
            [
                'name' => 'crud-purchase',
            ],
            [
                'name' => 'create-order',
            ],
            [
                'name' => 'view-order',
            ],
            [
                'name' => 'update-order',
            ],
            [
                'name' => 'delete-order',
            ],
            [
                'name' => 'crud-order',
            ],
            [
                'name' => 'add-estimated-cost',
            ],
            [
                'name' => 'add-actual-cost',
            ],

            [
                'name' => 'create-summary',
            ],
            [
                'name' => 'view-summary',
            ],
            [
                'name' => 'update-summary',
            ],
            [
                'name' => 'delete-summary',
            ],
            [
                'name' => 'crud-summary',
            ],
            [
                'name' => 'create-setting',
            ],
            [
                'name' => 'view-setting',
            ],
            [
                'name' => 'update-setting',
            ],
            [
                'name' => 'delete-setting',
            ],
            [
                'name' => 'crud-setting',
            ],

        ];
        $admin_permission = [
            [
                'name' => 'admin-dashboard'
            ],
            [
                'name' => 'create-role',
            ],
            [
                'name' => 'view-role',
            ],
            [
                'name' => 'update-role',
            ],
            [
                'name' => 'delete-role',
            ],
            [
                'name' => 'crud-role',
            ],
            [
                'name' => 'create-permission',
            ],
            [
                'name' => 'view-permission',
            ],
            [
                'name' => 'update-permission',
            ],
            [
                'name' => 'delete-permission',
            ],
            [
                'name' => 'crud-permission',
            ],
            [
                'name' => 'create-user',
            ],
            [
                'name' => 'view-user',
            ],
            [
                'name' => 'update-user',
            ],
            [
                'name' => 'delete-user',
            ],
            [
                'name' => 'crud-user',
            ],
            [
                'name' => 'create-supplier',
            ],
            [
                'name' => 'view-supplier',
            ],
            [
                'name' => 'update-supplier',
            ],
            [
                'name' => 'delete-supplier',
            ],
            [
                'name' => 'crud-supplier',
            ],
            [
                'name' => 'create-customer',
            ],
            [
                'name' => 'view-customer',
            ],
            [
                'name' => 'update-customer',
            ],
            [
                'name' => 'delete-customer',
            ],
            [
                'name' => 'crud-customer',
            ],
            [
                'name' => 'create-material',
            ],
            [
                'name' => 'view-material',
            ],
            [
                'name' => 'update-material',
            ],
            [
                'name' => 'delete-material',
            ],
            [
                'name' => 'crud-material',
            ],
            [
                'name' => 'create-purchase',
            ],
            [
                'name' => 'view-purchase',
            ],
            [
                'name' => 'update-purchase',
            ],
            [
                'name' => 'delete-purchase',
            ],
            [
                'name' => 'crud-purchase',
            ],
            [
                'name' => 'create-order',
            ],
            [
                'name' => 'view-order',
            ],
            [
                'name' => 'update-order',
            ],
            [
                'name' => 'delete-order',
            ],
            [
                'name' => 'crud-order',
            ],
            [
                'name' => 'add-estimated-cost',
            ],
            [
                'name' => 'add-actual-cost',
            ],
            [
                'name' => 'create-summary',
            ],
            [
                'name' => 'view-summary',
            ],
            [
                'name' => 'update-summary',
            ],
            [
                'name' => 'delete-summary',
            ],
            [
                'name' => 'crud-summary',
            ],
            [
                'name' => 'create-setting',
            ],
            [
                'name' => 'view-setting',
            ],
            [
                'name' => 'update-setting',
            ],
            [
                'name' => 'delete-setting',
            ],
            [
                'name' => 'crud-setting',
            ],


        ];
        $super_admin_permission = [

            [
                'name' => 'admin-dashboard'
            ],
            [
                'name' => 'create-role',
            ],
            [
                'name' => 'view-role',
            ],
            [
                'name' => 'update-role',
            ],
            [
                'name' => 'delete-role',
            ],
            [
                'name' => 'crud-role',
            ],
            [
                'name' => 'create-permission',
            ],
            [
                'name' => 'view-permission',
            ],
            [
                'name' => 'update-permission',
            ],
            [
                'name' => 'delete-permission',
            ],
            [
                'name' => 'crud-permission',
            ],
            [
                'name' => 'create-user',
            ],
            [
                'name' => 'view-user',
            ],
            [
                'name' => 'update-user',
            ],
            [
                'name' => 'delete-user',
            ],
            [
                'name' => 'crud-user',
            ],
            [
                'name' => 'create-supplier',
            ],
            [
                'name' => 'view-supplier',
            ],
            [
                'name' => 'update-supplier',
            ],
            [
                'name' => 'delete-supplier',
            ],
            [
                'name' => 'crud-supplier',
            ],
            [
                'name' => 'create-customer',
            ],
            [
                'name' => 'view-customer',
            ],
            [
                'name' => 'update-customer',
            ],
            [
                'name' => 'delete-customer',
            ],
            [
                'name' => 'crud-customer',
            ],
            [
                'name' => 'create-material',
            ],
            [
                'name' => 'view-material',
            ],
            [
                'name' => 'update-material',
            ],
            [
                'name' => 'delete-material',
            ],
            [
                'name' => 'crud-material',
            ],
            [
                'name' => 'create-purchase',
            ],
            [
                'name' => 'view-purchase',
            ],
            [
                'name' => 'update-purchase',
            ],
            [
                'name' => 'delete-purchase',
            ],
            [
                'name' => 'crud-purchase',
            ],
            [
                'name' => 'create-order',
            ],
            [
                'name' => 'view-order',
            ],
            [
                'name' => 'update-order',
            ],
            [
                'name' => 'delete-order',
            ],
            [
                'name' => 'crud-order',
            ],
            [
                'name' => 'add-estimated-cost',
            ],
            [
                'name' => 'add-actual-cost',
            ],
            [
                'name' => 'create-summary',
            ],
            [
                'name' => 'view-summary',
            ],
            [
                'name' => 'update-summary',
            ],
            [
                'name' => 'delete-summary',
            ],
            [
                'name' => 'crud-summary',
            ],
            [
                'name' => 'create-setting',
            ],
            [
                'name' => 'view-setting',
            ],
            [
                'name' => 'update-setting',
            ],
            [
                'name' => 'delete-setting',
            ],
            [
                'name' => 'crud-setting',
            ],


        ];

        foreach($permissions as $item){
            Permission::create($item);
        }
        $admin_user = User::create([

            'user_name' => 'admin',
            'slug' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo($admin_permission);
        $admin_user->assignRole($admin_role);

        $super_admin_role = Role::create(['name' => 'super-admin']);

        $super_admin = User::create([
            'user_name' => 'super-admin',
            'slug' => 'admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $super_admin_role->givePermissionTo($super_admin_permission);
        $super_admin->assignRole($super_admin_role);

        $customers = [
            [
                'customer_name' => 'Customer-1',
                'slug' => 'customer-1'
            ],
            [
                'customer_name' => 'Customer-2',
                'slug' => 'customer-2'
            ],
        ];
        foreach($customers as $item){
            Customer::create($item);
        }


        $suppliers = [
            [
                'supplier_name' => 'Supplier-1',
                'slug' => 'supplier-1'
            ],
            [
                'supplier_name' => 'Supplier-2',
                'slug' => 'supplier-2'
            ],
        ];
        foreach($suppliers as $item){
            Supplier::create($item);
        }

        $materials = [
            [
                'material_name' => 'Food Board',
                'slug' => Str::slug('Food Board'),
                'unit_price' => '2',
                'enable_job_order' => false,
            ],
            [
                'material_name' => 'Grey Board',
                'slug' => Str::slug('Grey Board'),
                'unit_price' => '3',
                'enable_job_order' => false,
            ],
            [
                'material_name' => 'Duplex',
                'slug' => Str::slug('Duplex'),
                'unit_price' => '5',
                'enable_job_order' => false,
            ],
            [
                'material_name' => 'Art Glossy',
                'slug' => Str::slug('Art Glossy'),
                'unit_price' => '3',
                'enable_job_order' => false,
            ],
            [
                'material_name' => 'W.Free',
                'slug' => Str::slug('W.Free'),
                'unit_price' => '5',
                'enable_job_order' => false,

            ],
            [
                'material_name' => 'Laser Die Block & Zinc Block',
                'slug' => Str::slug('Laser Die Block & Zinc Block'),
                'unit_price' => '6',
                'enable_job_order' => true,
            ],
        ];
        foreach($materials as $item){
            Material::create($item);
        }

        Setting::create(['app_name' => 'Al-Warraq']);

    }
}
