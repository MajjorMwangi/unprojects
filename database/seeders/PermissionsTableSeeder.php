<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'country_create',
            ],
            [
                'id'    => 18,
                'title' => 'country_edit',
            ],
            [
                'id'    => 19,
                'title' => 'country_show',
            ],
            [
                'id'    => 20,
                'title' => 'country_delete',
            ],
            [
                'id'    => 21,
                'title' => 'country_access',
            ],
            [
                'id'    => 22,
                'title' => 'lead_organisation_create',
            ],
            [
                'id'    => 23,
                'title' => 'lead_organisation_edit',
            ],
            [
                'id'    => 24,
                'title' => 'lead_organisation_show',
            ],
            [
                'id'    => 25,
                'title' => 'lead_organisation_delete',
            ],
            [
                'id'    => 26,
                'title' => 'lead_organisation_access',
            ],
            [
                'id'    => 27,
                'title' => 'donor_create',
            ],
            [
                'id'    => 28,
                'title' => 'donor_edit',
            ],
            [
                'id'    => 29,
                'title' => 'donor_show',
            ],
            [
                'id'    => 30,
                'title' => 'donor_delete',
            ],
            [
                'id'    => 31,
                'title' => 'donor_access',
            ],
            [
                'id'    => 32,
                'title' => 'theme_create',
            ],
            [
                'id'    => 33,
                'title' => 'theme_edit',
            ],
            [
                'id'    => 34,
                'title' => 'theme_show',
            ],
            [
                'id'    => 35,
                'title' => 'theme_delete',
            ],
            [
                'id'    => 36,
                'title' => 'theme_access',
            ],
            [
                'id'    => 37,
                'title' => 'fund_create',
            ],
            [
                'id'    => 38,
                'title' => 'fund_edit',
            ],
            [
                'id'    => 39,
                'title' => 'fund_show',
            ],
            [
                'id'    => 40,
                'title' => 'fund_delete',
            ],
            [
                'id'    => 41,
                'title' => 'fund_access',
            ],
            [
                'id'    => 42,
                'title' => 'project_create',
            ],
            [
                'id'    => 43,
                'title' => 'project_edit',
            ],
            [
                'id'    => 44,
                'title' => 'project_show',
            ],
            [
                'id'    => 45,
                'title' => 'project_delete',
            ],
            [
                'id'    => 46,
                'title' => 'project_access',
            ],
            [
                'id'    => 47,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
