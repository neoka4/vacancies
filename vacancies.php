<?php
require_once('connect_pdo.php');
defined('TBL_VACANCY') || define('TBL_VACANCY', 'vacancy');
defined('TBL_CURRENCY') || define('TBL_CURRENCY', 'currency');
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

$error = FALSE;
if ('add' == $action)
{
		$query = "INSERT INTO ".TBL_VACANCY."
				  SET
					url=?,
					salary=?,
					company=?,
					addtime=NOW()";
		$stmt = $pdo->prepare($query);
		try
		{
			$stmt->execute(array($_REQUEST['url'], $_REQUEST['salary'], $_REQUEST['company']));
		}
		catch(PDOException $e)
		{
			$error = $e->getMessage();
		}
}
$query = "SELECT * FROM ".TBL_VACANCY." ORDER BY id DESC";
$vacancies_ar = $pdo->query($query)->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
    
		<div class="row">
			<header>
				<h1>Вакансии</h1>
			</header>
		</div>
		
		<nav>
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#list" data-toggle="tab">Список</a>
				</li>
				<li>
					<a href="#add" data-toggle="tab">Добавить</a>
				</li>
			</ul>
		</nav>
		
		<div class="tab-content">
		
			<section id="add" class="tab-pane row">
				<div class="col-xs-6">
					
					<header>
						<h2 class="sr-only">Добавить вакансию</h2>
					</header>
					
					<?php if ($error): ?>
					<div class="alert alert-danger big">
						<span class="glyphicon glyphicon-alert">
						Вакансия не добавилась в БД
						<div>Ошибка: <?php echo $error;?></div>
					</div>
					<?php endif; ?>
					
					<form action=""method="POST">
						<input type="hidden" name="action" value="add">
						<div class="form-group">
							<label>URL</label>
							<input class="form-control" type="text" name="url">
						</div>
						<div class="form-group">
							<label>Зарплата</label>
							<input class="form-control" type="text" name="salary">
						</div>
						<div class="form-group">
							<label>Компания</label>
							<input class="form-control" type="text" name="company">
						</div>
						<input class="btn btn-success" type="submit" value="Добавить вакансию">
					</form>
				
				</div>
			</section >
		
		
			<section  id="list" class="tab-pane active row">	
				<div class="xs-col-12">
				
					<header>
						<h2 class="sr-only">Список вакансий</h2>
					</header>
					
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Зарплата</th>
								<th>Компания</th>
								<th>Описание</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($vacancies_ar as $vacancy): ?>
							<tr>
								<td><?php echo $vacancy['salary']; ?></td>
								<td><?php echo $vacancy['company']; ?></td>
								<td>
									<a href="<?php echo $vacancy['url']; ?>" target="_blank">
										<?php echo $vacancy['url']; ?>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				
				</div>
			</section >
		
		</div>
		
    </div>

    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/jquery.tablesorter.js"></script>
    <script>
    $(function(){
		$("table").tablesorter();
    });
    </script>
  </body>
</html>