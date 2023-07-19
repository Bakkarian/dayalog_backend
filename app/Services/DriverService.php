<?php

namespace App\Services;

use App\Models\Driver;

class DriverService
{
    public function store(array $data): Driver
    {
        $driver = Driver::create($data);
        return $driver;
    }

    public function update(array $data, Driver $driver): Driver
    {
        $driver->update($data);
        return $driver;
    }

}
