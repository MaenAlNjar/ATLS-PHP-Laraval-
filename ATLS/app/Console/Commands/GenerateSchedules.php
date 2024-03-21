<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;
use App\Models\Classes;
use App\Models\StudyMaterial; 

class GenerateSchedules extends Command
{
    protected $signature = 'schedules:generate';

    protected $description = 'Generate non-conflicting schedules for classes';

    public function handle()
    {
        // Clear existing schedules
        Schedule::truncate();

        // Define lesson time slots
        $lessonTimeSlots = [
            8,  
            9,  
            10, 
            11, 
            12, 
            13, 
            14, 
            15, 
        ];

        // Get all subjects
        $subjects = StudyMaterial::where('class_stage','Primary education')->get();

        // Get all classes
        $classes = Classes::where('class_stage','Primary_education')->get();

        // Generate schedules for each class
        foreach ($classes as $class) {
            $classSchedule = [];

            // Generate schedules for each day
            for ($day = 0; $day < 5; $day++) { 
                $schedule = [];

                // Shuffle the subjects to assign randomly
                $shuffledSubjects = $subjects->shuffle();

                // Assign lessons to time slots
                foreach ($lessonTimeSlots as $timeSlot) {
                    // Get the first subject from the shuffled list
                    $lessonSubject = $shuffledSubjects->pop();

                    // If there are no more subjects, shuffle the list again
                    if (!$lessonSubject) {
                        $shuffledSubjects = $subjects->shuffle();
                        $lessonSubject = $shuffledSubjects->pop();
                    }

                    // Create the lesson
                    $lesson = [
                        'time' => $timeSlot,
                        'subject' => $lessonSubject->subject_name,
                    ];

                    $schedule[] = $lesson;
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
