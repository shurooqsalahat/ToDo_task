<?php

class list_model extends CI_model
{
    /*
    add list or task to database.
    args : array of list info .
    */
    public function addList($list)
    {
        if ($this->db->insert('lists', $list)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    update list or task in database.
    args: array of new data
    */
    public function updateList($id, $list, $user_id)
    {
        $this->db->where('event_id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->update('lists', $list);
    }

    /*
    get all list for specific user
    args: User id

    */
    public function getList($user_id)
    {
        $this->db->select('*');
        $this->db->from('lists');
        $this->db->where('user_id', $user_id);
        if ($query = $this->db->get()) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /*
    return if this list is completed or not .
    args: event Id you want to check

    */
    public function getStatus($id)
    {
        $this->db->select('is_completed');
        $this->db->from('lists');
        $this->db->where('event_id', $id);
        if ($query = $this->db->get()) {
            return $query->result_array();
        } else {
            return false;
        }
    }


    /*
    delete list from database .
    args : event id.
    */
    public function deleteList($id, $user_id)
    {
        $this->db->where('event_id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('lists');
    }
}
