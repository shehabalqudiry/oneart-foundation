<?php

namespace INTCore\OneARTFoundation;

use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class Operation
{
    use MarshalTrait;
    use DispatchesJobs;
    use JobDispatcherTrait;
}
