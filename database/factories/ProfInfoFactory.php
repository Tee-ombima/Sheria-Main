<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Ensure you import the User model
use App\Models\ProfInfo;
use App\Models\Prof_area_of_specialisation ;
use App\Models\Prof_award;
use App\Models\Prof_grade;
use App\Models\Course;

use App\Models\Prof_area_of_study_high_school_level;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfInfo>
 */
class ProfInfoFactory extends Factory
{
    
    protected $model = ProfInfo::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'prof_institution_name' => $this->faker->company,
            'prof_student_admission_no' => $this->faker->randomNumber(8),
            'prof_area_of_study_high_school_level' => Prof_area_of_study_high_school_level::inRandomOrder()->first()->name,
            'prof_area_of_specialisation' => Prof_area_of_specialisation ::inRandomOrder()->first()->name,
            'prof_award' => Prof_award::inRandomOrder()->first()->name,
            'prof_course' => Course::inRandomOrder()->first()->name,
            'prof_grade' => Prof_grade::inRandomOrder()->first()->name,
            'prof_certificate_no' => $this->faker->randomNumber(8),
            'prof_start_date' => $this->faker->date(),
            'prof_end_date' => $this->faker->date(),
        ];
    }
}
