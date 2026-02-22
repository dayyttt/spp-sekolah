<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanPembayaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $bulan;
    protected $tahun;
    protected $rowNumber = 0;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return Pembayaran::with(['siswa.kelas', 'petugas'])
            ->whereMonth('tanggal_bayar', $this->bulan)
            ->whereYear('tanggal_bayar', $this->tahun)
            ->orderBy('tanggal_bayar', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Bayar',
            'NIS',
            'Nama Siswa',
            'Kelas',
            'Bulan',
            'Tahun',
            'Jumlah Bayar',
            'Petugas',
        ];
    }

    public function map($pembayaran): array
    {
        $this->rowNumber++;
        
        return [
            $this->rowNumber,
            date('d/m/Y', strtotime($pembayaran->tanggal_bayar)),
            $pembayaran->siswa->nis,
            $pembayaran->siswa->nama,
            $pembayaran->siswa->kelas->nama_kelas,
            $pembayaran->bulan,
            $pembayaran->tahun,
            $pembayaran->jumlah_bayar,
            $pembayaran->petugas->name,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E2E8F0']]],
        ];
    }

    public function title(): string
    {
        $namaBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        
        return 'Laporan ' . $namaBulan[$this->bulan] . ' ' . $this->tahun;
    }
}
