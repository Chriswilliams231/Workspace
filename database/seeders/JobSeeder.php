<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use function Symfony\Component\Clock\now;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Loading some job listings from a file
        $jobListings = include database_path('seeders/data/job_listings.php');


        // Getting the test user ID
        $testUserID = User::where('email', 'test@email.com')->value('id');
        // Get all othe user IDs != to test ID from the User Model
        $userIds = User::where('email', '!=', 'test@email.com')->pluck('id')->toArray();
        

        foreach ($jobListings as $index => &$listing) {

            if($index < 2){
                // This will assign the first to listings to the test user
                $listing['user_id'] = $testUserID;
            }else{
                // Assign user id to listing
                $listing['user_id'] = $userIds[array_rand($userIds)];
            }
            

            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert Job Listings
        DB::table('job_listings')->insert($jobListings);
         echo 'Jobs created successfully!';
    }
}
