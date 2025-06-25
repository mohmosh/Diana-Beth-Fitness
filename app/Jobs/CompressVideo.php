<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Video;

class CompressVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        lOG::info("In Job constuctor...");

        $this->data = $data;

        Log::info('Data passed to job:', $this->data);
        // $originalPath = storage_path('app/public/' . $this->data['video']);
        // Log::info("Original path is: " . $originalPath);
    }

    public function handle()
    {
        try {
            // lOG::info("Compressing video...");
            Log::info("Not compressing for now");
            // $originalPath = storage_path('app/public/' . $this->data['video']);
            $originalPath = $this->data['video'];
            Log::info("Original path is: " . $originalPath);
            // $compressedName = 'compressed_' . basename($originalPath);
            // $compressedPath = storage_path('app/public/videos/compressed/' . $compressedName);
            // Log::info("Compressed path is: " . $compressedPath);

            // Ensure directory exists
            // if (!file_exists(dirname($compressedPath))) {
            //     mkdir(dirname($compressedPath), 0775, true);
            // }

            // Compress video using ffmpeg
            // $command = "ffmpeg -i \"$originalPath\" -vcodec libx264 -crf 28 \"$compressedPath\" 2>&1";
            // $command = "nice -n 10 ffmpeg -i \"$originalPath\" -vcodec libx264 -crf 32 \"$compressedPath\" 2>&1";
            // $command = "ffmpeg -i \"$originalPath\" -vf scale=1280:-2 -b:v 800k -vcodec libx264 -crf 32 \"$compressedPath\" 2>&1";

            // Log::info("Running command: $command");

            // $output = shell_exec($command);

            // Log::info("FFmpeg Output: " . $output);

            // shell_exec("ffmpeg -i \"$originalPath\" -vcodec libx264 -crf 28 \"$compressedPath\"");
            $sub_type = $this->data["subscription_type"];

            Log::info("Saving to database..");
            Log::info("Subscription Type: $sub_type");

            // Delete the original
            // if (file_exists($originalPath)) {
            //     unlink($originalPath);
            //     Log::info("Deleted original video: " . $originalPath);
            // }

            // Save to database
            Video::create([
                'title' => $this->data['title'],
                'plan_id' => $this->data['plan_id'],
                'url' => $this->data['url'],
                'subscription_type' => $sub_type,
                'level' => $this->data['level'],
                'path' => $originalPath,
                'devotional_file' => $this->data['devotional_file'] ?? null,
            ]);

            // Log::info("Video compressed and saved: " . $compressedPath);
            Log::info("All done :-)");

        } catch (\Exception $e) {
            Log::error("Job failed: " . $e->getMessage());
        }
    }
}
