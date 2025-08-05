<?php

namespace Database\Seeders;

use App\Models\ContactLocation;
use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Contact Locations
        $locations = [
            [
                'name' => 'Boston',
                'slug' => 'boston',
                'address' => '54 Berrick 2nd Street Boston, MA 02115, United States.',
                'phone' => '+800 45 6789 01 & 02',
                'email' => 'enquiry@example.com',
                'map_iframe_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sin!4v1645000000000!5m2!1sen!2sin',
                'weekday_hours' => '07.00 am to 10.00pm',
                'weekend_hours' => '08.00 am to 08.00pm',
                'sort_order' => 1,
                'is_active' => true,
                'is_default' => true,
            ],
            [
                'name' => 'California',
                'slug' => 'california',
                'address' => '123 Silicon Valley Drive, California, CA 90210, United States.',
                'phone' => '+800 45 6789 03 & 04',
                'email' => 'california@example.com',
                'map_iframe_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sin!4v1645000000000!5m2!1sen!2sin',
                'weekday_hours' => '08.00 am to 09.00pm',
                'weekend_hours' => '09.00 am to 07.00pm',
                'sort_order' => 2,
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Portland',
                'slug' => 'portland',
                'address' => '456 Oregon Street, Portland, OR 97201, United States.',
                'phone' => '+800 45 6789 05 & 06',
                'email' => 'portland@example.com',
                'map_iframe_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sin!4v1645000000000!5m2!1sen!2sin',
                'weekday_hours' => '07.30 am to 09.30pm',
                'weekend_hours' => '08.30 am to 07.30pm',
                'sort_order' => 3,
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'New Orleans',
                'slug' => 'new-orleans',
                'address' => '789 French Quarter Blvd, New Orleans, LA 70112, United States.',
                'phone' => '+800 45 6789 07 & 08',
                'email' => 'neworleans@example.com',
                'map_iframe_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sin!4v1645000000000!5m2!1sen!2sin',
                'weekday_hours' => '08.00 am to 08.00pm',
                'weekend_hours' => '09.00 am to 06.00pm',
                'sort_order' => 4,
                'is_active' => true,
                'is_default' => false,
            ],
        ];

        foreach ($locations as $location) {
            ContactLocation::create($location);
        }

        // Create Contact Information
        $contactInfos = [
            [
                'key' => 'support_phone',
                'label' => 'Support Phone',
                'value' => '(+61) 324 56 789',
                'type' => 'phone',
                'icon' => 'flaticon-headphones',
                'section' => 'header',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'headquarters_address',
                'label' => 'Headquarters Address',
                'value' => '54 Berrick 2nd Street Boston, MA 02115, United States.',
                'type' => 'address',
                'icon' => 'flaticon-pin',
                'section' => 'contact',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'supplier_email',
                'label' => 'Supplier Email',
                'value' => 'buss@example.com',
                'type' => 'email',
                'icon' => 'flaticon-mail',
                'section' => 'contact',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'customer_email',
                'label' => 'Customer Email',
                'value' => 'support@example.com',
                'type' => 'email',
                'icon' => 'flaticon-mail',
                'section' => 'contact',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'office_hours_weekday',
                'label' => 'Office Hours (Mon-Sat)',
                'value' => '08.00 am to 08.45 pm',
                'type' => 'text',
                'icon' => 'flaticon-clock',
                'section' => 'contact',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'office_hours_sunday',
                'label' => 'Office Hours (Sunday)',
                'value' => 'Closed',
                'type' => 'text',
                'icon' => 'flaticon-clock',
                'section' => 'contact',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'key' => 'contact_form_title',
                'label' => 'Contact Form Title',
                'value' => 'Feel Free to Say Hello or Send Your Questions',
                'type' => 'text',
                'icon' => null,
                'section' => 'contact',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'key' => 'contact_form_subtitle',
                'label' => 'Contact Form Subtitle',
                'value' => 'Complete the enquiry form & we will be in touch as soon as possible.',
                'type' => 'textarea',
                'icon' => null,
                'section' => 'contact',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($contactInfos as $info) {
            ContactInfo::create($info);
        }
    }
}
