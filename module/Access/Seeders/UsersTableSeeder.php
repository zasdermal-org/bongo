<?php

namespace Module\Access\Seeders;

use Module\Access\Models\Role;
use Module\Access\Models\User;
use Module\Access\Models\Employee;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $role_admin = Role::where('slug', 'admin')->first();
        $role_editor = Role::where('slug', 'editor')->first();
        $role_employee = Role::where('slug', 'employee')->first();

        $users = [
            [
                'role_id' => $role_admin->id,
                'username' => 'eusufahamed',
                'name' => 'Eusuf Ahamed',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-201',
                'name' => 'Md Hussain Shujat',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-202',
                'name' => 'Md. Nazmul Kabir',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-203',
                'name' => 'Amit Chandra Das',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-207',
                'name' => 'Shovon Das',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-205',
                'name' => 'Anup Datta Shuvo',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-235',
                'name' => 'Tanjib Rahman',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-250',
                'name' => 'Ovizit Kumar',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-206',
                'name' => 'Sujon Sharma',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-215',
                'name' => 'Md. Akibul Islam',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-210',
                'name' => 'Rudra Dev',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-212',
                'name' => 'Md. Kobir Hossain',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-216',
                'name' => 'Masud Rana',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-217',
                'name' => 'Rabiul Awyal',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-218',
                'name' => 'Md.Rocky Hossain',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-219',
                'name' => 'Emran',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-221',
                'name' => 'Md Abdul Hakim',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-222',
                'name' => 'MD. Sarif',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-224',
                'name' => 'MD. Iqbal Faruk',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-225',
                'name' => 'Md. Mottaleb Hossian',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-226',
                'name' => 'Md. Shah Alam',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-227',
                'name' => 'Noman Ali',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-228',
                'name' => 'Md. Nazrul Islam',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-229',
                'name' => 'Md. Shoriful Islam',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-230',
                'name' => 'Shahid Hasan',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-232',
                'name' => 'S M Mahabub Rahman',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-233',
                'name' => 'Jaharul',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-236',
                'name' => 'Md. Ripon Ahamed',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-240',
                'name' => 'Mithon Kumar Pramanik',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-241',
                'name' => 'Md. Shafiqul Islam',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-243',
                'name' => 'Md. Abdul Alim',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-244',
                'name' => 'Md. Habibur Rahman',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-246',
                'name' => 'Omar Faruk',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-247',
                'name' => 'Md. Jahurul Islam',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-248',
                'name' => 'Md. Zahurul Islam',
                'password' => Hash::make('123456')
            ],
            [
                'role_id' => $role_employee->id,
                'username' => 'BA-251',
                'name' => 'Fazale Rabbi',
                'password' => Hash::make('123456')
            ],
        ];

        foreach ($users as $user) {
            $user = User::create([
                'role_id' => $user['role_id'],
                'username' => $user['username'],
                'name' => $user['name'],
                'password' => $user['password'],
                'is_active' => 'Active'
            ]);

            Employee::create([
                'user_id' => $user->id
            ]);
        }
    }
}
