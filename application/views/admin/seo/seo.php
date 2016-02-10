<div class="templatemo-content-wrapper">
    <div class="templatemo-content">
      <ol class="breadcrumb">
        <li><a href='/fasadm/'>Административная панель</a></li>
        <li class="active">SEO модуль</li>
      </ol>
      <h1>SEO модуль</h1>
      <div class="row">
        <div class="col-md-12">
          <!--<div class="btn-group pull-right" id="templatemo_sort_btn">
            <button type="button" class="btn btn-default">Sort by</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">First Name</a></li>
              <li><a href="#">Last Name</a></li>
              <li><a href="#">Username</a></li>
            </ul>
          </div>-->
          <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>url</th>
                  <th>h1</th>
                  <th>title</th>
                  <th>kywords</th>
                  <th>Редактировать</th>
                  <th>Удалить</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($seo as $item):?>
                <tr>
                  
                  <td><?=$item['id']?></td>
                  <td><?=$item['url']?></td>
                  <td><?=$item['h1']?></td>
                  <td><?=$item['title']?></td>
                  <td><?php echo word_limiter($item['kywords'],3) ?></td>
                  <td><a href="/fasadm/seo/edit/<?=$item['id']?>/" class="btn btn-default">Edit</a></td>                    
                  <td><a href="/fasadm/seo/delete/<?=$item['id']?>/" class="btn btn-link">Delete</a></td>
                </tr> 
                <?php endforeach ?>
              </tbody>
            </table> 
          </div>
          <div class="col-md-12">
              <a href="/fasadm/seo/add/" class="btn btn-primary">Добавить</a>   
          </div>
          <ul class="pagination pull-right">
            <li class="disabled"><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
            <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
            <li><a href="#">3 <span class="sr-only">(current)</span></a></li>
            <li><a href="#">4 <span class="sr-only">(current)</span></a></li>
            <li><a href="#">5 <span class="sr-only">(current)</span></a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>  
        </div>
      </div>
    </div>
  </div>

