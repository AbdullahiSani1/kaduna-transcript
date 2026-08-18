<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Program;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $programs = Program::all()->keyBy('program_code');

        $courses = [

            // ==================== COMPUTER SCIENCE ====================
            ['code' => 'COM114', 'title' => 'Digital Electronics', 'units' => 3, 'program' => 'COM', 'level' => 100, 'semester' => 'first'],
            ['code' => 'COM115', 'title' => 'Introduction to Computer Science', 'units' => 2, 'program' => 'COM', 'level' => 100, 'semester' => 'first'],
            ['code' => 'COM116', 'title' => 'Mathematics for Computing', 'units' => 3, 'program' => 'COM', 'level' => 100, 'semester' => 'first'],
            ['code' => 'COM121', 'title' => 'Introduction to Programming', 'units' => 3, 'program' => 'COM', 'level' => 100, 'semester' => 'second'],
            ['code' => 'COM122', 'title' => 'Computer Hardware Fundamentals', 'units' => 2, 'program' => 'COM', 'level' => 100, 'semester' => 'second'],
            ['code' => 'COM123', 'title' => 'Logic and Problem Solving', 'units' => 2, 'program' => 'COM', 'level' => 100, 'semester' => 'second'],
            ['code' => 'COM215', 'title' => 'System Analysis and Design', 'units' => 3, 'program' => 'COM', 'level' => 200, 'semester' => 'first'],
            ['code' => 'COM216', 'title' => 'Data Structures and Algorithms', 'units' => 3, 'program' => 'COM', 'level' => 200, 'semester' => 'first'],
            ['code' => 'COM217', 'title' => 'Object Oriented Programming', 'units' => 3, 'program' => 'COM', 'level' => 200, 'semester' => 'first'],
            ['code' => 'COM221', 'title' => 'Web Development', 'units' => 3, 'program' => 'COM', 'level' => 200, 'semester' => 'second'],
            ['code' => 'COM222', 'title' => 'Computer Networks', 'units' => 2, 'program' => 'COM', 'level' => 200, 'semester' => 'second'],
            ['code' => 'COM223', 'title' => 'Software Engineering Principles', 'units' => 3, 'program' => 'COM', 'level' => 200, 'semester' => 'second'],
            ['code' => 'COM312', 'title' => 'Operating Systems', 'units' => 3, 'program' => 'COM', 'level' => 300, 'semester' => 'first'],
            ['code' => 'COM313', 'title' => 'Artificial Intelligence', 'units' => 3, 'program' => 'COM', 'level' => 300, 'semester' => 'first'],
            ['code' => 'COM314', 'title' => 'Mobile Application Development', 'units' => 3, 'program' => 'COM', 'level' => 300, 'semester' => 'first'],
            ['code' => 'COM322', 'title' => 'Database Management Systems', 'units' => 2, 'program' => 'COM', 'level' => 300, 'semester' => 'second'],
            ['code' => 'COM323', 'title' => 'Cybersecurity Fundamentals', 'units' => 3, 'program' => 'COM', 'level' => 300, 'semester' => 'second'],
            ['code' => 'COM324', 'title' => 'Human Computer Interaction', 'units' => 2, 'program' => 'COM', 'level' => 300, 'semester' => 'second'],
            ['code' => 'COM411', 'title' => 'Computer Architecture', 'units' => 3, 'program' => 'COM', 'level' => 400, 'semester' => 'first'],
            ['code' => 'COM412', 'title' => 'Cloud Computing', 'units' => 3, 'program' => 'COM', 'level' => 400, 'semester' => 'first'],
            ['code' => 'COM413', 'title' => 'Research Methodology', 'units' => 2, 'program' => 'COM', 'level' => 400, 'semester' => 'first'],
            ['code' => 'COM424', 'title' => 'Networking II', 'units' => 2, 'program' => 'COM', 'level' => 400, 'semester' => 'second'],
            ['code' => 'COM425', 'title' => 'Final Year Project', 'units' => 6, 'program' => 'COM', 'level' => 400, 'semester' => 'second'],
            ['code' => 'COM426', 'title' => 'IT Project Management', 'units' => 2, 'program' => 'COM', 'level' => 400, 'semester' => 'second'],

            // ==================== FOOD SCIENCE AND TECHNOLOGY ====================
            ['code' => 'FST111', 'title' => 'Introduction to Food Science', 'units' => 3, 'program' => 'FST', 'level' => 100, 'semester' => 'first'],
            ['code' => 'FST112', 'title' => 'Food Chemistry', 'units' => 3, 'program' => 'FST', 'level' => 100, 'semester' => 'first'],
            ['code' => 'FST113', 'title' => 'General Biology', 'units' => 2, 'program' => 'FST', 'level' => 100, 'semester' => 'first'],
            ['code' => 'FST121', 'title' => 'Food Microbiology', 'units' => 3, 'program' => 'FST', 'level' => 100, 'semester' => 'second'],
            ['code' => 'FST122', 'title' => 'Nutrition and Dietetics', 'units' => 2, 'program' => 'FST', 'level' => 100, 'semester' => 'second'],
            ['code' => 'FST123', 'title' => 'Food Safety and Hygiene', 'units' => 2, 'program' => 'FST', 'level' => 100, 'semester' => 'second'],
            ['code' => 'FST211', 'title' => 'Food Processing Technology', 'units' => 3, 'program' => 'FST', 'level' => 200, 'semester' => 'first'],
            ['code' => 'FST212', 'title' => 'Post Harvest Technology', 'units' => 3, 'program' => 'FST', 'level' => 200, 'semester' => 'first'],
            ['code' => 'FST213', 'title' => 'Food Analysis Methods', 'units' => 2, 'program' => 'FST', 'level' => 200, 'semester' => 'first'],
            ['code' => 'FST221', 'title' => 'Cereal and Legume Technology', 'units' => 3, 'program' => 'FST', 'level' => 200, 'semester' => 'second'],
            ['code' => 'FST222', 'title' => 'Beverage Technology', 'units' => 2, 'program' => 'FST', 'level' => 200, 'semester' => 'second'],
            ['code' => 'FST223', 'title' => 'Food Packaging Technology', 'units' => 2, 'program' => 'FST', 'level' => 200, 'semester' => 'second'],
            ['code' => 'FST311', 'title' => 'Dairy Technology', 'units' => 3, 'program' => 'FST', 'level' => 300, 'semester' => 'first'],
            ['code' => 'FST312', 'title' => 'Meat and Fish Technology', 'units' => 3, 'program' => 'FST', 'level' => 300, 'semester' => 'first'],
            ['code' => 'FST313', 'title' => 'Food Quality Control', 'units' => 2, 'program' => 'FST', 'level' => 300, 'semester' => 'first'],
            ['code' => 'FST321', 'title' => 'Food Biotechnology', 'units' => 3, 'program' => 'FST', 'level' => 300, 'semester' => 'second'],
            ['code' => 'FST322', 'title' => 'Industrial Food Production', 'units' => 2, 'program' => 'FST', 'level' => 300, 'semester' => 'second'],
            ['code' => 'FST323', 'title' => 'Food Legislation and Standards', 'units' => 2, 'program' => 'FST', 'level' => 300, 'semester' => 'second'],
            ['code' => 'FST411', 'title' => 'Food Product Development', 'units' => 3, 'program' => 'FST', 'level' => 400, 'semester' => 'first'],
            ['code' => 'FST412', 'title' => 'Sensory Evaluation of Foods', 'units' => 2, 'program' => 'FST', 'level' => 400, 'semester' => 'first'],
            ['code' => 'FST413', 'title' => 'Research Methodology', 'units' => 2, 'program' => 'FST', 'level' => 400, 'semester' => 'first'],
            ['code' => 'FST421', 'title' => 'Food Entrepreneurship', 'units' => 2, 'program' => 'FST', 'level' => 400, 'semester' => 'second'],
            ['code' => 'FST422', 'title' => 'Final Year Project', 'units' => 6, 'program' => 'FST', 'level' => 400, 'semester' => 'second'],
            ['code' => 'FST423', 'title' => 'Food Plant Design', 'units' => 2, 'program' => 'FST', 'level' => 400, 'semester' => 'second'],

            // ==================== SCIENCE LABORATORY TECHNOLOGY ====================
            ['code' => 'SLT111', 'title' => 'Introduction to Laboratory Science', 'units' => 3, 'program' => 'SLT', 'level' => 100, 'semester' => 'first'],
            ['code' => 'SLT112', 'title' => 'General Chemistry', 'units' => 3, 'program' => 'SLT', 'level' => 100, 'semester' => 'first'],
            ['code' => 'SLT113', 'title' => 'General Physics', 'units' => 2, 'program' => 'SLT', 'level' => 100, 'semester' => 'first'],
            ['code' => 'SLT121', 'title' => 'Laboratory Safety and Practice', 'units' => 2, 'program' => 'SLT', 'level' => 100, 'semester' => 'second'],
            ['code' => 'SLT122', 'title' => 'Basic Microbiology', 'units' => 3, 'program' => 'SLT', 'level' => 100, 'semester' => 'second'],
            ['code' => 'SLT123', 'title' => 'Introduction to Biochemistry', 'units' => 2, 'program' => 'SLT', 'level' => 100, 'semester' => 'second'],
            ['code' => 'SLT211', 'title' => 'Analytical Chemistry', 'units' => 3, 'program' => 'SLT', 'level' => 200, 'semester' => 'first'],
            ['code' => 'SLT212', 'title' => 'Haematology', 'units' => 3, 'program' => 'SLT', 'level' => 200, 'semester' => 'first'],
            ['code' => 'SLT213', 'title' => 'Medical Microbiology', 'units' => 2, 'program' => 'SLT', 'level' => 200, 'semester' => 'first'],
            ['code' => 'SLT221', 'title' => 'Clinical Chemistry', 'units' => 3, 'program' => 'SLT', 'level' => 200, 'semester' => 'second'],
            ['code' => 'SLT222', 'title' => 'Parasitology', 'units' => 2, 'program' => 'SLT', 'level' => 200, 'semester' => 'second'],
            ['code' => 'SLT223', 'title' => 'Instrumentation and Measurement', 'units' => 2, 'program' => 'SLT', 'level' => 200, 'semester' => 'second'],
            ['code' => 'SLT311', 'title' => 'Immunology', 'units' => 3, 'program' => 'SLT', 'level' => 300, 'semester' => 'first'],
            ['code' => 'SLT312', 'title' => 'Histopathology', 'units' => 3, 'program' => 'SLT', 'level' => 300, 'semester' => 'first'],
            ['code' => 'SLT313', 'title' => 'Environmental Science', 'units' => 2, 'program' => 'SLT', 'level' => 300, 'semester' => 'first'],
            ['code' => 'SLT321', 'title' => 'Molecular Biology', 'units' => 3, 'program' => 'SLT', 'level' => 300, 'semester' => 'second'],
            ['code' => 'SLT322', 'title' => 'Toxicology', 'units' => 2, 'program' => 'SLT', 'level' => 300, 'semester' => 'second'],
            ['code' => 'SLT323', 'title' => 'Quality Assurance in Laboratory', 'units' => 2, 'program' => 'SLT', 'level' => 300, 'semester' => 'second'],
            ['code' => 'SLT411', 'title' => 'Advanced Clinical Microbiology', 'units' => 3, 'program' => 'SLT', 'level' => 400, 'semester' => 'first'],
            ['code' => 'SLT412', 'title' => 'Forensic Science', 'units' => 3, 'program' => 'SLT', 'level' => 400, 'semester' => 'first'],
            ['code' => 'SLT413', 'title' => 'Research Methodology', 'units' => 2, 'program' => 'SLT', 'level' => 400, 'semester' => 'first'],
            ['code' => 'SLT421', 'title' => 'Laboratory Management', 'units' => 2, 'program' => 'SLT', 'level' => 400, 'semester' => 'second'],
            ['code' => 'SLT422', 'title' => 'Final Year Project', 'units' => 6, 'program' => 'SLT', 'level' => 400, 'semester' => 'second'],
            ['code' => 'SLT423', 'title' => 'Epidemiology', 'units' => 2, 'program' => 'SLT', 'level' => 400, 'semester' => 'second'],

            // ==================== STATISTICS ====================
            ['code' => 'STA111', 'title' => 'Introduction to Statistics', 'units' => 3, 'program' => 'STA', 'level' => 100, 'semester' => 'first'],
            ['code' => 'STA112', 'title' => 'Mathematics I', 'units' => 3, 'program' => 'STA', 'level' => 100, 'semester' => 'first'],
            ['code' => 'STA113', 'title' => 'Introduction to Probability', 'units' => 2, 'program' => 'STA', 'level' => 100, 'semester' => 'first'],
            ['code' => 'STA121', 'title' => 'Descriptive Statistics', 'units' => 3, 'program' => 'STA', 'level' => 100, 'semester' => 'second'],
            ['code' => 'STA122', 'title' => 'Mathematics II', 'units' => 3, 'program' => 'STA', 'level' => 100, 'semester' => 'second'],
            ['code' => 'STA123', 'title' => 'Data Collection Methods', 'units' => 2, 'program' => 'STA', 'level' => 100, 'semester' => 'second'],
            ['code' => 'STA211', 'title' => 'Probability Distributions', 'units' => 3, 'program' => 'STA', 'level' => 200, 'semester' => 'first'],
            ['code' => 'STA212', 'title' => 'Statistical Inference', 'units' => 3, 'program' => 'STA', 'level' => 200, 'semester' => 'first'],
            ['code' => 'STA213', 'title' => 'Introduction to Computing', 'units' => 2, 'program' => 'STA', 'level' => 200, 'semester' => 'first'],
            ['code' => 'STA221', 'title' => 'Regression Analysis', 'units' => 3, 'program' => 'STA', 'level' => 200, 'semester' => 'second'],
            ['code' => 'STA222', 'title' => 'Sampling Theory', 'units' => 2, 'program' => 'STA', 'level' => 200, 'semester' => 'second'],
            ['code' => 'STA223', 'title' => 'Statistical Computing', 'units' => 2, 'program' => 'STA', 'level' => 200, 'semester' => 'second'],
            ['code' => 'STA311', 'title' => 'Design of Experiments', 'units' => 3, 'program' => 'STA', 'level' => 300, 'semester' => 'first'],
            ['code' => 'STA312', 'title' => 'Time Series Analysis', 'units' => 3, 'program' => 'STA', 'level' => 300, 'semester' => 'first'],
            ['code' => 'STA313', 'title' => 'Multivariate Analysis', 'units' => 2, 'program' => 'STA', 'level' => 300, 'semester' => 'first'],
            ['code' => 'STA321', 'title' => 'Operations Research', 'units' => 3, 'program' => 'STA', 'level' => 300, 'semester' => 'second'],
            ['code' => 'STA322', 'title' => 'Demography and Population Studies', 'units' => 2, 'program' => 'STA', 'level' => 300, 'semester' => 'second'],
            ['code' => 'STA323', 'title' => 'Biostatistics', 'units' => 2, 'program' => 'STA', 'level' => 300, 'semester' => 'second'],
            ['code' => 'STA411', 'title' => 'Econometrics', 'units' => 3, 'program' => 'STA', 'level' => 400, 'semester' => 'first'],
            ['code' => 'STA412', 'title' => 'Machine Learning for Statistics', 'units' => 3, 'program' => 'STA', 'level' => 400, 'semester' => 'first'],
            ['code' => 'STA413', 'title' => 'Research Methodology', 'units' => 2, 'program' => 'STA', 'level' => 400, 'semester' => 'first'],
            ['code' => 'STA421', 'title' => 'Statistical Quality Control', 'units' => 2, 'program' => 'STA', 'level' => 400, 'semester' => 'second'],
            ['code' => 'STA422', 'title' => 'Final Year Project', 'units' => 6, 'program' => 'STA', 'level' => 400, 'semester' => 'second'],
            ['code' => 'STA423', 'title' => 'Data Visualization', 'units' => 2, 'program' => 'STA', 'level' => 400, 'semester' => 'second'],
        ];

        foreach ($courses as $course) {
            $program = $programs->get($course['program']);
            if ($program) {
                Course::create([
                    'course_code' => $course['code'],
                    'course_title' => $course['title'],
                    'credit_unit' => $course['units'],
                    'program_id' => $program->id,
                    'level' => $course['level'],
                    'semester' => $course['semester'],
                ]);
            }
        }
    }
}