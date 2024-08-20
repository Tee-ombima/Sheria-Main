<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Ensure you import the User model
use App\Models\AcademicInfo;
use App\Models\Award;
use App\Models\Grade;
use App\Models\Course;
use App\Models\Specialisation;
use App\Models\Highschool;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicInfo>
 */
class AcademicInfoFactory extends Factory
{
    protected $model = AcademicInfo::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'institution_name' => $this->faker->company,
            'student_admission_no' => $this->faker->randomNumber(8),
            'highschool' => Highschool::inRandomOrder()->first()->name,
            'specialisation' => Specialisation::inRandomOrder()->first()->name,
            'course' => Course::inRandomOrder()->first()->name,
            'award' => Award::inRandomOrder()->first()->name,
            'grade' => Grade::inRandomOrder()->first()->name,
            'certificate_no' => $this->faker->randomNumber(8),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'graduation_completion_date' => $this->faker->date(),
        ];
    }
}
