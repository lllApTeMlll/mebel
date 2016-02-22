<?php

class Content extends CI_Controller {

    private $menu = "";
    private $Component = "content";

    public function __construct() {
        parent::__construct();
        $this->load->model('Content_model');
        //$this->load->model('Load_model');
        $this->load->model('list_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $List11 = $this->list_model->get_List(array("Parent_id" => 13, "count" => 100));
        $cat = $this->list_model->get_List(array("Parent_id" => 28, "count" => 100));
        $cat1 = $this->list_model->get_List(array("Parent_id" => 29, "count" => 100));
        $this->menu = $this->list_model->menuCat($List11, array(array("link" => "/catalog/catalog/", "list" => $cat, "id" => 14),
            array("link" => "/catalog/material/", "list" => $cat1, "id" => 22)), "", "");
    }

    public function index() {
        //echo "ok";die();
        $dat['menu'] = $this->menu;
        $dat['content'] = $this->Content_model->get_List(array("count" => 1, "Url" => $_SERVER['REQUEST_URI']));
        if (!$dat['content']) {
            show_404();
            die();
        }
        $root = $this->getRootCat($_SERVER['REQUEST_URI']);
        if ($root) {
            $before = $root["Link"];
            $TiteleFirest = $root["Title"];
            //var_dump($root);die();
            $arrayUrl = $this->getArayForUrl($_SERVER['REQUEST_URI']);
            $cat2 = $this->list_model->get_List(array("Parent_id" => $root["id"], "count" => 100));
            $dat['cat'] = $this->getMenuCat($cat2, $arrayUrl, "", $before);
            $dat["Crumbs"] = $this->getCrumbs($arrayUrl, false, $before, $TiteleFirest,array($root["Link"]));
        } else {
            $dat['cat'] = "";
            $dat["Crumbs"] = array("Title" => $dat['content']["Title"], 'Crumbs' => "<ul class='grayline-list'>
            <li><a href='/'>Главная</a></li>
            <li class='sep'>/</li><li>{$dat['content']["Title"]}</li></ul>");
        }
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/' . $this->Component . '/' . $dat['content']["Cat"], $dat);
        $this->load->view('site/base/footer');
    }

    private function getArayForUrl($url) {
        $url = explode("/", trim($url, "/"));
        //var_dump($url);
        $before = "";
        $mas = array();
        foreach ($url as $v) {
            $mas[] = $before . "/" . $v . "/";
            $before = $before . "/" . $v . "";
        }
        return $mas;
    }

    private function getRootCat($url) {
        $url = explode("/", trim($url, "/"));
        //var_dump($url);
        $before = "";
        foreach ($url as $v) {
            $currentList = $this->list_model->get_List(array("idLink" => $before . "/" . $v . "/", "count" => 1, "Parent_id" => 13));
            $before = $before . "/" . $v . "/";
            if ($currentList) {
                return $currentList;
            }
        }
        //die();
        return false;
    }

    private function getCrumbs($mas1, $pr = false, $before = "/catalog/", $TiteleFirest = "Каталог",$root) {
        //echo "<pre>";
        $mas["Title"] = $TiteleFirest;
        $mas['Crumbs'] = "<ul class='grayline-list'>
            <li><a href='/'>Главная</a></li>
            <li class='sep'>/</li>";
        $a = "<li><a href='{$before}'>{$TiteleFirest}</a></li>";
        $last = "<li>{$TiteleFirest}</li>";
        $beforeLisnk = $before;
        foreach (($mas1) as $v) {
            if ($v && !in_array($v, $root)) {
                $currentList = $this->list_model->get_List(array("idLink" => $v, "count" => 1, "Parent_id_NOT" => 0));
                //var_dump($currentList);
                if ($currentList) {
                    $mas['Crumbs'] .= $a . "<li class='sep'>/</li>";
                    $a = "<li><a href='{$currentList['Link']}'>{$currentList['Title']}</a></li>";
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
        //echo "<pre>";
        $str .= '<ul class="sidemenu noajax">';
        foreach ($list as $v) {
            $active = "";
            $style = "";
            //var_dump($act);
            if (in_array($v['Link'], $act)) {
                $active = "active";
                $style = "style='display: block;'";
            }
            $str .= '<li class="sidemenu__item ' . $active . '">
                        <a href="' . $v['Link'] . '" class="sidemenu__item-link"><span>' . $v['Title'] . '</span></a>';
            $List11 = $this->list_model->get_List(array("Parent_id" => $v['id'], "count" => 100));
            if ($List11) {
                $str .=
                        '<div class="sidemenu__item-count">' . count($List11) . '</div>
                            <div class="sidemenu__item-dropbox" ' . $style . '>
                                <ul>';
                foreach ($List11 as $v1) {
                    $active = "";
                    if (in_array($v1['Link'], $act)) {
                        $active = "active";
                    }
                    $str.='<li class="' . $active . '"><a href="' . $v1['Link'] . '"><span>' . $v1['Title'] . '<span></a></li>';
                }
                $str .= '</ul>';
            }

            $str .= '</li>';
        }
        $str .= '</ul>';
        //die();
        return $str;
    }

}
