<?php

namespace Database\Factories;

use App\Models\Enquiries;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

class EnquiriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Enquiries::class;
    
    public function definition()
    {
        $EnquiryType = [
            "Anandlab Bangalore",
            "Anandlab Neuberg Healthcare",
            "Black Fungus Enquiry",
            "CFC Campaign Enquiry",
            "Covid 19 Appointment Enquiry",
            "Covid19 Antibody Test",
            "Full Body Checkup",
            "Healthcare Package - Delhi",
            "Home Visits Popup Enquiry",
            "Service Enquiry",
        ];

        $EnquiryStatus = [
            "Booked",
            "Corporate",
            "Enquiry",
            "Not Interested",
            "To be followed",
            "Walk-in",
        ];

       
        return [
            "Name"              => $this->faker->name(),
            "Email"             => $this->faker->unique()->safeEmail(),
            "Mobile"            => $this->faker->phoneNumber(),
            "Address"           => $this->faker->address(),
            "EnquiryType"       => $EnquiryType[rand(1,9)],
            "EnquiryStatus"     => $EnquiryStatus[rand(1,5)],
            "created_at"        => Carbon::today()->subDays(rand(0, 365))
        ];
    }
} 
