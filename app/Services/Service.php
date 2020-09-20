<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface Service
{
    public function list() : AnonymousResourceCollection;

    public function make(array $data) : bool;

    public function update(array $data, string $uuid) : bool;

    public function delete(string $uuid) : bool;
}
