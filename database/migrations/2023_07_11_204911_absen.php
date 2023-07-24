<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class Absen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('idsiswa');
            $table->integer('idkelas');
            $table->string('namasiswa');
            $table->string('email');
            $table->string('nis')->unique();
            $table->string('alamat');
            $table->date('tanggallahir');
            $table->enum('jk',['L','P']);
            $table->timestamps();
        });

        Schema::create('guru', function (Blueprint $table) {
            $table->bigIncrements('idguru');
            $table->integer('idmapel');
            $table->string('namaguru');
            $table->string('alamat');
            $table->string('email')->unique();
            $table->enum('jk',['L', 'P']);
            $table->date('tanggallahir');
            $table->timestamps();
        });

        Schema::create('mapel', function (Blueprint $table) {
            $table->bigIncrements('idmapel');
            $table->string('namamapel')->unique();
            $table->timestamps();
        });

        $mapel = [
            'Matematika',
            'Bahasa Indonesia',
            'Ipa',
            'Ips',
        ];
        foreach ($mapel as $item) {
            DB::table('mapel')->insert([
                'namamapel' => $item,
            ]);
        }

        Schema::create('posisi', function (Blueprint $table) {
            $table->bigIncrements('idposisi');
            $table->enum('posisi', ['ketua kelas', 'guru', 'admin'])->unique();
            $table->timestamps();
        });

        $posisi = [
            'ketua kelas',
            'guru',
            'admin',
        ];
        foreach ($posisi as $item) {
            DB::table('posisi')->insert([
                'posisi' => $item,
            ]);
        }


        Schema::create('kelas', function (Blueprint $table) {
            $table->bigIncrements('idkelas');
            $table->string('namakelas')->unique();
            $table->timestamps();
        });

        $kelas = [
            '7 A',
            '7 B',
            '8 A',
            '8 B',
            '9 A',
            '9 B',
        ];
        foreach ($kelas as $item) {
            DB::table('kelas')->insert([
                'namakelas' => $item,
            ]);
        }

        Schema::create('absen', function (Blueprint $table) {
            $table->bigIncrements('idabsen');
            $table->integer('nis');
            $table->enum('ket', ['Alfa', 'Hadir', 'Izin', 'Sakit']);
            $table->date('tanggalabsen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
