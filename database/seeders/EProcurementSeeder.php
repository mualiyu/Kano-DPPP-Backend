<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mda;
use App\Models\Applicant;
use App\Models\SysRequirement;
use Illuminate\Support\Facades\Hash;

class EProcurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create MDAs
        $mdas = [
            [
                'name' => 'Ministry of Health',
                'code' => 'MOH',
                'type' => 'ministry',
                'description' => 'Ministry responsible for health services in Kano State',
                'head_name' => 'Dr. Aminu Ibrahim Tsanyawa',
                'head_title' => 'Commissioner',
                'email' => 'info@kanohealth.gov.ng',
                'phone' => '+234 64 123456',
                'address' => 'Ministry of Health, Kano State',
                'annual_budget' => 5000000000.00,
                'status' => 'active',
            ],
            [
                'name' => 'Ministry of Education',
                'code' => 'MOE',
                'type' => 'ministry',
                'description' => 'Ministry responsible for education in Kano State',
                'head_name' => 'Dr. Sanusi Kiru',
                'head_title' => 'Commissioner',
                'email' => 'info@kanoeducation.gov.ng',
                'phone' => '+234 64 123457',
                'address' => 'Ministry of Education, Kano State',
                'annual_budget' => 8000000000.00,
                'status' => 'active',
            ],
            [
                'name' => 'Ministry of Works and Housing',
                'code' => 'MOWH',
                'type' => 'ministry',
                'description' => 'Ministry responsible for infrastructure development',
                'head_name' => 'Engr. Idris Wada Saleh',
                'head_title' => 'Commissioner',
                'email' => 'info@kanoworks.gov.ng',
                'phone' => '+234 64 123458',
                'address' => 'Ministry of Works and Housing, Kano State',
                'annual_budget' => 12000000000.00,
                'status' => 'active',
            ],
            [
                'name' => 'Kano State Rural Electrification Board',
                'code' => 'KREB',
                'type' => 'agency',
                'description' => 'Agency responsible for rural electrification projects',
                'head_name' => 'Engr. Ahmad Garba',
                'head_title' => 'Managing Director',
                'email' => 'info@kreb.gov.ng',
                'phone' => '+234 64 123459',
                'address' => 'KREB Headquarters, Kano State',
                'annual_budget' => 3000000000.00,
                'status' => 'active',
            ],
        ];

        foreach ($mdas as $mdaData) {
            Mda::updateOrCreate(
                ['code' => $mdaData['code']],
                $mdaData
            );
        }

        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@kanoprocurement.gov.ng'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password'),
                'phone' => '+234 64 000001',
                'role' => 'admin',
                'employee_id' => 'ADM001',
                'department' => '1', // Ministry of Health
                'position' => 'System Administrator',
                'status' => 'active',
                'permissions' => ['*'], // All permissions
            ]
        );

        // Create MDA Officers
        $mdaOfficers = [
            [
                'name' => 'Dr. Fatima Ibrahim',
                'email' => 'fatima.ibrahim@kanohealth.gov.ng',
                'password' => Hash::make('password'),
                'phone' => '+234 64 000002',
                'role' => 'mda_officer',
                'employee_id' => 'MOH001',
                'department' => '1', // Ministry of Health
                'position' => 'Head of Procurement',
                'status' => 'active',
            ],
            [
                'name' => 'Engr. Musa Abdullahi',
                'email' => 'musa.abdullahi@kanoeducation.gov.ng',
                'password' => Hash::make('password'),
                'phone' => '+234 64 000003',
                'role' => 'mda_officer',
                'employee_id' => 'MOE001',
                'department' => '2', // Ministry of Education
                'position' => 'Procurement Officer',
                'status' => 'active',
            ],
        ];

        foreach ($mdaOfficers as $officerData) {
            User::updateOrCreate(
                ['email' => $officerData['email']],
                $officerData
            );
        }

        // Create Auditor
        User::updateOrCreate(
            ['email' => 'auditor@kanoprocurement.gov.ng'],
            [
                'name' => 'Auditor General',
                'password' => Hash::make('password'),
                'phone' => '+234 64 000004',
                'role' => 'auditor',
                'employee_id' => 'AUD001',
                'department' => '1',
                'position' => 'Auditor General',
                'status' => 'active',
            ]
        );

        // Create Media Manager
        User::updateOrCreate(
            ['email' => 'media@kanoprocurement.gov.ng'],
            [
                'name' => 'Media Manager',
                'password' => Hash::make('password'),
                'phone' => '+234 64 000005',
                'role' => 'media',
                'employee_id' => 'MED001',
                'department' => '1',
                'position' => 'Media Manager',
                'status' => 'active',
            ]
        );

        // Create Sample Vendors
        $vendors = [
            [
                'name' => 'Tech Solutions Ltd',
                'username' => 'techsolutions',
                'email' => 'info@techsolutions.ng',
                'phone' => '+234 64 100001',
                'type' => 'company',
                'registration_number' => 'RC123456',
                'tin_number' => '12345678901',
                'bvn' => '12345678901',
                'financial_capacity' => 50000000.00,
                'years_in_business' => 5,
                'vendor_category' => 'medium',
                'approval_status' => 'approved',
                'approved_at' => now(),
                'approved_by' => 1,
                'performance_rating' => 4.5,
                'specializations' => ['IT Services', 'Software Development'],
                'contact_person' => 'John Doe',
                'contact_phone' => '+234 64 100001',
                'contact_email' => 'john@techsolutions.ng',
                'photo' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Construction Works Ltd',
                'username' => 'constructionworks',
                'email' => 'info@constructionworks.ng',
                'phone' => '+234 64 100002',
                'type' => 'company',
                'registration_number' => 'RC123457',
                'tin_number' => '12345678902',
                'bvn' => '12345678902',
                'financial_capacity' => 100000000.00,
                'years_in_business' => 10,
                'vendor_category' => 'large',
                'approval_status' => 'approved',
                'approved_at' => now(),
                'approved_by' => 1,
                'performance_rating' => 4.8,
                'specializations' => ['Construction', 'Infrastructure'],
                'contact_person' => 'Jane Smith',
                'contact_phone' => '+234 64 100002',
                'contact_email' => 'jane@constructionworks.ng',
                'photo' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Medical Supplies Co',
                'username' => 'medsupplies',
                'email' => 'info@medsupplies.ng',
                'phone' => '+234 64 100003',
                'type' => 'company',
                'registration_number' => 'RC123458',
                'tin_number' => '12345678903',
                'bvn' => '12345678903',
                'financial_capacity' => 25000000.00,
                'years_in_business' => 3,
                'vendor_category' => 'small',
                'approval_status' => 'pending',
                'specializations' => ['Medical Equipment', 'Pharmaceuticals'],
                'contact_person' => 'Dr. Ahmed Hassan',
                'contact_phone' => '+234 64 100003',
                'contact_email' => 'ahmed@medsupplies.ng',
                'photo' => 'https://via.placeholder.com/150',
            ],
        ];

        foreach ($vendors as $vendorData) {
            Applicant::updateOrCreate(
                ['email' => $vendorData['email']],
                $vendorData
            );
        }

        // Create System Requirements
        $requirements = [
            [
                'name' => 'Company Registration Certificate',
                'type' => 'FileUpload',
                'user_id' => 1,
            ],
            [
                'name' => 'Tax Clearance Certificate',
                'type' => 'FileUpload',
                'user_id' => 1,
            ],
            [
                'name' => 'Years of Experience',
                'type' => 'NumericInput',
                'user_id' => 1,
            ],
            [
                'name' => 'Financial Capacity (NGN)',
                'type' => 'NumericInput',
                'user_id' => 1,
            ],
            [
                'name' => 'Has Relevant Certification',
                'type' => 'Yes/No',
                'user_id' => 1,
            ],
            [
                'name' => 'Previous Government Contracts',
                'type' => 'Yes/No',
                'user_id' => 1,
            ],
        ];

        foreach ($requirements as $reqData) {
            SysRequirement::create($reqData);
        }

        $this->command->info('E-Procurement system seeded successfully!');
        $this->command->info('Admin Login: admin@kanoprocurement.gov.ng / password');
        $this->command->info('MDA Officer Login: fatima.ibrahim@kanohealth.gov.ng / password');
        $this->command->info('Auditor Login: auditor@kanoprocurement.gov.ng / password');
    }
}
