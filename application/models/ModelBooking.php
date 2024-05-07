<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelBooking extends CI_Model
{
    public function getData($table)
    {
        return $this->db->get($table)->row();
    }

    public function getDataWhere($table, $where)
    {
        $this->db->where($where);
        return $this->db->get($table);
    }

    public function getOrderByLimit($table, $order, $limit)
    {
        $this->db->order_by($order, 'desc');
        $this->db->limit($limit);
        return $this->db->get($table);
    }

    public function joinOrder($where)
    {
        $this->db->select('*');
        $this->db->from('booking bo');
        $this->db->join('booking_detail d', 'd.id = bo.id');
        $this->db->join('buku bu', 'bu.id = d.id_buku');
        $this->db->where($where);

        return $this->db->get();
    }

    public function simpanDetail($where = null, $data = [])
    {
        $sql = "INSERT INTO booking_detail (id_booking, id_buku) SELECT booking.id,temp.id_buku FROM booking, temp WHERE temp.id_user = booking.id_user AND booking.id_user = '{$where}' ";
        $this->db->query($sql);  
        $this->db->reset_query();
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);   
        $this->db->reset_query();
    }

    public function updateData($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    public function deleteData($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function find($where)
    {
        $this->db->limit(1);
        return $this->db->get('buku', $where);
    }

    public function kosongkanData($table)
    {
        return $this->db->truncate($table);
    }

    public function createTemp()
    {
        $this->db->query('CREATE TABLE IF NOT EXISTS temp(id varchar(12), tgl_booking DATETIME, email_user varchar(128), id_buku int)');
    }

    public function selectJoin()
    {
        $this->db->select('*');
        $this->db->from('booking');
        $this->db->join('booking_detail', 'booking_detail.id=booking.id');
        $this->db->join('buku', 'booking_detail.id_buku=buku.id');
        
        return $this->db->get();
    }

    public function showtemp($where)
    {
        return $this->db->get('temp', $where);
    }

    public function kodeOtomatis($tabel, $key)
    {
        $this->db->select('right(' . $key . ',3) as kode', false);
        $this->db->order_by($key, 'desc');
        $this->db->limit(1);
        $query = $this->db->get($tabel);

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = date('dmY') . $kodemax;
        return $kodejadi;
    }
}