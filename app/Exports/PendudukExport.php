<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendudukExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = Penduduk::query();

        if (!empty($this->request['rt'])) {
            $query->where('rt', $this->request['rt']);
        }
        if (!empty($this->request['rw'])) {
            $query->where('rw', $this->request['rw']);
        }
        if (!empty($this->request['search'])) {
            $query->where(function($q) {
                $q->where('nama', 'like', '%' . $this->request['search'] . '%')
                  ->orWhere('nik', 'like', '%' . $this->request['search'] . '%');
            });
        }

        return $query;
    }

    public function map($penduduk): array
    {
        return [
            $penduduk->no_kk,
            $penduduk->nik,
            $penduduk->nama,
            $penduduk->jenis_kelamin == '1' ? 'Laki-Laki' : 'Perempuan',
            $penduduk->tempat_lahir,
            $penduduk->tanggal_lahir,
            $penduduk->pekerjaan,
            $penduduk->agama,
            $penduduk->pendidikan,
            $penduduk->status_pernikahan,
            $penduduk->shdk,
            $penduduk->alamat,
            $penduduk->rt,
            $penduduk->rw,
            $penduduk->dusun,
        ];
    }

    public function headings(): array
    {
        return [
            'No KK',
            'NIK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Pekerjaan',
            'Agama',
            'Pendidikan',
            'Status Pernikahan',
            'SHDK',
            'Alamat',
            'RT',
            'RW',
            'Dusun'
        ];
    }
}
