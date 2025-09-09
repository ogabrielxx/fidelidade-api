<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('enviar:emailDiarioSaldo')->daily();
