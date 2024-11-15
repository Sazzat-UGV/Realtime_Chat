<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $module_array = [
            'Dashboard',
            'Categories',
            'Modules',
            'Permissions',
            'Roles',
            'Users',
            'Settings',
            'Database Backup',
        ];

        foreach ($module_array as $module) {
            Module::updateOrCreate([
                'name' => $module,
                'slug' => Str::slug($module),
            ]);
        }
    }
}
