<!DOCTYPE html>
<html>
<head>
	<title>Laravel Rekognition</title>

	<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!--Fonts-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<!--/Fonts-->

	<!--Style-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<!--/Style-->

	<!--Scripts-->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!--/Scripts-->
</head>
<body>

	<nav class="navbar navbar-dark bg-dark">
  		<div class="container">
  			<a class="navbar-brand" href="{{url('/')}}"><i class="fas fa-arrow-left"></i> Rekognition</a>
  		</div>
	</nav>

	<div class="container py-4">
		@if(session('info'))
			<div class="container">
				<div class="alert alert-{{ session('info')[0] }} alert-dismissible fade show text-center" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					</button>
					{{ session('info')[1] }}
				</div>
			</div>
		@endif

		<!-- Results -->
		@if(isset($results))

		<div class="bd-example bd-example-tabs">
			<div class="row">
				<div class="col-3">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

						<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false">Tabla</a>

						<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">JSON</a>

					</div>
				</div>

				<div class="col-9">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<div class="table-responsive">
								<table class="table table-borderless table-hover">
									<thead class="thead-dark">
										<tr>
											<th>Encontrado</th>
											<th>Nivel de confianza</th>
										</tr>
									</thead>
									<tbody>
										@yield('foreach')
									</tbody>
								</table>
							</div>
						</div>

						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							<code>
								@json($results);
							</code>
						</div>
					</div>
				</div>
			</div>
		</div>


		@else

		@yield('form_open')
			@csrf

			
				<div class="container">
					<div class="col-md-4 mb-3 mt-4">
						<input class="form-control is-valid" type="number" id="confidence" name="confidence" value="50" required min="0" max="100">
						<div class="valid-feedback">
						La confianza mínima por defecto es de 50.
						</div>
					</div>

					<div class="col-md-4 mb-3 mt-4">
						<div class="custom-file">
							<input type="file" name="photo" id="photo" class="custom-file-input" required>
							<label class="custom-file-label" for="photo">Selecciona la imagen</label>
							<div class="invalid-feedback">Debes tener una imagen para analizar</div>
						</div>
					</div>

					<div class="col-md-4 mt-4 text-right">
						<div class="form-group">
							<input type="submit" value="Examinar imagen" class="btn btn-outline-dark">
						</div>
					</div>
				</div>
	     	
	   </form>
	   @endif
	   <!-- /Results -->
	</div>

	<footer class="footer mt-auto py-3">
  		<div class="container">
			<span class="text-muted">Integración de AWS - Rekogntion | Desarrollado por <b>Brayan Angarita</b>, <b>Pablo Díaz</b> para <b>Linux</b></span>
		</div>
	</footer>

</body>
</html>