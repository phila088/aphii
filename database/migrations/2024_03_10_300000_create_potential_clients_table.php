<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('potential_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->boolean('converted')->default(false);
            $table->foreignId('payment_term_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->string('legal_name', 50)->nullable();
            $table->string('dba', 50)->nullable();
            $table->date('date_of_interview')->nullable();
            $table->string('interview_method')->nullable();
            $table->string('contact_1_first_name', 25)->nullable();
            $table->string('contact_1_last_name', 25)->nullable();
            $table->string('contact_1_phone_number_work', 15)->nullable();
            $table->string('contact_1_phone_number_work_extension', 10)->nullable();
            $table->string('contact_1_phone_number_mobile', 15)->nullable();
            $table->string('contact_1_email', 100)->nullable();
            $table->string('contact_2_first_name', 25)->nullable();
            $table->string('contact_2_last_name', 25)->nullable();
            $table->string('contact_2_phone_number_work', 15)->nullable();
            $table->string('contact_2_phone_number_work_extension', 10)->nullable();
            $table->string('contact_2_phone_number_mobile', 15)->nullable();
            $table->string('contact_2_email', 100)->nullable();
            $table->string('contact_3_first_name', 25)->nullable();
            $table->string('contact_3_last_name', 25)->nullable();
            $table->string('contact_3_phone_number_work', 15)->nullable();
            $table->string('contact_3_phone_number_work_extension', 10)->nullable();
            $table->string('contact_3_phone_number_mobile', 15)->nullable();
            $table->string('contact_3_email', 100)->nullable();
            $table->string('contact_4_first_name', 25)->nullable();
            $table->string('contact_4_last_name', 25)->nullable();
            $table->string('contact_4_phone_number_work', 15)->nullable();
            $table->string('contact_4_phone_number_work_extension', 10)->nullable();
            $table->string('contact_4_phone_number_mobile', 15)->nullable();
            $table->string('contact_4_email', 100)->nullable();
            $table->string('contact_5_first_name', 25)->nullable();
            $table->string('contact_5_last_name', 25)->nullable();
            $table->string('contact_5_phone_number_work', 15)->nullable();
            $table->string('contact_5_phone_number_work_extension', 10)->nullable();
            $table->string('contact_5_phone_number_mobile', 15)->nullable();
            $table->string('contact_5_email', 100)->nullable();
            $table->text('general_notes')->nullable();
            $table->string('client_list', 500)->nullable();
            $table->string('location_types', 500)->nullable();
            $table->string('required_trades', 500)->nullable();
            $table->string('primary_location_locales', 500)->nullable();
            $table->string('average_do_not_exceed', 150)->nullable();
            $table->string('onsite_protocol', 500)->nullable();
            $table->boolean('complete')->default(false);
            $table->boolean('converted_to_client')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potential_clients');
    }
};
