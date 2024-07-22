<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id(); // ID tự động tăng
            $table->string('name', 50); // cột name có độ dài 50 kí tự
            $table->dateTime('ngayphathanh'); // cột ngayphathanh kiểu dateTime
            $table->dateTime('ngayketthuc'); // cột ngayketthuc kiểu dateTime
            $table->string('diachi', 100); // cột diachi có độ dài 100 kí tự
            $table->decimal('giatien', 8, 2); // cột giatien kiểu decimal với tối đa 8 chữ số và 2 chữ số sau dấu phẩy
            $table->string('mota', 250); // cột mô tả có độ dài 250 kí tự
            $table->string('nguoitochuc')->nullable(); // cột người tổ chức có thể null
            $table->string('noitochuc')->nullable(); // cột nơi tổ chức có thể null
            $table->foreignId('cateID')->constrained('categories'); // cateID là khóa ngoại đến bảng categories
            $table->timestamps(); // tự động tạo cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ve');
    }
}
