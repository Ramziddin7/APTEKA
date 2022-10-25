<?php

namespace Database\Seeders;

use App\Models\Debt;
use App\Models\UserJoinRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserJoinRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 10;
        $data = [];
        $one = 1;
        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                'user_id' => $one++,
                'role_id' => rand(1, $count),
            ];
        }
        DB::table('user_join_roles')->insert(
            $data
        );
    }
}
