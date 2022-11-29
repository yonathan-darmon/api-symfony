<?php

namespace App\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

final class DatetimeImmutableProvider extends BaseProvider{

    public function DateTimeImmutable($dateTime){
     $date= \DateTimeImmutable::createFromMutable($dateTime);
     return $date;
    }

}

