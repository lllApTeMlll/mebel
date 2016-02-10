<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 */
class CI_Pagin {

    /**
     * Base URL
     *
     * The page that we're linking to
     *
     * @var	string
     */
    protected $base_url = '';

    /**
     * Prefix
     *
     * @var	string
     */
    protected $prefix = '';

    /**
     * Suffix
     *
     * @var	string
     */
    protected $suffix = '';

    /**
     * Total number of items
     *
     * @var	int
     */
    protected $total_rows = 0;
    protected $all_show = 10;
    public $cur_page = 1;
    public $page_size = 8;
    public $param = "page";

    /**
     * CI Singleton
     *
     * @var	object
     */
    protected $CI;
    public $id = 'pagination';
    public $startChar = '&laquo;';
    public $prevChar = '&lsaquo;';
    public $nextChar = '&rsaquo;';
    public $endChar = '&raquo;';

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param	array	$params	Initialization parameters
     * @return	void
     */
    public function __construct($params = array()) {
        $this->initialize($params);
    }

    public function initialize(array $params = array()) {
        if (isset($params['base_url'])) {
            $this->base_url = $params['base_url'];
        }
        if (isset($params['total_rows']) && is_numeric($params['total_rows'])) {
            $this->total_rows = $params['total_rows'];
        }
        if (isset($params['cur_page']) && is_numeric($params['cur_page'])) {
            $this->cur_page = $params['cur_page'];
        }
        if (isset($params['page_size']) && is_numeric($params['page_size'])) {
            $this->page_size = $params['page_size'];
        }
        if (isset($params['prefix'])) {
            $this->prefix = $params['prefix'];
        }

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Generate the pagination links
     *
     * @return	string
     */
    public function create_links() {
        $str = "";
        if ($this->page_size < $this->total_rows) {
            $fist = $this->cur_page;
            $fist-=3;
            if ($fist < 0)
                $fist = 0;
            if ($fist > 0) {
                $str.="<a class='button small nobg primary ' href='{$this->base_url}0'>1</a>";
            }
            for ($i = $fist; $i < $fist + $this->all_show; $i++) {
                if ($i * $this->page_size > $this->total_rows)
                    break;
                $y = $i;
                $y++;
                $act = "";
                if ($i == $this->cur_page)
                    $act = 'current';
                $str.="<a class='button small nobg primary $act' href='{$this->base_url}{$i}'>$y</a>";
            }
            if (($fist + $this->all_show) * $this->page_size < $this->total_rows) {
                $str.="<a class='button small nobg primary ' href='{$this->base_url}0'>1</a>";
            }
        }
        return $str;
    }

    public function getLinks() {
        // Нихрена не делаем, если лимит больше или равен кол-ву всех элементов вообще,
        // И если лимит = 0. 0 - будет означать "не разбивать н астраницы".
        $this->base_url = "";
        if ($this->page_size >= $this->total_rows || $this->page_size == 0) {
            return "";
        }

        $pages = 0;       // кол-во страниц в пагинации
        $needChunk = 0;       // индекс нужного в данный момент чанка
        $queryVars = array(); // ассоц. массив полученный из строки запроса
        $pagesArr = array(); // пременная для промежуточного хранения массива навигации
        $htmlOut = '';      // HTML - код постраничной навигации
        //  $this->base_url      = "/catalog/3/3/";    // формируемая ссылка
        // В этом блоке мы просто строим ссылку - такую же, как та, по которой
        // пришли на данную страницу, но извлекаем из неё нашу GET-переменную: 
        parse_str($_SERVER['QUERY_STRING'], $queryVars); //   &$queryVars
        // Убиваем нашу GET-переменную
        if (isset($queryVars[$this->param])) {
            unset($queryVars[$this->param]);
        }

        // Формируем такую же ссылку, ведущую на эту же страницу:
        $this->base_url .= '?' . http_build_query($queryVars);

        //-------------------------------------------------------- 

        $pages = ceil($this->total_rows / $this->page_size); // кол-во страниц
        // Заполняем массив: ключ - это номер страницы, значение - это смещение для БД.
        // Нумерация здесь нужна с единицы. А смещение с шагом = кол-ву материалов на странице.
        $startSc = $this->cur_page;
        $startSc = $startSc - round($this->all_show / 2);
        if ($startSc < 1)
            $startSc = 1;
        for ($i = $startSc; $i < $pages + 1; $i++) {
            $pagesArr[$i] = $i;
        }
        // Теперь что бы на странице отображать нужное кол-во ссылок
        // дробим массив со значениями [№ страницы] => "смещение" на 
        // Части (чанки)
        $allPage = array_chunk($pagesArr, $this->all_show, true);
        // Получаем индекс чанка в котором находится нужное смещение.
        // И далее только из него сформируем список ссылок:
        $needChunk = $this->searchPage($allPage, $this->cur_page);

        // Формируем ссылки "В начало", "передыдущая" ------------------------------------------------
        $amp = "";
        if ((http_build_query($queryVars)) != "")
            $amp = "&";
        if ($this->cur_page > 1) {
            $htmlOut .= '<a rel="canonical" class="button small nobg primary" href="' . $this->base_url . $amp . $this->param . '=1">' . $this->startChar . '</a>' .
                    '<a rel="prev" class="button small nobg primary" href="' . $this->base_url . $amp . $this->param . '=' . ($this->cur_page - 1) . '">' . $this->prevChar . '</a>';
        } else {
            $htmlOut .= '<span class="button small nobg primary">' . $this->startChar . '</span>' .
                    '<span class="button small nobg primary">' . $this->prevChar . '</span>';
        }
        // Собсно выводим ссылки из нужного чанка
        foreach ($allPage[$needChunk] AS $pageNum => $ofset) {
            // Делаем текущую страницу не активной:
            if ($ofset == $this->cur_page) {
                $htmlOut .= '
			<span class="button small nobg primary current">' . $pageNum . '</span>';
                continue;
            }
            $htmlOut .= '<a rel="canonical" class="button small nobg primary" href="' . $this->base_url . $amp . $this->param . '=' . $pageNum . '">' . $pageNum . '</a>';
        }

        // Формируем ссылки "следующая", "в конец" ------------------------------------------------
        //var_dump(@array_pop(array_pop($allPage)));die();
        $lasst = @array_pop(array_pop($allPage));
        if ($lasst * $this->page_size > $this->cur_page * $this->page_size) {
            $htmlOut .= '<a rel="next" class="button small nobg primary" href="' . $this->base_url . $amp . $this->param . '=' . ( $this->cur_page + 1) . '">' . $this->nextChar . '</a>' .
                    '<a rel="canonical" class="button small nobg primary" href="' . $this->base_url . $amp . $this->param . '=' . $lasst . '">' . $this->endChar . '</a>';
        } else {
            $htmlOut .= '<span class="button small nobg primary">' . $this->nextChar . '</span>' .
                    '<span class="button small nobg primary">' . $this->endChar . '</span>';
        }
        return $htmlOut;
    }

    public function getLinksAdmin() {
        // Нихрена не делаем, если лимит больше или равен кол-ву всех элементов вообще,
        // И если лимит = 0. 0 - будет означать "не разбивать н астраницы".
        $this->base_url = "";
        if ($this->page_size >= $this->total_rows || $this->page_size == 0) {
            return "";
        }

        $pages = 0;       // кол-во страниц в пагинации
        $needChunk = 0;       // индекс нужного в данный момент чанка
        $queryVars = array(); // ассоц. массив полученный из строки запроса
        $pagesArr = array(); // пременная для промежуточного хранения массива навигации
        $htmlOut = '';      // HTML - код постраничной навигации
        //  $this->base_url      = "/catalog/3/3/";    // формируемая ссылка
        // В этом блоке мы просто строим ссылку - такую же, как та, по которой
        // пришли на данную страницу, но извлекаем из неё нашу GET-переменную: 
        parse_str($_SERVER['QUERY_STRING'], $queryVars); //   &$queryVars
        // Убиваем нашу GET-переменную
        if (isset($queryVars[$this->param])) {
            unset($queryVars[$this->param]);
        }

        // Формируем такую же ссылку, ведущую на эту же страницу:
        $this->base_url .= '?' . http_build_query($queryVars);

        //-------------------------------------------------------- 

        $pages = ceil($this->total_rows / $this->page_size); // кол-во страниц
        // Заполняем массив: ключ - это номер страницы, значение - это смещение для БД.
        // Нумерация здесь нужна с единицы. А смещение с шагом = кол-ву материалов на странице.
        $startSc = $this->cur_page;
        $startSc = $startSc - round($this->all_show / 2);
        if ($startSc < 1)
            $startSc = 1;
        for ($i = $startSc; $i < $pages + 1; $i++) {
            $pagesArr[$i] = $i;
        }
        // Теперь что бы на странице отображать нужное кол-во ссылок
        // дробим массив со значениями [№ страницы] => "смещение" на 
        // Части (чанки)
        $allPage = array_chunk($pagesArr, $this->all_show, true);
        // Получаем индекс чанка в котором находится нужное смещение.
        // И далее только из него сформируем список ссылок:
        $needChunk = $this->searchPage($allPage, $this->cur_page);

        // Формируем ссылки "В начало", "передыдущая" ------------------------------------------------
        $amp = "";
        if ((http_build_query($queryVars)) != "")
            $amp = "&";
        if ($this->cur_page > 1) {
            $htmlOut .= '<li><a href="' . $this->base_url . $amp . $this->param . '='.($this->cur_page - 1).'">«</a></li>';
        } else {
            $htmlOut .= '<li><a>«</a></li>';
        }
        // Собсно выводим ссылки из нужного чанка
        foreach ($allPage[$needChunk] AS $pageNum => $ofset) {
            // Делаем текущую страницу не активной:
            if ($ofset == $this->cur_page) {
                $htmlOut .= '<li class="active"><a>' . $pageNum . '</a></li>';
                continue;
            }
            $htmlOut .= '<li><a href="' . $this->base_url . $amp . $this->param . '=' . $pageNum . '">' . $pageNum . '</a></li>';
        }

        // Формируем ссылки "следующая", "в конец" ------------------------------------------------
        //var_dump(@array_pop(array_pop($allPage)));die();
        $lasst = @array_pop(array_pop($allPage));
        if ($lasst * $this->page_size > $this->cur_page * $this->page_size) {
            $htmlOut .= '<li><a href="' . $this->base_url . $amp . $this->param . '='.($this->cur_page + 1).'">»</a></li>';
        } else {
            $htmlOut .= '<li><a>»</a></li>';
        }
        return $htmlOut;
    }

    protected function searchPage(array $pagesList, /* int */ $needPage) {
        foreach ($pagesList AS $chunk => $pages) {
            if (in_array($needPage, $pages)) {
                return $chunk;
            }
        }
        return 0;
    }

}
