<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class PhoneService
{
    public function make(array $data, User $user) : bool
    {
        $skipMain = false;
        foreach ($data as $phone) {
            $user->phones()->create([
                'type' => $phone['type'],
                'number' => $phone['number'],
                'main' => !$skipMain ? $phone['main'] : false
            ]);

            if ($phone['main'] == 1) {
                $skipMain = true;
            }
        }

        return true;
    }

    public function update(array $data, User $user) : bool
    {
        $this->setAllMainPhoneToFalse($user);

        $skipMain = false;
        foreach ($data as $phone) {

            $user->phones()->find($phone['id'])->update([
                'type' => $phone['type'],
                'number' => $phone['number'],
                'main' => !$skipMain ? $phone['main'] : false
            ]);

            if ($phone['main'] == 1) {
                $skipMain = true;
            }
        }

        return true;
    }

    private function setAllMainPhoneToFalse(User $user) : void
    {
        $phones = $user->phones;

        foreach ($phones as $phone) {
            $phone->update([
                'main' => false
            ]);
        }
    }

}
