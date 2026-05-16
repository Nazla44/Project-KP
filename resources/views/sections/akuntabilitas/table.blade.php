<section class="{{ $wrapperClass }} py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Laporan</span>
            <h2 class="section-title mt-3">{{ $titleStart }} <span class="section-title-accent">STPI</span></h2>
        </div>

        <div class="table-card shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle custom-table mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4 py-3">Nama Dokumen</th>
                            <th class="py-3">Tanggal Unggah</th>
                            <th class="text-end pe-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($page['items'] as $doc)
                            <tr>
                                <td class="ps-4 doc-title">{{ $doc['nama'] }}</td>
                                <td class="upload-date">{{ $doc['tanggal'] }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ $doc['link'] }}" class="btn btn-unduh">
                                        <i class="bi bi-download me-2"></i> Unduh
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('sections.common.pagination', ['page' => $page])
        </div>
    </div>
</section>
