<?php

class Films_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_films($type = FALSE, $cid = False, $coou = 8, $cur = 0, $sear = False, $ord = false) {
        if ($cid != FALSE) {
            $idn = $this->getIdCid($cid);
            //var_dump($idn);die();
            if (!empty($idn)) {
                $this->db->group_start();
                foreach ($idn as $k => $v) {
                    $this->db->or_like('`cid`', "," . $v['id'] . ",");
                }
                $this->db->group_end();
            }
        }
        if ($sear != FALSE && $sear != "" && $sear != NUll) {
            $this->db->like('`name`', $sear);
            // $this->db->or_like('`text`', $sear);
        }
        if ($ord == false) {
            $this->db->order_by('dataAdd', 'DESC');
        } else {
            $this->db->order_by('kinop', 'DESC');
        }
        if ($type != FALSE && ($type == 'cinema' || $type == 'serial')) {
            $this->db->where('`type`', $type);
        }
        $this->db->where('`enovT`<>', "1", false);
        $query = $this->db->get('film1', $coou, $cur);
        //$query = $this->db->get_compiled_select('film1',$coou,$cur);
        //var_dump($query);die();
        return $query->result_array();
    }

    public function get_films1($mas) {
        $config = array(
            'type' => FALSE, //тип
            'cid' => FALSE, //категория
            'coou' => 8, //категория
            'cur' => 0, //категория
            'sear' => FALSE,
            'ord' => FALSE,
            'best' => FALSE,
            'yearL' => FALSE,
            'actor' => FALSE,
            'year' => FALSE,
            'cantry' => FALSE,
        );
        $config = array_merge($config, $mas);
        if ($config['actor'] != FALSE) {
            if (is_numeric($config['actor'])) {
                $this->db->or_like('`actor`', "," . $config['actor'] . ",");
            }
        }
        if ($config['cantry'] != FALSE) {
            if (is_numeric($config['cantry'])) {
                $this->db->or_like('`city`', "," . $config['cantry'] . ",");
            }
        }
        if ($config['year'] != FALSE) {
            if (is_numeric($config['year'])) {
                $this->db->where('`year`', $config['year']);
            }
        }
        if ($config['cid'] != FALSE) {
            $idn = $this->getIdCid($config['cid']);
            //var_dump($idn);die();
            if (!empty($idn)) {
                $this->db->group_start();
                foreach ($idn as $k => $v) {
                    $this->db->or_like('`cid`', "," . $v['id'] . ",");
                }
                $this->db->group_end();
            }
        }
        if ($config['sear'] != FALSE && $config['sear'] != "" && $config['sear'] != NUll) {
            $this->db->like('`name`', $config['sear']);
            // $this->db->or_like('`text`', $sear);
        }
        if ($config['ord'] == false) {
            $this->db->order_by('dataAdd', 'DESC');
        } else {
            $this->db->order_by('kinop', 'DESC');
        }
        if ($config['type'] != FALSE && ($config['type'] == 'cinema' || $config['type'] == 'serial')) {
            $this->db->where('`type`', $config['type']);
        }
        if ($config['best'] != FALSE) {
            $this->db->where('`kinop`>', 8);
        }
        if ($config['yearL'] != FALSE) {
            $this->db->where('`year`>', 2012);
            $this->db->not_like('`cid`', ",9520,");
        }
        $this->db->where('`enovT`<>', "1", false);
        $query = $this->db->get('film1', $config['coou'], $config['cur']);
        //$query = $this->db->get_compiled_select('film1',$coou,$cur);
        //var_dump($query);die();
        return $query->result_array();
    }

    public function get_countF1($mas) {
        $config = array(
            'type' => FALSE, //тип
            'cid' => FALSE, //категория
            'sear' => FALSE,
            'yearL' => FALSE,
            'actor' => FALSE,
            'year' => FALSE,
            'cantry' => FALSE,
        );
        $config = array_merge($config, $mas);
        //$this->db->order_by('dataAdd', 'DESC');
        if ($config['actor'] != FALSE) {
            if (is_numeric($config['actor'])) {
                $this->db->or_like('`actor`', "," . $config['actor'] . ",");
            }
        }
        if ($config['cantry'] != FALSE) {
            if (is_numeric($config['cantry'])) {
                $this->db->or_like('`city`', "," . $config['cantry'] . ",");
            }
        }
        if ($config['year'] != FALSE) {
            if (is_numeric($config['year'])) {
                $this->db->where('`year`', $config['year']);
            }
        }
        if ($config['cid'] != FALSE) {
            $idn = $this->getIdCid($config['cid']);
            if (!empty($idn)) {
                $this->db->group_start();
                foreach ($idn as $k => $v) {
                    $this->db->or_like('`cid`', "," . $v['id'] . ",");
                }
                $this->db->group_end();
            }
        }
        if ($config['sear'] != FALSE && $config['sear'] != "" && $config['sear'] != NUll) {
            $this->db->like('`name`', $config['sear']);
            //$this->db->or_like('`text`', $sear);
        }
        if ($config['type'] != FALSE && ($config['type'] == 'cinema' || $config['type'] == 'serial')) {
            $this->db->where('`type`', $config['type']);
        }
        if ($config['yearL'] != FALSE) {
            $this->db->where('`year`>', 2012);
            $this->db->not_like('`cid`', ",9520,");
        }
        $this->db->where('`enovT`<>', "1", false);
        return $this->db->count_all_results('film1');
    }

    public function get_countF($type = FALSE, $cid = False, $sear = False) {
        //$this->db->order_by('dataAdd', 'DESC');

        if ($cid != FALSE) {
            $idn = $this->getIdCid($cid);
            if (!empty($idn)) {
                $this->db->group_start();
                foreach ($idn as $k => $v) {
                    $this->db->or_like('`cid`', "," . $v['id'] . ",");
                }
                $this->db->group_end();
            }
        }
        if ($sear != FALSE && $sear != "" && $sear != NUll) {
            $this->db->like('`name`', $sear);
            //$this->db->or_like('`text`', $sear);
        }
        if ($type != FALSE && ($type == 'cinema' || $type == 'serial')) {
            $this->db->where('`type`', $type);
        }
        $this->db->where('`enovT`<>', "1", false);
        return $this->db->count_all_results('film1');
    }

    public function getSeoIf($url) {
        $query = $this->db->where('`url`', $url)->get('seo');
        return $query->row_array();
    }

    public function getTablRow($tabl, $id) {
        if ($id != FALSE && is_numeric($id)) {
            $this->db->where('`id`', $id);
        }
        $query = $this->db->get($tabl);
        return $query->row_array();
    }

    private function getIdCid($name) {
        $query = $this->db->where('`psevd`', $name)->get('cid');
        return $query->result_array();
    }

    private function getIdTabl($name, $table) {
        $query = $this->db->where('`name`', $name)->get($table);
        return $query->row_array();
    }

    public function get_film($id) {
        $query = $this->db->where('`id`', $id)->get('film1');
        $this->addShow($id);
        return $query->row_array();
    }

    public function get_filmIf($id) {
        $query = $this->db->where('`id_film`', $id)->get('iframe');
        return $query->row_array();
    }

    private function addShow($id) {
        if (!$this->isBot()) {
            $ip = $_SERVER["REMOTE_ADDR"];
            $this->db->where('`id_film`', $id);
            $this->db->where('`ip`', $ip);
            $cou = $this->db->count_all_results('show');
            if ($cou == 0) {
                $data = array(
                    'dataAdd' => date('Y-m-d H:i:s'),
                    'id_film' => $id,
                    'ip' => $ip
                );
                $this->addView($id);
                $this->db->insert('show', $data);
            }
        }
    }

    private function addView($id) {
        $query = $this->db->where('`id`', $id)->get('film1');
        $res = $query->row_array();
        //var_dump($res);die();
        $show = $res['view'];
        $show++;
        $data = array(
            'view' => $show
        );
        //var_dump($show);die();
        $this->db->update('film1', $data, array('id' => $id));
    }

    public function get_Nfilm($id = 0) {
        $this->db->order_by('dataAdd', 'DESC');
        $query = $this->db->where('`newText`', null)->or_where('`newText`', "")->get('film1', 1, 0);
        return $query->row_array();
    }

    public function getNav() {
        $query = $this->db->where('`show`', 0)->order_by('order', 'ASC')->get('cid', 50, 0);
        return $query->result_array();
    }

    public function isBot(&$botname = '') {
        /* Эта функция будет проверять, является ли посетитель роботом поисковой системы */
        $bots = array(
            'rambler', 'googlebot', 'aport', 'yahoo', 'msnbot', 'turtle', 'mail.ru', 'omsktele',
            'yetibot', 'picsearch', 'sape.bot', 'sape_context', 'gigabot', 'snapbot', 'alexa.com',
            'megadownload.net', 'askpeter.info', 'igde.ru', 'ask.com', 'qwartabot', 'yanga.co.uk',
            'scoutjet', 'similarpages', 'oozbot', 'shrinktheweb.com', 'aboutusbot', 'followsite.com',
            'dataparksearch', 'google-sitemaps', 'appEngine-google', 'feedfetcher-google',
            'liveinternet.ru', 'xml-sitemaps.com', 'agama', 'metadatalabs.com', 'h1.hrn.ru',
            'googlealert.com', 'seo-rus.com', 'yaDirectBot', 'yandeG', 'yandex',
            'yandexSomething', 'Copyscape.com', 'AdsBot-Google', 'domaintools.com',
            'Nigma.ru', 'bing.com', 'dotnetdotcom'
        );
        foreach ($bots as $bot)
            if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false) {
                $botname = $bot;
                return true;
            }
        return false;
    }

    public function set_film($text = "", $id = -1) {

        $data = array(
            'dataEdit' => date("y-m-d"),
            'metka' => 0,
            'newText' => $text
        );

        return $this->db->update('film1', $data, array('id' => $id));
    }

}
