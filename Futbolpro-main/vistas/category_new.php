<div class="container is-fluid mb-6">
	<h1 class="title">Categorías</h1>
	<h2 class="subtitle">Nueva categoría</h2>
</div>

<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/categoria_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre de equipo</label>
				  	<input class="input" type="text" name="nombre_equipo" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Partidos jugados</label>
				  	<input class="input" type="text" name="partidos_jugados" pattern="[0-8]{0,30}" maxlength="50" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Partidos ganados</label>
				  	<input class="input" type="text" name="partidos_ganados"  maxlength="50" >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Partidos empatados</label>
				  	<input class="input" type="text" name="partidos_empate" maxlength="50" >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Partidos perdidos</label>
				  	<input class="input" type="text" name="partidos_perdidos"  maxlength="50" >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Goles a favor</label>
				  	<input class="input" type="text" name="goles_favor"  maxlength="50" >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Goles en contra</label>
				  	<input class="input" type="text" name="goles_contra"  maxlength="50" >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>