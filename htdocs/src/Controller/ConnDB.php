<?php

namespace Alura\Cursos\Controller;

use Exception;

class ConnDB {

    private $username;
    private $passwd;
    private $host;
    private $port;
    private $sid;

    public $conn;

    public function __construct() {
        $this->username = getenv('USERNAME');
        $this->passwd = getenv('PASSWD');
        $this->host = getenv('HOST');
        $this->port = getenv('PORT');
        $this->sid = getenv('SID');

        $string = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)";
        $string .= "(HOST = $this->host)(PORT = $this->port))) (CONNECT_DATA = (SID = $this->sid)))";

        $this->conn = oci_connect($this->username, $this->passwd, $string);
    }

    /**
     * Retorna a primeira linha encontrada no select
     */
    public function fetch_one (string $_sql)
    {
        try{
            $sql = oci_parse($this->conn, $_sql);
            oci_execute($sql);
            $result = oci_fetch_row($sql);
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            oci_free_statement($sql);
            oci_close($this->conn);
        }
        
        return $result;
    }

    /**
     * Retorna array com o resultado do select
     */
    public function fetch_all (string $_sql)
    {
        try{
            $sql = oci_parse($this->conn, $_sql);
            oci_execute($sql);
            oci_fetch_all($sql,$result,0,-1,OCI_FETCHSTATEMENT_BY_ROW);
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            oci_free_statement($sql);
            oci_close($this->conn);
        }
        
        return $result;
    }

}