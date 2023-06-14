<?php
class connect
{
    //thuột tính
    var $db = null;
    // Hàm tạo PDO(dsn,user,pass,array(...))
    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=furniture';
        $user = 'root';
        $pass = '';
        try {
            $this->db = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8;"));
        } catch (\Throwable $th) {
            echo $th;
            echo "Không thành công";
        }
    }

    public function getList($select)
    {
        $result = $this->db->query($select);
        return $result;
    }

    public function getInstance($select)
    {
        $result = $this->db->query($select);
        $result = $result->fetch();
        return $result;
    }

    public function exec($query)
    {
        $result = $this->db->exec($query);
        return ($result);
    }

    public function prepare($query)
    {
        return $this->db->prepare($query);
    }

    public function getRevenueByMonth()
    {
        $query = "SELECT MONTH(ngay) AS thang, SUM(tongtien) AS doanhthu
                  FROM hoa_don
                  WHERE YEAR(ngay) = '2023'
                  GROUP BY MONTH(ngay)";

        $result = $this->getList($query);
        $revenueData = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $revenueData[] = $row;
        }

        return $revenueData;
    }
}
