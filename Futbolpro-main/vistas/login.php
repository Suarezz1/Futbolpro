<div class="main-container has-background-light" style="min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px;">
	<form class="box login has-background-white-ter" style="max-width: 400px; width: 100%; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);" action="" method="POST" autocomplete="off">
		<h5 class="title is-4 has-text-centered is-uppercase has-text-primary" style="font-weight: 700; letter-spacing: 1px;">FUTBOLPRO</h5>
		<p class="has-text-centered has-text-primary" style="font-size: 1.13rem;">Ingresa para acceder</p>

		<div class="field">
			<label class="label has-text-grey-dark">Usuario</label>
			<div class="control has-icons-left">
			    <input class="input is-rounded" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" placeholder="Ingresa tu usuario" required>
			    <span class="icon is-small is-left">
			        <i class="fas fa-user"></i>
			    </span>
			</div>
		</div>

		<div class="field">
		  	<label class="label has-text-grey-dark">Clave</label>
		  	<div class="control has-icons-left">
		    	<input class="input is-rounded" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" placeholder="Ingresa tu clave" required>
		    	<span class="icon is-small is-left">
		        	<i class="fas fa-lock"></i>
		      	</span>
		  	</div>
		</div>

		<p class="has-text-centered mb-4 mt-5">
			<button type="submit" class="button is-primary is-rounded is-fullwidth has-text-weight-bold" style="padding: 10px;">Iniciar Sesión</button>
		</p>

		<?php
			if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
				require_once "./php/main.php";
				require_once "./php/iniciar_sesion.php";
			}
		?>
	</form>
</div>
