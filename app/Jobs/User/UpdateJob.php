<?php

namespace App\Jobs\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\UploadableTrait;
use App\Eloquent\User;

class UpdateJob
{
    use Dispatchable, Queueable, UploadableTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $entity;

    protected $attributes;

    public function __construct(User $entity, array $attributes)
    {
        $this->entity = $entity;
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = strtolower(class_basename($this->entity));
        $data = array_only($this->attributes, $this->entity->getFillable());

        if (array_has($data, 'image')) {
            if (!empty($this->entity->image)) {
                $this->destroyFile($this->entity->image);
            }
            $data['image'] = $this->uploadFile($data['image'], $path);
        }

        if (!array_has($data, 'locked')) {
            $data['locked'] = false;
        }

        $this->entity->update($data);
        
        if (isset($this->attributes['role_ids'])) {
            $this->entity->roles()->sync($this->attributes['role_ids']);
        }
    }
}
