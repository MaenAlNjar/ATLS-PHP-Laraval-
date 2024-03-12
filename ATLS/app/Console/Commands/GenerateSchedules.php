<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;
use App\Models\Classes; // Update with your actual Classes model
use App\Models\StudyMaterial; // Update with your actual StudyMaterial model

class GenerateSchedules extends Command
{
    protected $signature = 'schedules:generate';

    protected $description = 'Generate non-conflicting schedules for classes';

    public function handle()
    {
        // Clear existing schedules
        Schedule::truncate();

        // Number of lessons per day
        $lessonsPerDay = [6, 6, 6, 6, 6, 5]; // 5 working days

        // Get all subjects
        $subjects = StudyMaterial::all();

        // Get all classes
        $classes = Classes::all();

        // Generate schedules for each class
        foreach ($classes as $class) {
            $classSchedule = [];

            // Generate schedules for each day
            for ($day = 0; $day < count($lessonsPerDay); $day++) {
                $schedule = [];

                // Generate lessons for each subject
                foreach ($subjects as $subject) {
                    // Generate lessons for this subject for the current day
                    for ($i = 0; $i < $lessonsPerDay[$day]; $i++) {
                        $time = rand(8, 16); // Random hour between 8 AM and 4 PM
                        $lesson = [
                            'time' => $time,
                            'subject' => $subject->name, // Assign the subject name
                        ];
                        $schedule[] = $lesson;
                    }
                }

                // Add the schedule for this day to the class schedule
                $classSchedule[] = $schedule;
            }

            // Save the schedule for the class
            Schedule::create([
                'class_id' => $class->id,
                'day' => json_encode($classSchedule),
            ]);
        }

        $this->info('Schedules generated successfully for all classes.');
    }
}
