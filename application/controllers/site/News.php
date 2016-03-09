<?php

class News extends CI_Controller {

    private $Component = "news";

    public function __construct() {
        parent::__construct();
        $this->load->model('Base_model');
        $this->Base_model->set_table("Text");
        $this->vstavka = $this->Base_model->get_ListV();
        $this->load->model('News_model');
        $this->load->model('list_model');
        $this->load->model('Load_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $this->load->helper('text');
        $this->CurrentModel = $this->News_model;
        $this->ajax = $this->input->post('type', true);
        if (!$this->ajax) {
            $List11 = $this->list_model->get_List(array("Parent_id" => 13, "count" => 100));
            $cat = $this->list_model->get_List(array("Parent_id" => 28, "count" => 100));
            $cat1 = $this->list_model->get_List(array("Parent_id" => 29, "count" => 100));
            $cat2 = $this->list_model->get_List(array("Parent_id" => 19, "count" => 100));
            $this->menu = $this->list_model->menuCat($List11, array(array("link" => "/catalog/catalog/", "list" => $cat, "id" => 14),
                array("link" => "/catalog/material/", "list" => $cat1, "id" => 22)), "", "");
            $this->cat = $cat2;
        }
    }

    public function index($type = 'news') {
        $dat['seo'] = $this->Seo_model->getSeo($_SERVER['REQUEST_URI']);
        $dat['vstavka'] = $this->vstavka;
        $before = "/news/";
        $TiteleFirest = "Новости";
        if (!$this->ajax) {
            $dat['cat'] = $this->getMenuCat($this->cat, $type, "", $before);
            $dat['menu'] = $this->menu;
        }
        if ($type === "news") {
            $type = 20;
            $before = "/news/news/";
        } else {
            $type = 21;
            $TiteleFirest = "Акции";
            $before = "/news/akcii/";
        }
        $page = $this->input->get('page', true);
        $config['total_rows'] = $this->CurrentModel->get_count();
        $config['base_url'] = "";
        $config['cur_page'] = $page;
        $config['page_size'] = 16;
        $this->pagin->initialize($config);
        $dat['pagin'] = $this->pagin->getLinks();
        $catalogList = $this->CurrentModel->get_List(array("current" => $page, "count" => $config['page_size'], "Cat" => $type));
        $dat["catList"] = $this->madeTrueArray($catalogList, false);
        $dat["Crumbs"] = $this->getCrumbs(array(), false, $before, $TiteleFirest);
        if (!$this->ajax) {
            $this->load->view('site/base/header', $dat);
            $this->load->view('site/' . $this->Component . '/list', $dat);
        }
        $this->load->view('site/' . $this->Component . '/catalog', $dat);
        if (!$this->ajax) {
            $this->load->view('site/' . $this->Component . '/listEnd', $dat);
            $this->load->view('site/base/footer');
        }
    }

    public function item($id) {
        $dat['seo'] = $this->Seo_model->getSeo($_SERVER['REQUEST_URI']);
        $dat['vstavka'] = $this->vstavka;
        $dat['menu'] = $this->menu;
        $dat['content'] = $this->CurrentModel->get_List(array("count" => 1, 'EnglishTitle' => $id));
        if (!$dat['content']) {
            header("Location: /{$this->Component}/catalog/");
        }
        
        //$dat['item'] = $this->madeTrueArrayForItem($catalogItem);
        $before = "/news/news/";
         $TiteleFirest = "Новости";
        if (array_reverse(explode(",", trim($dat['content']['Cat'], ",")))[0]==21){
            $TiteleFirest = "Акции";
            $before = "/news/akcii/";
        }
        $dat['cat'] = $this->getMenuCat($this->cat, $dat['content']['Cat'], "", $before);
        $dat["Crumbs"] = $this->getCrumbs(array(), true, $before, $TiteleFirest);
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/' . $this->Component . '/item' , $dat);
        $this->load->view('site/base/footer');
    }

    private function madeTrueArray($mas, $array = false) {
        foreach ($mas as $k => $v) {
            $pthoto = $this->Load_model->get_List(array('count' => ($array ? 100 : 1), "Type" => "news", "Item_id" => $v['id']));
            if ($pthoto) {
                $mas[$k]['photo'] = ($array ? $pthoto : $pthoto['Puth'] . "small/" . $pthoto['Name']);
            } else {
                $mas[$k]['photo'] = "";
            }
        }
        return $mas;
    }
    

    private function getCrumbs($mas1, $pr = false, $before = "/catalog/", $TiteleFirest = "Каталог") {
        //echo "<pre>";
        $mas["Title"] = $TiteleFirest;
        $mas['Crumbs'] = "<ul class='grayline-list'>
            <li><a href='/'>Главная</a></li>
            <li class='sep'>/</li>";
        $a = "<li><a href='{$before}'>{$TiteleFirest}</a></li>";
        $last = "<li>{$TiteleFirest}</li>";
        $beforeLisnk = $before;
        foreach (($mas1) as $v) {
            //var_dump($v);
            if ($v && $v !== '1' && $v !== '28' && $v !== '29') {
                $currentList = $this->list_model->get_List(array("idLink" => $v, "count" => 1, "Parent_id_NOT" => 0));
                //var_dump($currentList);
                if ($currentList) {
                    $mas['Crumbs'] .= $a . "<li class='sep'>/</li>";
                    $a = "<li><a href='{$beforeLisnk}{$currentList['Link']}/'>{$currentList['Title']}</a></li>";
                    $last = "<li>{$currentList['Title']}</li>";
                    $mas["Title"] = $currentList['Title'];
                    $beforeLisnk = "{$beforeLisnk}{$currentList['Link']}/";
                }
            }
        }
        $mas['Crumbs'] .= ($pr ? $a : $last);
        //echo "</pre>";
        //var_dump($mas1);
        //var_dump($mas['Crumbs']);
        //die();
        $mas['Crumbs'] .= "</ul>";
        return $mas;
    }

    private function getMenuCat($list, $act, $str, $url) {
        $str .= '<ul class="sidemenu noajax">';
        foreach ($list as $v) {
            $active = "";
            $style = "";
            if ($v['Link'] === $act) {
                $active = "active";
                $style = "style='display: block;'";
            }
            $str .= '<li class="sidemenu__item ' . $active . '">
                        <a href="' . $url . $v['Link'] . '/" class="sidemenu__item-link"><span>' . $v['Title'] . '</span></a>';
            $List11 = $this->list_model->get_List(array("Parent_id" => $v['id'], "count" => 100));
            if ($List11) {
                $str .=
                        '<div class="sidemenu__item-count">' . count($List11) . '</div>
                            <div class="sidemenu__item-dropbox" ' . $style . '>
                                <ul>';
                foreach ($List11 as $v1) {
                    $str.='<li><a href="' . $url . $v['Link'] . '/' . $v1['Link'] . '/"><span>' . $v1['Title'] . '<span></a></li>';
                }
                $str .= '</ul>';
            }

            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }

}
