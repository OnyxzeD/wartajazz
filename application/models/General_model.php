<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class General_model extends CI_Model
{

    public function getNoUrut($table, $key, $prefix, $where = null, $value = null)
    {
        $this->db->select($key);
        if (!is_null($where)) {
            $this->db->where($where, $value);
        }
        $this->db->order_by($key, 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($table);
        $result = $query->row_array();
        $urut = (int)filter_var($result[$key], FILTER_SANITIZE_NUMBER_INT) + 1;

        if ($urut < 10) {
            return $prefix . "000" . $urut;
        } else if ($urut >= 10 && $urut < 100) {
            return $prefix . "00" . $urut;
        } else if ($urut >= 100 && $urut < 1000) {
            return $prefix . "0" . $urut;
        } else {
            return $prefix . "" . $urut;
        }
    }

    function randomPassword($length = 6)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    function activationCode()
    {
        return md5(rand(0, 100000));
    }
}
