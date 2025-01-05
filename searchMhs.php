<?php
require "fungsi.php";

class StudentSearch {
    private $koneksi;
    private $jmlDataPerHal;

    public function __construct($koneksi, $jmlDataPerHal = 5) {
        $this->koneksi = $koneksi;
        $this->jmlDataPerHal = $jmlDataPerHal;
    }

    public function getResults($search, $page) {
        $sql = $this->buildQuery($search);
        $totalData = $this->getTotalRecords($sql);
        $pagination = $this->calculatePagination($totalData, $page);
        $results = $this->fetchPageData($sql, $pagination['start']);
        
        return [
            'table_data' => $this->formatTableData($results, $pagination['start']),
            'pagination' => $this->buildPaginationLinks($pagination)
        ];
    }

    private function buildQuery($search) {
        $searchCondition = !empty($search) ? "WHERE nim LIKE '%".mysqli_real_escape_string($this->koneksi, $search)."%' OR 
                                                nama LIKE '%".mysqli_real_escape_string($this->koneksi, $search)."%' OR 
                                                email LIKE '%".mysqli_real_escape_string($this->koneksi, $search)."%'" : '';
        return "SELECT * FROM mhs $searchCondition";
    }

    private function getTotalRecords($sql) {
        return mysqli_num_rows(mysqli_query($this->koneksi, $sql));
    }

    private function calculatePagination($totalRecords, $currentPage) {
        return [
            'total' => $totalRecords,
            'pages' => ceil($totalRecords / $this->jmlDataPerHal),
            'current' => $currentPage,
            'start' => ($this->jmlDataPerHal * $currentPage) - $this->jmlDataPerHal
        ];
    }

    private function fetchPageData($sql, $start) {
        return mysqli_query($this->koneksi, $sql . " LIMIT $start, {$this->jmlDataPerHal}");
    }

    private function formatTableData($results, $start) {
        $output = "";
        $no = $start + 1;

        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $output .= $this->generateTableRow($row, $no++);
            }
            $output .= str_repeat("<tr><td colspan='6'>&nbsp;</td></tr>", $this->jmlDataPerHal - mysqli_num_rows($results));
        } else {
            $output .= $this->generateEmptyMessage();
        }

        return $output;
    }

    private function generateTableRow($row, $no) {
        return "
            <tr>
                <td>{$no}</td>
                <td>{$row['nim']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['email']}</td>
                <td><img src='foto/{$row['foto']}' height='50'></td>
                <td>
                    <a class='btn btn-outline-primary btn-sm' href='editMhs.php?kode={$row['id']}'>Koreksi</a>
                    <a class='btn btn-outline-danger btn-sm' href='hpsMhs.php?kode={$row['id']}' onclick='return confirm(\"Yakin dihapus nih?\")'>Hapus</a>
                </td>
            </tr>";
    }

    private function generateEmptyMessage() {
        return "
            <tr>
                <td colspan='6'>
                    <div class='alert alert-info alert-dismissible fade show text-center'>Data tidak ada</div>
                </td>
            </tr>" . str_repeat("<tr><td colspan='6'>&nbsp;</td></tr>", 4);
    }

    private function buildPaginationLinks($pagination) {
        $links = "<ul class='pagination'>";
        
        if ($pagination['current'] > 1) {
            $links .= "<li class='page-item'><a class='page-link' href='javascript:void(0)' onclick='searchData(".($pagination['current'] - 1).")'>&laquo;</a></li>";
        }

        for ($i = 1; $i <= $pagination['pages']; $i++) {
            $links .= "<li class='page-item'><a class='page-link' href='javascript:void(0)' onclick='searchData($i)' style='".($i == $pagination['current'] ? "font-weight:bold;color:red ;" : "")."'>$i</a></li>";
        }

        if ($pagination['current'] < $pagination['pages']) {
            $links .= "<li class='page-item'><a class='page-link' href='javascript:void(0)' onclick='searchData(".($pagination['current'] + 1).")'>&raquo;</a></li>";
        }

        return $links . "</ul>";
    }
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $page = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;

    try {
        $studentSearch = new StudentSearch($koneksi);
        $result = $studentSearch->getResults($search, $page);
        echo json_encode($result);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Terjadi kesalahan saat memproses permintaan']);
    }
}
// Fungsi AJAX untuk hapus mahasiswa


?>