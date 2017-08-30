<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Exceptions\WrestlerAlreadySuspendedException;
use App\Exceptions\WrestlerNotSuspendedException;

trait HasSuspensions {

	abstract public function suspensions();

    public function hasPreviousSuspensions()
    {
        return $this->previousSuspensions->isNotEmpty();
    }

    public function previousSuspensions()
    {
        return $this->suspensions()->whereNotNull('ended_at');
    }

    public function isSuspended()
    {
        return $this->suspensions()->whereNull('ended_at')->count() > 0;
    }

	public function suspend($date = null)
    {
        if ($this->isSuspended())
        {
            throw new WrestlerAlreadySuspendedException;
        }

        $this->setStatusToInactive();

        $this->suspensions()->create(['suspended_at' => $date ?: Carbon::now()]);

        return $this;
    }

    public function renew($date = null)
    {
        if (! $this->isSuspended())
        {
            throw new WrestlerNotSuspendedException;
        }

        $this->setStatusToActive();

        $this->suspensions()->whereNull('ended_at')->first()->renew($date ?: Carbon::now());
    }
}