<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Payment;
use App\Models\Program;
use App\Models\Student;
use App\Models\TranscriptRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Demo data: 1 admin, 10 students, 8 transcript requests in different stages.
 *
 * Safe to run more than once (everything is matched on email, matric number
 * or reference number). It is NOT part of DatabaseSeeder on purpose, so it
 * never runs on a live site by accident.
 *
 * Needs DEMO_PASSWORD in the environment. Every demo account uses it.
 */
class DemoDataSeeder extends Seeder
{
    private const FEE = 5000.00;

    private int $paymentCounter = 0;

    public function run(): void
    {
        $password = env('DEMO_PASSWORD');

        if (! $password) {
            $this->command?->warn('DEMO_PASSWORD is not set. Skipping demo data.');
            return;
        }

        $this->seedAdmin($password);
        $this->seedStudents($password);

        $this->command?->info('Demo data ready: 1 admin, 10 students, 8 transcript requests.');
    }

    private function seedAdmin(string $password): void
    {
        $user = $this->makeUser('Hadiza Umar', 'admin@demo.test', 'admin', $password);

        Admin::updateOrCreate(
            ['user_id' => $user->id],
            [
                'staff_id' => 'KPT-STF-0001',
                'department' => 'Registry',
                'designation' => 'Transcript Officer',
                'phone' => '08030000000',
            ]
        );
    }

    private function seedStudents(string $password): void
    {
        foreach ($this->students() as $row) {
            $program = Program::where('program_code', $row['program'])->first();

            if (! $program) {
                $this->command?->warn("Program {$row['program']} not found. Skipping {$row['name']}.");
                continue;
            }

            $user = $this->makeUser($row['name'], $row['email'], 'student', $password);

            $student = Student::updateOrCreate(
                ['matric_number' => $row['matric']],
                [
                    'user_id' => $user->id,
                    'program_id' => $program->id,
                    'phone' => $row['phone'],
                    'address' => $row['address'],
                    'date_of_birth' => $row['dob'],
                    'gender' => $row['gender'],
                    'admission_year' => 2023,
                    'graduation_year' => 2025,
                    'status' => 'graduated',
                ]
            );

            foreach ($row['requests'] as $req) {
                $this->makeRequest($student, $req);
            }
        }
    }

    private function makeUser(string $name, string $email, string $role, string $password): User
    {
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => $role,
            ]
        );

        if (! $user->email_verified_at) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        return $user;
    }

    private function makeRequest(Student $student, array $req): void
    {
        $this->paymentCounter++;

        $created = now()->subDays($req['days_ago'])->setTime(10, 30);

        $request = TranscriptRequest::updateOrCreate(
            ['reference_number' => $req['ref']],
            [
                'student_id' => $student->id,
                'purpose' => $req['purpose'],
                'destination_address' => $req['destination'],
                'status' => $req['status'],
                'admin_remarks' => $req['remarks'] ?? null,
            ]
        );

        $request->timestamps = false;
        $request->forceFill(['created_at' => $created, 'updated_at' => $created->copy()->addDay()])->save();

        $paid = $req['payment'] === 'successful';

        $payment = Payment::updateOrCreate(
            ['transcript_request_id' => $request->id],
            [
                'remita_rrr' => 'RRRDEMO' . str_pad((string) $this->paymentCounter, 7, '0', STR_PAD_LEFT),
                'amount' => self::FEE,
                'status' => $req['payment'],
                'paid_at' => $paid ? $created->copy()->addHours(2) : null,
            ]
        );

        $payment->timestamps = false;
        $payment->forceFill(['created_at' => $created, 'updated_at' => $created])->save();
    }

    private function students(): array
    {
        return [
            [
                'name' => 'Aisha Bello', 'email' => 'aisha.bello@demo.test', 'matric' => 'KPT/CST/23/0001',
                'program' => 'COM', 'gender' => 'female', 'dob' => '2000-03-14', 'phone' => '08030000001',
                'address' => 'Tudun Wada, Kaduna',
                'requests' => [[
                    'ref' => 'TR-2026-DEMO001', 'purpose' => 'further_studies',
                    'destination' => 'The Registrar, Ahmadu Bello University, Zaria, Kaduna State',
                    'status' => 'completed', 'payment' => 'successful', 'days_ago' => 21,
                    'remarks' => 'Transcript sealed and dispatched by courier.',
                ]],
            ],
            [
                'name' => 'Musa Ibrahim', 'email' => 'musa.ibrahim@demo.test', 'matric' => 'KPT/CST/23/0002',
                'program' => 'COM', 'gender' => 'male', 'dob' => '1999-11-02', 'phone' => '08030000002',
                'address' => 'Barnawa, Kaduna South',
                'requests' => [[
                    'ref' => 'TR-2026-DEMO002', 'purpose' => 'employment',
                    'destination' => 'Human Resources Department, First Bank of Nigeria, Kaduna',
                    'status' => 'processing', 'payment' => 'successful', 'days_ago' => 6,
                    'remarks' => 'Result verification in progress at the Exams office.',
                ]],
            ],
            [
                'name' => 'Fatima Yusuf', 'email' => 'fatima.yusuf@demo.test', 'matric' => 'KPT/CST/23/0003',
                'program' => 'FST', 'gender' => 'female', 'dob' => '2001-07-21', 'phone' => '08030000003',
                'address' => 'Malali, Kaduna North',
                'requests' => [[
                    'ref' => 'TR-2026-DEMO003', 'purpose' => 'employment',
                    'destination' => 'Quality Control Manager, Flour Mills of Nigeria, Lagos',
                    'status' => 'payment_confirmed', 'payment' => 'successful', 'days_ago' => 2,
                ]],
            ],
            [
                'name' => 'Chinedu Okafor', 'email' => 'chinedu.okafor@demo.test', 'matric' => 'KPT/CST/23/0004',
                'program' => 'SLT', 'gender' => 'male', 'dob' => '1998-12-09', 'phone' => '08030000004',
                'address' => 'Ungwan Rimi, Kaduna',
                'requests' => [[
                    'ref' => 'TR-2026-DEMO004', 'purpose' => 'other',
                    'destination' => 'WES Nigeria Evaluation Desk, Abuja',
                    'status' => 'pending', 'payment' => 'failed', 'days_ago' => 1,
                ]],
            ],
            [
                'name' => 'Zainab Abubakar', 'email' => 'zainab.abubakar@demo.test', 'matric' => 'KPT/CST/23/0005',
                'program' => 'STA', 'gender' => 'female', 'dob' => '2000-05-30', 'phone' => '08030000005',
                'address' => 'Sabon Tasha, Chikun',
                'requests' => [
                    [
                        'ref' => 'TR-2026-DEMO005', 'purpose' => 'further_studies',
                        'destination' => 'Postgraduate School, University of Ilorin, Kwara State',
                        'status' => 'completed', 'payment' => 'successful', 'days_ago' => 30,
                        'remarks' => 'Collected in person at the Registry.',
                    ],
                    [
                        'ref' => 'TR-2026-DEMO006', 'purpose' => 'employment',
                        'destination' => 'National Bureau of Statistics, Abuja',
                        'status' => 'pending', 'payment' => 'pending', 'days_ago' => 0,
                    ],
                ],
            ],
            [
                'name' => 'Emeka Nwosu', 'email' => 'emeka.nwosu@demo.test', 'matric' => 'KPT/CST/23/0006',
                'program' => 'COM', 'gender' => 'male', 'dob' => '1999-02-18', 'phone' => '08030000006',
                'address' => 'Kawo, Kaduna North',
                'requests' => [[
                    'ref' => 'TR-2026-DEMO007', 'purpose' => 'employment',
                    'destination' => 'ICT Unit, Kaduna State Internal Revenue Service, Kaduna',
                    'status' => 'payment_confirmed', 'payment' => 'successful', 'days_ago' => 3,
                ]],
            ],
            [
                'name' => 'Hauwa Suleiman', 'email' => 'hauwa.suleiman@demo.test', 'matric' => 'KPT/CST/23/0007',
                'program' => 'FST', 'gender' => 'female', 'dob' => '2001-01-12', 'phone' => '08030000007',
                'address' => 'Rigasa, Igabi',
                'requests' => [[
                    'ref' => 'TR-2026-DEMO008', 'purpose' => 'further_studies',
                    'destination' => 'The Registrar, Federal University of Technology, Minna, Niger State',
                    'status' => 'processing', 'payment' => 'successful', 'days_ago' => 9,
                    'remarks' => 'Awaiting HOD signature.',
                ]],
            ],
            [
                'name' => 'Joseph Danjuma', 'email' => 'joseph.danjuma@demo.test', 'matric' => 'KPT/CST/23/0008',
                'program' => 'SLT', 'gender' => 'male', 'dob' => '1999-09-25', 'phone' => '08030000008',
                'address' => 'Narayi, Kaduna', 'requests' => [],
            ],
            [
                'name' => 'Maryam Garba', 'email' => 'maryam.garba@demo.test', 'matric' => 'KPT/CST/23/0009',
                'program' => 'STA', 'gender' => 'female', 'dob' => '2000-10-06', 'phone' => '08030000009',
                'address' => 'Ungwan Sarki, Kaduna', 'requests' => [],
            ],
            [
                'name' => 'Ibrahim Lawal', 'email' => 'ibrahim.lawal@demo.test', 'matric' => 'KPT/CST/23/0010',
                'program' => 'COM', 'gender' => 'male', 'dob' => '1998-06-17', 'phone' => '08030000010',
                'address' => 'Television, Kaduna', 'requests' => [],
            ],
        ];
    }
}