<div style="max-width:400px;margin:auto;padding:20px;font-family:monospace;border:1px dashed #000;">

    <h3 style="text-align:center;">STRUK DENDA</h3>
    <hr>

    <p>Nama : {{ $p->user->name }}</p>
    <p>Buku : {{ $p->book->judul }}</p>
    <p>Tgl Pinjam : {{ $p->tgl_pinjam }}</p>
    <p>Jatuh Tempo : {{ $jatuhTempo->format('d-m-Y') }}</p>
    <p>Tgl Kembali : {{ $p->tgl_kembali }}</p>

    <hr>

    <p>Hari Telat: <b>{{ $hariTelat }}</b></p>

    <h3 style="text-align:center;">
        TOTAL DENDA: Rp {{ number_format($denda,0,',','.') }}
    </h3>

    <hr>

    <p style="text-align:center;">SUDAH DIBAYAR CASH</p>

    <script>
        window.print();
    </script>

</div>
