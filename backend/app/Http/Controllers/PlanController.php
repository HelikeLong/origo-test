<?php
    namespace App\Http\Controllers;

    use App\Traits\RestActions;

    class PlanController extends Controller {
        private $_model = "App\\Models\\Plan";
        use RestActions;
    }
