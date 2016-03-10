@if ($errors->any())
  	<div class="alert alert-warning">
    	<button type="button" class="close" data-dismiss="alert">&times;</button>
    	<h4><i class="fa fa-exclamation-triangle fa-fw"></i> Por favor corrige los siguentes errores:</h4>
    	<ul>
		    @foreach ($errors->all() as $error)
		      <li>{{ $error }}</li>
		    @endforeach
    	</ul>
  	</div>
@endif