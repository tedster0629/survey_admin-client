<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_survey_dashboard extends CI_Model
{
    function render_dashboard_chart_data()
    {
        $query = $this->db->query("SELECT COUNT(merged.id) AS counted FROM (SELECT id FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? GROUP BY IP) AS merged", array(date('Y'), date('m')));
        $rows  = $query->row_array();
       
        if ($this->db->affected_rows() >= 1) {
            switch (date('m')) {
                case '01':
                    return '[[1262304000000, ' . $rows['counted'] . '], [1264982400000, 0], [1267401600000, 0], [1270080000000, 0], [1272672000000, 0], [1275350400000, 0], [1277942400000, 0], [1280620800000, 0], [1283299200000, 0], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
                    break;
                case '02':
                    $this->db->select('COUNT(id) AS counted');
                    $this->db->from('tbl_took_survey');
                    $this->db->where('YEAR(date)', date('Y'));
                    $this->db->where('MONTH(date)', '01');
                    $result_j = $this->db->get();
                    $j = $result_j->row_array()['counted'];
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $rows['counted'] . '], [1267401600000, 0], [1270080000000, 0], [1272672000000, 0], [1275350400000, 0], [1277942400000, 0], [1280620800000, 0], [1283299200000, 0], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
                    break;
                case '03':
                    $query_j = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '01'));
                    $j = $query_j->row_array()['counted'];
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $f . '], [1267401600000, ' . $rows['counted'] . '], [1270080000000, 0], [1272672000000, 0], [1275350400000, 0], [1277942400000, 0], [1280620800000, 0], [1283299200000, 0], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
                    break;
                case '4':
                    $query_j = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '01'));
                    $j = $query_j->row_array()['counted'];
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '03'));
                    $m = $query_m->row_array()['counted'];
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $f . '], [1267401600000, ' . $m . '], [1270080000000, ' . $rows['counted'] . '], [1272672000000, 0], [1275350400000, 0], [1277942400000, 0], [1280620800000, 0], [1283299200000, 0], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
                    break;
                case '05':
                    $this->db->select('COUNT(id) AS counted');
                    $this->db->where('YEAR(date)', date('Y'));
                    $this->db->where('MONTH(date)', '01');
                    $result_j = $this->db->get('tbl_took_survey')->row();
                    $j = $result_j->counted;
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '03'));
                    $m = $query_m->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '04'));
                    $a = $query_m->row_array()['counted'];
                    // Repeat the above steps for other queries
            
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $f . '], [1267401600000, ' . $m . '], [1270080000000, ' . $a . '], [1272672000000, ' . $rows['counted'] . '], [1275350400000, 0], [1277942400000, 0], [1280620800000, 0], [1283299200000, 0], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
                    break;
                case '06':
                    $this->db->select('COUNT(id) AS counted');
                    $this->db->where('YEAR(date)', date('Y'));
                    $this->db->where('MONTH(date)', '01');
                    $result_j = $this->db->get('tbl_took_survey')->row();
                    $j = $result_j->counted;
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '03'));
                    $m = $query_m->row_array()['counted'];
                    $query_a = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '04'));
                    $a = $query_a->row_array()['counted'];
                    $query_my = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '05'));
                    $my = $query_my->row_array()['counted'];
                    // Repeat the above steps for other queries
            
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $f . '], [1267401600000, ' . $m . '], [1270080000000, ' . $a . '], [1272672000000, ' . $my . '], [1275350400000, ' . $rows['counted'] . '], [1277942400000, 0], [1280620800000, 0], [1283299200000, 0], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
                    break;

                case '07':
                    $this->db->select('COUNT(id) AS counted');
                    $this->db->where('YEAR(date)', date('Y'));
                    $this->db->where('MONTH(date)', '01');
                    $result_j = $this->db->get('tbl_took_survey')->row();
                    $j = $result_j->counted;
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '03'));
                    $m = $query_m->row_array()['counted'];
                    $query_a = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '04'));
                    $a = $query_a->row_array()['counted'];
                    $query_my = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '05'));
                    $my = $query_my->row_array()['counted'];
                    $query_ju = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '06'));
                    $ju = $query_ju->row_array()['counted'];
                    // Repeat the above steps for other queries
            
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $f . '], [1267401600000, ' . $m . '], [1270080000000, ' . $a . '], [1272672000000, ' . $my . '], [1275350400000, ' . $ju . '], [1277942400000, ' . $rows['counted'] . '], [1280620800000, 0], [1283299200000, 0], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
                    break;
                case '08':
                    $this->db->select('COUNT(id) AS counted');
                    $this->db->where('YEAR(date)', date('Y'));
                    $this->db->where('MONTH(date)', '01');
                    $result_j = $this->db->get('tbl_took_survey')->row();
                    $j = $result_j->counted;
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '03'));
                    $m = $query_m->row_array()['counted'];
                    $query_a = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '04'));
                    $a = $query_a->row_array()['counted'];
                    $query_my = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '05'));
                    $my = $query_my->row_array()['counted'];
                    $query_ju = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '06'));
                    $ju = $query_ju->row_array()['counted'];
                    $query_jy = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '07'));
                    $jy = $query_jy->row_array()['counted'];
                    // Repeat the above steps for other queries
            
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $f . '], [1267401600000, ' . $m . '], [1270080000000, ' . $a . '], [1272672000000, ' . $my . '], [1275350400000, ' . $ju . '], [1277942400000, ' . $jy . '], [1280620800000, ' . $rows['counted'] . '], [1283299200000, 0], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
                    break;
                case '09':
                    $this->db->select('COUNT(id) AS counted');
                    $this->db->where('YEAR(date)', date('Y'));
                    $this->db->where('MONTH(date)', '01');
                    $result_j = $this->db->get('tbl_took_survey')->row();
                    $j = $result_j->counted;
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '03'));
                    $m = $query_m->row_array()['counted'];
                    $query_a = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '04'));
                    $a = $query_a->row_array()['counted'];
                    $query_my = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '05'));
                    $my = $query_my->row_array()['counted'];
                    $query_ju = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '06'));
                    $ju = $query_ju->row_array()['counted'];
                    $query_jy = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '07'));
                    $jy = $query_jy->row_array()['counted'];
                    $query_ag = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '08'));
                    $ag = $query_ag->row_array()['counted'];
                    // Repeat the above steps for other queries
            
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $f . '], [1267401600000, ' . $m . '], [1270080000000, ' . $a . '], [1272672000000, ' . $my . '], [1275350400000, ' . $ju . '], [1277942400000, ' . $jy . '], [1280620800000, ' . $ag . '], [1283299200000, ' . $rows['counted'] . '], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
                    break;

                case '10':
                    $this->db->select('COUNT(id) AS counted');
                    $this->db->where('YEAR(date)', date('Y'));
                    $this->db->where('MONTH(date)', '01');
                    $result_j = $this->db->get('tbl_took_survey')->row();
                    $j = $result_j->counted;
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '03'));
                    $m = $query_m->row_array()['counted'];
                    $query_a = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '04'));
                    $a = $query_a->row_array()['counted'];
                    $query_my = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '05'));
                    $my = $query_my->row_array()['counted'];
                    $query_ju = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '06'));
                    $ju = $query_ju->row_array()['counted'];
                    $query_jy = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '07'));
                    $jy = $query_jy->row_array()['counted'];
                    $query_ag = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '08'));
                    $ag = $query_ag->row_array()['counted'];
                    $query_st = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '09'));
                    $st = $query_st->row_array()['counted'];
            
                    // Repeat the above steps for other queries
            
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $f . '], [1267401600000, ' . $m . '], [1270080000000, ' . $a . '], [1272672000000, ' . $my . '], [1275350400000, ' . $ju . '], [1277942400000, ' . $jy . '], [1280620800000, ' . $ag . '], [1283299200000, ' . $st . '], [1285891200000, ' . $rows['counted'] . '], [1288569600000, 0], [1291161600000, 0]]';
                    break;

                case '11':
                    $this->db->select('COUNT(id) AS counted');
                    $this->db->where('YEAR(date)', date('Y'));
                    $this->db->where('MONTH(date)', '01');
                    $result_j = $this->db->get('tbl_took_survey')->row();
                    $j = $result_j->counted;
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '03'));
                    $m = $query_m->row_array()['counted'];
                    $query_a = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '04'));
                    $a = $query_a->row_array()['counted'];
                    $query_my = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '05'));
                    $my = $query_my->row_array()['counted'];
                    $query_ju = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '06'));
                    $ju = $query_ju->row_array()['counted'];
                    $query_jy = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '07'));
                    $jy = $query_jy->row_array()['counted'];
                    $query_ag = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '08'));
                    $ag = $query_ag->row_array()['counted'];
                    $query_st = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '09'));
                    $st = $query_st->row_array()['counted'];
                    $query_ou = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '10'));
                    $ou = $query_ou->row_array()['counted'];
                    // Repeat the above steps for other queries
            
                    return '[[1262304000000, ' . $j . '], [1264982400000, ' . $f . '], [1267401600000, ' . $m . '], [1270080000000, ' . $a . '], [1272672000000, ' . $my . '], [1275350400000, ' . $ju . '], [1277942400000, ' . $jy . '], [1280620800000, ' . $ag . '], [1283299200000, ' . $st . '], [1285891200000, ' . $ou . '], [1288569600000, ' . $rows['counted'] . '], [1291161600000, 0]]';
                    break;

                case '12':
                    $this->db->select('COUNT(id) AS counted');
                    $this->db->where('YEAR(date)', date('Y'));
                    $this->db->where('MONTH(date)', '01');
                    $result_j = $this->db->get('tbl_took_survey')->row();
                    $j = $result_j->counted;
                    $query_f = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '02'));
                    $f = $query_f->row_array()['counted'];
                    $query_m = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '03'));
                    $m = $query_m->row_array()['counted'];
                    $query_a = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '04'));
                    $a = $query_a->row_array()['counted'];
                    $query_my = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '05'));
                    $my = $query_my->row_array()['counted'];
                    $query_ju = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '06'));
                    $ju = $query_ju->row_array()['counted'];
                    $query_jy = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '07'));
                    $jy = $query_jy->row_array()['counted'];
                    $query_ag = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '08'));
                    $ag = $query_ag->row_array()['counted'];
                    $query_st = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '09'));
                    $st = $query_st->row_array()['counted'];
                    $query_ou = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '10'));
                    $ou = $query_ou->row_array()['counted'];
                    $query_nov = $this->db->query("SELECT COUNT(id) AS counted FROM tbl_took_survey WHERE YEAR(date) = ? AND MONTH(date) = ? LIMIT 1", array(date('Y'), '11'));
                    $nov = $query_nov->row_array()['counted'];
            
                    // Repeat the above steps for other queries
            
                    return '[[1262304000000, '.$j.'], [1264982400000, '.$f.'], [1267401600000, '.$m.'], [1270080000000, '.$a.'], [1272672000000, '.$my.'], [1275350400000, '.$ju.'], [1277942400000, '.$jy.'], [1280620800000, '.$ag.'], [1283299200000, '.$st.'], [1285891200000, '.$ou.'], [1288569600000, '.$nov.'], [1291161600000, '.$rows['counted'].']]';
                    break;
            }
        } else {
            return '[[1262304000000, 0], [1264982400000, 0], [1267401600000, 0], [1270080000000, 0], [1272672000000, 0], [1275350400000, 0], [1277942400000, 0], [1280620800000, 0], [1283299200000, 0], [1285891200000, 0], [1288569600000, 0], [1291161600000, 0]]';
        }
    }

    public function getFullName($userID) {
        $this->db->select('first_name, last_name');
        $this->db->from('tbl_user');
        $this->db->where('id', "$userID");
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $data = $row->first_name . ' ' . $row->last_name;
            return $data;
        } else {
            return false;
        }
    }
}