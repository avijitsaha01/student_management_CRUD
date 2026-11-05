<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'student_id' => 'ZUMS-2022-001',
                'name'       => 'Abdullah Al Mamun',
                'email'      => 'mamun.cse@zums.edu',
                'phone'      => '+880 1711-234567',
                'department' => 'Computer Science & Engineering',
                'semester'   => '7th Semester',
            ],
            [
                'student_id' => 'ZUMS-2022-045',
                'name'       => 'Fatima Zahra',
                'email'      => 'fatima.se@zums.edu',
                'phone'      => '+880 1819-876543',
                'department' => 'Software Engineering',
                'semester'   => '6th Semester',
            ],
            [
                'student_id' => 'ZUMS-2023-012',
                'name'       => 'Tanvir Hasan',
                'email'      => 'tanvir.bba@zums.edu',
                'phone'      => '+880 1622-334455',
                'department' => 'Business Administration (BBA)',
                'semester'   => '4th Semester',
            ],
            [
                'student_id' => 'ZUMS-2023-088',
                'name'       => 'Nusrat Jahan',
                'email'      => 'nusrat.eee@zums.edu',
                'phone'      => '+880 1913-445566',
                'department' => 'Electrical & Electronic Engineering',
                'semester'   => '3rd Semester',
            ],
            [
                'student_id' => 'ZUMS-2024-005',
                'name'       => 'Rahat Chowdhury',
                'email'      => 'rahat.cse@zums.edu',
                'phone'      => '+880 1521-778899',
                'department' => 'Computer Science & Engineering',
                'semester'   => '2nd Semester',
            ],
            [
                'student_id' => 'ZUMS-2024-034',
                'name'       => 'Sabrina Rahman',
                'email'      => 'sabrina.eng@zums.edu',
                'phone'      => '+880 1733-112233',
                'department' => 'English Language & Literature',
                'semester'   => '1st Semester',
            ],
        ];

        foreach ($students as $student) {
            Student::firstOrCreate(
                ['student_id' => $student['student_id']],
                array_merge($student, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ])
            );
        }
    }
}
