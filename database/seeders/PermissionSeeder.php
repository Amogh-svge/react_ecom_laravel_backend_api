<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'delete.product', 'edit.category', 'delete.category', 'create.role', 'edit.role', 'delete.role', 'create.order',
            'edit.order', 'delete.order', 'create.setting', 'edit.setting', 'delete.setting', 'create.subcategory', 'edit.subcategory', 'delete.subcategory',
            'create.slider', 'edit.slider', 'delete.slider', 'create.siteInfo', 'edit.siteInfo', 'delete.siteInfo'
        ];
        $groups = ['product', 'category', 'role', 'order', 'setting', 'subcategory', 'slider', 'siteInfo'];

        foreach ($permissions as $permission) {
            foreach ($groups as $group) {
                if (Str::of($permission)->after('.')->is($group)) {
                    DB::table('permissions')->insert([
                        'name' => $permission,
                        'group' => $group,
                        'guard_name' => 'sanctum',
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }
}
