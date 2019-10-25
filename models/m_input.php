<?php 
class input{
    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    public function tampilkan($id = null)
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM sales";
        if ($id != null) {
            $sql .= " WHERE id = $id";
        }
        $query = $db->query($sql) or die($db->error); 
        return $query;
    }

    public function tampil_dt()
    {
        
        $db = $this->mysqli->conn;
        /*$sql1 = '
            SELECT * , 
            UNIX_TIMESTAMP(CONCAT_WS(" ", dt_tgl, dt_jm)) AS datetime 
            FROM tb_contoh 
            ORDER BY dt_tgl DESC, dt_jm DESC
            ';
            */
        
        // $sql2 = "SELECT * FROM tb_contoh WHERE dt_tgl BETWEEN '$tgla' AND '$tglb'";
        $year = date('Y');
        $sql3 = "SELECT * FROM sales where year = '$year' group by month ASC";
        $query = $db->query($sql3) or die($db->error); 
        return $query;
    }

    public function tampil_grafik($thn)
    {
        $db = $this->mysqli->conn;
        $year = date('Y');
        $sql = "SELECT * FROM sales where year = '$thn' group by month ASC";
        $query = $db->query($sql) or die($db->error); 
        return $query;
    }

    public function tabel_ds($taun)
    {
        $db = $this->mysqli->conn;
        $year = date('Y');
        $sql = "SELECT * FROM sales where year = '$taun' group by month ASC";
        $query = $db->query($sql) or die($db->error); 
        return $query;
    }

    public function bulan($bulan){
        switch($bulan){
            case 1 : $bulan="Januari";
                    Break;
                case 2 : $bulan="Februari";
                    Break;
                case 3 : $bulan="Maret";
                    Break;
                case 4 : $bulan="April";
                    Break;
                case 5 : $bulan="Mei";
                    Break;
                case 6 : $bulan="Juni";
                    Break;
                case 7 : $bulan="Juli";
                    Break;
                case 8 : $bulan="Agustus";
                    Break;
                case 9 : $bulan="September";
                    Break;
                case 10 : $bulan="Oktober";
                    Break;
                case 11 : $bulan="November";
                    Break;
                case 12 : $bulan="Desember";
                    Break;
            }
        return $bulan;
    }

    public function tambah_dt($motp, $sms, $smsotp, $year, $month)
    {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO sales VALUES ('','$motp','$sms','$smsotp','$year','$month')") or die($db->error);
        //$db->query("INSERT INTO tb_contoh VALUES ('','$sms','$motp','$dt_tgl', now())") or die($db->error);
    } 

    

    public function edit_dt($sql)
    {
        $db = $this->mysqli->conn;
        $db->query($sql) or die($db->error);
    }

    public function delete($id)
    {
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM sales WHERE id = '$id'") or die ($db->error);
    }

    function __destruct()
    {
        $db = $this->mysqli->conn;
        $db->close();
    }
}
?>