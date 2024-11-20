<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ImportStatsCommand extends Command
{
    protected $signature = 'app:import-stats {filename}';
    protected $description = 'Import stats from a CSV file';

    // public function handle()
    // {
    //     ini_set('memory_limit', '512M');  // Set memory limit to 512MB
    //     $filename = $this->argument('filename');

    //     if (!file_exists(storage_path($filename))) {
    //         $this->error("File not found: $filename");
    //         return;
    //     }

    //     $data = array_map('str_getcsv', file(storage_path($filename)));

    //     // Skip the header row
    //     array_shift($data);

    //     foreach ($data as $row) {
    //         [$utm_campaign, $utm_term, $timestamp, $revenue] = $row;

    //         if (empty($utm_campaign) || empty($utm_term)) {
    //             continue; // Skip rows without required fields
    //         }

    //         $event_date = date('Y-m-d', strtotime($timestamp));
    //         $event_hour = date('H', strtotime($timestamp));

            
    //         // $campaign = DB::table('campaigns')->where('utm_campaign', $utm_campaign)->first();
    //         // if ($campaign) {
    //         //     $campaignId = $campaign->id;  // Get the auto-increment ID
    //         //     // echo "Campaign ID: " . $campaignId;
    //         // } else {
    //             $campaignId = DB::table('campaigns')->updateOrInsert(
    //                 ['utm_campaign' => $utm_campaign],
    //                 ['name' => fake()->words(4, true)]
    //             );
    //         // }

    //         $termId = DB::table('terms')->updateOrInsert(
    //             ['utm_term' => $utm_term],
    //             []
    //         );

    //         DB::table('stats')->insert([
    //             'campaign_id' => $campaignId,
    //             'term_id' => $termId,
    //             'revenue' => $revenue,
    //             'event_date' => $event_date,
    //             'event_hour' => $event_hour,
    //         ]);
    //     }

    //     $this->info('Data imported successfully.');
    // }
    public function handle()
    {
        // Get the file path from the argument
        $filename = $this->argument('filename');
        $filePath = storage_path($filename);
        
        // Check if file exists
        if (!file_exists($filePath)) {
            $this->error("File not found: $filePath");
            return;
        }

        // Open the CSV file for reading
        $file = fopen($filePath, 'r');
        
        // Read the header row
        $header = fgetcsv($file);

        // Define the column indexes based on the CSV header
        $utmCampaignIndex = array_search('utm_campaign', $header);
        $utmTermIndex = array_search('utm_term', $header);
        $timestampIndex = array_search('monetization_timestamp', $header);
        $revenueIndex = array_search('revenue', $header);

        if ($utmCampaignIndex === false || $utmTermIndex === false || $timestampIndex === false || $revenueIndex === false) {
            $this->error('CSV file must contain the following columns: utm_campaign, utm_term, monetization_timestamp, revenue.');
            return;
        }

        // Start importing the CSV rows
        $importCount = 0;
        while ($row = fgetcsv($file)) {
            // Get values from the current row
            $utmCampaign = $row[$utmCampaignIndex];
            $utmTerm = $row[$utmTermIndex];
            $monetizationTimestamp = Carbon::parse($row[$timestampIndex]);
            $revenue = (float) $row[$revenueIndex];

            if (empty($utmCampaign) || empty($utmTerm) || trim($utmCampaign) == 'NULL' || trim($utmTerm) == 'NULL') {
                continue; // Skip this row if either campaign or term is null or not found
            }

            // Retrieve campaign and term IDs
            $campaign = DB::table('campaigns')->where('utm_campaign', $utmCampaign)->first();
            $term = DB::table('terms')->where('utm_term', $utmTerm)->first();

            // If campaign doesn't exist, insert it and get the ID
            if (!$campaign) {
                $campaignId = DB::table('campaigns')->insertGetId([
                    'utm_campaign' => $utmCampaign,
                    'name' => fake()->words(4, true), // Set a random name
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $campaignId = $campaign->id; // Existing campaign ID
            }

            // If term doesn't exist, insert it and get the ID
            if (!$term) {
                $termId = DB::table('terms')->insertGetId([
                    'utm_term' => $utmTerm,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $termId = $term->id; // Existing term ID
            }

            // Prepare the data to insert into stats table
            $eventDate = $monetizationTimestamp->toDateString(); // Extract event date (YYYY-MM-DD)
            $eventHour = $monetizationTimestamp->hour; // Extract event hour (0-23)
            // Prepare the data to insert into the stats table
            $monetizationDate = $monetizationTimestamp->format('Y-m-d H:i:s'); // Format the full timestamp (YYYY-MM-DD HH:MM:SS)

            // Validate revenue (should not be negative or zero)
            // if ($revenue <= 0) {
            //     continue; // Skip rows with invalid revenue
            // }

            // Insert the data into the stats table
            DB::table('stats')->insert([
                'campaign_id' => $campaignId,
                'term_id' => $termId,
                'revenue' => $revenue,
                'event_date' => $eventDate,
                'event_hour' => $eventHour,
                'monetization_date' => $monetizationDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $importCount++;
        }

        fclose($file);

        // Output the result
        $this->info("$importCount rows have been successfully imported.");
    }
}
