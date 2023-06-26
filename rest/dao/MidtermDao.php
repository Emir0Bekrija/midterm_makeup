<?php
require_once "BaseDao.php";

class MidtermDao extends BaseDao {

    public function __construct(){
        parent::__construct();
    }

    /** TODO
    * Implement DAO method used add new investor to investor table and cap-table
    */
    public function investor(){


    }

    /** TODO
    * Implement DAO method to validate email format and check if email exists
    */
    public function investor_email($email){
        $query= "SELECT * FROM investors WHERE email=:email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /** TODO
    * Implement DAO method to return list of investors according to instruction in MidtermRoutes.php
    */
    public function investors(){
        $query = "SELECT sh.description, sh.equity_main_currency, 
        sh.price,sh.authorized_assets, 
        inv.first_name, inv.last_name, inv.email, inv.company,
        sum(cap.diluted_shares)
        FROM share_classes sh
        JOIN cap_table cap on sh.id=cap.share_class_id
        jOIN investors inv on cap.investor_id=inv.id
        GROUP BY investor_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

}
?>
