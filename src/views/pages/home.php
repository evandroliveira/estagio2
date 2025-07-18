<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card shadow">
					<div class="card-body">
						<h4 class="card-title mb-4 text-center">Login</h4>
						
						<form method="post" autocomplete="on">
							<div class="mb-3">
								<label for="email" class="form-label">E-mail</label>
								<input type="email" class="form-control" id="email" name="email" required>
							</div>
							<div class="mb-3">
								<label for="senha" class="form-label">Senha</label>
								<input type="password" class="form-control" id="senha" name="senha" required>
							</div>
							<button type="submit" class="btn btn-primary w-100">Entrar</button>
						</form>
						
					</div>
					
				</div>
				<a href="cadastro.php" class="btn btn-secondary w-100">Novo usuário</a>
			</div>
		</div>
	</div>
	<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>