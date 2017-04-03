<?php

namespace App\Jobs\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\UploadableTrait;
use App\Eloquent\User;

class DeleteJob
{
    use Dispatchable, Queueable, UploadableTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $entity;

    public function __construct(User $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!empty($this->entity->image)) {
            $this->destroyFile($this->entity->image);
        }

        $this->entity->delete();
    }
}
