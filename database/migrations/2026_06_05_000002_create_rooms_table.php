<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(){ Schema::create('rooms',function(Blueprint $t){$t->id();$t->string('code')->unique();$t->string('type');$t->integer('price');$t->integer('capacity');$t->integer('stock')->default(0);$t->string('facilities')->nullable();$t->text('description')->nullable();$t->enum('status',['available','unavailable'])->default('available');$t->timestamps();}); } public function down(){ Schema::dropIfExists('rooms'); } };
