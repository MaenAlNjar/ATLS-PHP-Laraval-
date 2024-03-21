<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Classes;
use App\Models\StudyMaterial;
class ScheduleController extends Controller
{
    public function generateSchedules($classStage)
    {
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

        // Get all subjects based on the class stage
        $subjects = StudyMaterial::where('class_stage', $classStage)->get();

        // Get all classes based on the class stage
        $classes = Classes::where('class_stage', $classStage)->get();

        // Loop through each class
        foreach ($classes as $class) {
            // Check if a schedule exists for this class_id
            $existingSchedule = Schedule::where('class_id', $class->id)->first();

            // Initialize an empty schedule
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

            // Convert the schedule to JSON
            $classScheduleJson = json_encode($classSchedule);

            // If an existing schedule exists, update it; otherwise, create a new one
            if ($existingSchedule) {
                $existingSchedule->update([
                    'day' => $classScheduleJson,
                ]);
            } else {
                Schedule::create([
                    'class_id' => $class->id,
                    'day' => $classScheduleJson,
                ]);
            }
        }

        return back()->with('success', 'Schedules generated successfully!');
    }
}