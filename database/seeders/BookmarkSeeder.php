<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get user
        $testUser = User::where('email', 'test@email.com')->firstOrFail();

        // Get all jobs ids
        $jobIds = Job::pluck('id')->toArray();

        // Randomlly select jobs to be bookmarked
        $randomJobIds = array_rand($jobIds, 3);

        // Attach the selected jobs as bookmarks
        foreach( $randomJobIds as $jobId) {
            $testUser->bookmarkedJobs()->attach($jobIds[$jobId]);
        }
    }
}
