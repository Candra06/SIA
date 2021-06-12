<?php

use App\Submenu;
use Illuminate\Database\Seeder;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Submenu::create([
            'menu_id' => 1,
            'submenu' => 'Home',
            'url' => '/dashboard/homes/index',
            'is_active' => '1'
        ]);
        
        Submenu::create([
            'menu_id' => 2,
            'submenu' => 'Menu Management',
            'url' => '/dashboard/managements/menu',
            'is_active' => '1'
        ]);
        Submenu::create([
            'menu_id' => 2,
            'submenu' => 'Submenu Management',
            'url' => '/dashboard/managements/submenu',
            'is_active' => '1'
        ]);
        Submenu::create([
            'menu_id' => 2,
            'submenu' => 'Role Permission',
            'url' => '/dashboard/managements/role',
            'is_active' => '1'
        ]);
        Submenu::create([
            'menu_id' => 3,
            'submenu' => 'Manage Users',
            'url' => '/dashboard/users/index',
            'is_active' => '1'
        ]);
        Submenu::create([
            'menu_id' => 4,
            'submenu' => 'General',
            'url' => '/dashboard/settings/general',
            'is_active' => '1'
        ]);
        Submenu::create([
            'menu_id' => 4,
            'submenu' => 'Your Profile',
            'url' => '/dashboard/settings/profile',
            'is_active' => '1'
        ]);
        Submenu::create([
            'menu_id' => 4,
            'submenu' => 'Security',
            'url' => '/dashboard/settings/password',
            'is_active' => '1'
        ]);
    }
}
