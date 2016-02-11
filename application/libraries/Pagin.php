<?php

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
        $htmlOut = '<div class="pager-title">
                            страницы:
                    </div>
                    <div class="pager-list">';      // HTML - код постраничной навигации
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
            $htmlOut .= '<a class="pager_link pager_link-prev" href="' . $this->base_url . $amp . $this->param . '='.($this->cur_page - 1).'"></a>';
        } else {
            $htmlOut .= '<a class="pager_link pager_link-prev"></a>';
        }
        $htmlOut .= '<ul>';
        // Собсно выводим ссылки из нужного чанка
        foreach ($allPage[$needChunk] AS $pageNum => $ofset) {
            // Делаем текущую страницу не активной:
            if ($ofset == $this->cur_page) {
                $htmlOut .= '<li class="pager_link active"><a>' . $pageNum . '</a></li>';
                continue;
            }
            $htmlOut .= '<li class="pager_link"><a href="' . $this->base_url . $amp . $this->param . '=' . $pageNum . '">' . $pageNum . '</a></li>';
        }
        $htmlOut .= '</ul>';
        // Формируем ссылки "следующая", "в конец" ------------------------------------------------
        //var_dump(@array_pop(array_pop($allPage)));die();
        $lasst = @array_pop(array_pop($allPage));
        if ($lasst * $this->page_size > $this->cur_page * $this->page_size) {
            $htmlOut .= '<a href="' . $this->base_url . $amp . $this->param . '='.($this->cur_page + 1).'" class="pager_link pager_link-next"></a>';
        } else {
            $htmlOut .= '<a class="pager_link pager_link-next"></a>';
        }
        $htmlOut .= '</div>';
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
