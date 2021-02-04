@extends('layouts.landing')

@push('scripts')
   	<script>
   		$(function(){    
	        $('#video-pro').bind('contextmenu',function() { return false; });
	    });
   </script>
@endpush

@section('content')
    @if (Session::has('msj-informativo'))
      	<div class="row">
         	<div class="col-md-12 alert alert-info uk-text-center" style="margin-bottom: 0 !important;">
            	<strong>{{ Session::get('msj-informativo') }}</strong>
         	</div>
      	</div>
    @endif

    @if ($cursosRegalo > 0)
      	<div class="row" >
         	<div class="col-md-12 alert alert-success uk-text-center" style="margin-bottom: 0 !important;">
            	<strong>Tienes nuevo contenido de regalo cortesía de TransfórmatePro. Pincha <a href="{{ route('students.my-gifts') }}">AQUÍ</a> para verlo.</strong>
         	</div>
      	</div>
    @endif

    <div class="courses-banner">
    	<img src="{{ asset('images/courses_banner.jpg') }}" alt="" class="uk-visible@s">
    	<img src="{{ asset('images/courses_banner_movil.jpg') }}" alt="" class="uk-hidden@s">
    	<div class="courses-banner-text">
         	<h1 class="uk-text-bold title">Más que cursos, son una guía de transformación</h1>
         	<span class="description">Son más de <strong>{{ $totalCursos }}</strong> cursos, en los que te ayudamos a crecer como profesional y persona</span>
        </div>
    </div>

    <div class="content" style="padding: 20px 5% 20px 5%; background-color: #E5E5E5;">
    	<div uk-grid>
    		<div class="uk-width-auto@xl uk-width-auto@l uk-width-1-3@m uk-width-1-3@s ">
    			<div class="courses-category-title">Nuestros Cursos</div>

    			<div class="uk-visible@s">
    				<ul class="uk-list categories-list">
    					<li>
    						<a @if ($categoriaSeleccionada == 'destacados') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['destacados', 'destacados']) }}">
    							<i class="far fa-star"></i> Destacados
    						</a>
    					</li>
    					<li>
    						<a @if ($categoriaSeleccionada == 'vendidos') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['mas-vendidos', 'vendidos']) }}">
    							<i class="fas fa-fire"></i> Más Vendidos
    						</a>
    					</li>
    					<li>
    						<a @if ($categoriaSeleccionada == 'recomendados') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['recomendados', 'recomendados']) }}">
    							<i class="far fa-heart"></i> Recomendados
    						</a>
    					</li>
    					@foreach ($categorias as $categoriaLista)
    						<li>
    							<a @if ($categoriaSeleccionada == $categoriaLista->id) class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', [$categoriaLista->slug, $categoriaLista->id]) }}">
    								<i class="{{ $categoriaLista->icon }}"></i> {{ $categoriaLista->title }}
    							</a>
    						</li>
    					@endforeach
    					<li>
    						<a @if ($categoriaSeleccionada == 'tbooks') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['t-books', 'tbooks']) }}">
    							<i class="fas fa-book"></i> T-Books
    						</a>
    					</li>
    					<li>
    						<a @if ($categoriaSeleccionada == 100) class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['t-master-class', 100]) }}">
    							<i class="fab fa-tumblr"></i> T-Master Class
    						</a>
    					</li>
    					<li>
    						<a @if ($categoriaSeleccionada == 'todos') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['todos', 'todos']) }}">
    							<i class="fa fa-list"></i> Todos los cursos
    						</a>
    					</li>
    				</ul>
    			</div>

    			<div class="uk-child-width-1-2 uk-hidden@s" uk-grid>
    				<div>
    					<ul class="uk-list categories-list">
	    					<li>
	    						<a @if ($categoriaSeleccionada == 'destacados') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['destacados', 'destacados']) }}">
	    							<i class="far fa-star"></i> Destacados
	    						</a>
	    					</li>
	    					<li>
	    						<a @if ($categoriaSeleccionada == 'vendidos') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['mas-vendidos', 'vendidos']) }}">
	    							<i class="fas fa-fire"></i> Más Vendidos
	    						</a>
	    					</li>
	    					<li>
	    						<a @if ($categoriaSeleccionada == 'recomendados') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['recomendados', 'recomendados']) }}">
	    							<i class="far fa-heart"></i> Recomendados
	    						</a>
	    					</li>
	    					@for ($i = 1; $i <= 5; $i++)
	    						<li>
	    							<a @if ($categoriaSeleccionada == $categoriaLista->id) class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', [$categorias[$i]->slug, $categorias[$i]->id]) }}">
	    								<i class="{{ $categorias[$i]->icon }}"></i> {{ $categorias[$i]->title }}
	    							</a>
	    						</li>
	    					@endfor
	    				</ul>
    				</div>
    				<div>
    					<ul class="uk-list categories-list">
	    					@for ($j = 6; $j < 10; $j++)
	    						<li>
	    							<a @if ($categoriaSeleccionada == $categoriaLista->id) class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', [$categorias[$j]->slug, $categorias[$j]->id]) }}">
	    								<i class="{{ $categorias[$j]->icon }}"></i> {{ $categorias[$j]->title }}
	    							</a>
	    						</li>
	    					@endfor
	    					<li>
	    						<a @if ($categoriaSeleccionada == 'tbooks') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['t-books', 'tbooks']) }}">
	    							<i class="fas fa-book"></i> T-Books
	    						</a>
	    					</li>
	    					<li>
	    						<a @if ($categoriaSeleccionada == 100) class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['t-master-class', 100]) }}">
	    							<i class="fab fa-tumblr"></i> T-Master Class
	    						</a>
	    					</li>
	    					<li>
	    						<a @if ($categoriaSeleccionada == 'todos') class="category-list-item-active" @else class="category-link" @endif href="{{ route('landing.new-courses', ['todos', 'todos']) }}">
	    							<i class="fa fa-list"></i> Todos los cursos
	    						</a>
	    					</li>
	    				</ul>
    				</div>
    			</div>
    		</div>
    		<div class="uk-width-expand@xl uk-width-expand@l uk-width-2-3@m uk-width-2-3@s cards-section">
    			<div class="courses-category-selected">{{ $tituloCategoriaSeleccionada }}</div>

    			<div>
    				@if ($cursos->count() > 0)
	    				<ul class="uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-3@l uk-child-width-1-3@xl" uk-grid>
		                    @foreach ($cursos as $curso)
			                    <li class="course uk-transition-toggle" tabindex="0">
		                            <div class="uk-card uk-card-small course-card">
		                                <div class="uk-card-media-top image-div">
		                                    @if (!is_null($curso->preview))
		                                    	@if ($categoriaSeleccionada == 100)
		                                    		<a class="view-preview" uk-toggle="target: #modal-preview" data-viewPreview="{{ route('ajax.load-preview', [$curso->id, 'clase']) }}">
			                                            <img src="{{ asset('uploads/images/master-class/'.$curso->cover) }}" class="content-image">
			                                        </a>
			                                    @elseif ($categoriaSeleccionada == 'tbooks')
			                                    	<a class="view-preview" uk-toggle="target: #modal-preview" data-viewPreview="{{ route('ajax.load-preview', [$curso->id, 'podcast']) }}">
			                                            <img src="{{ asset('uploads/images/podcasts/'.$curso->cover) }}" class="content-image">
			                                        </a>
			                                    @else
			                                        <a class="view-preview" uk-toggle="target: #modal-preview" data-viewPreview="{{ route('ajax.load-preview', [$curso->id, 'curso']) }}">
			                                            <img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" class="content-image">
		                                        	</a>
		                                        @endif
		                                    @else
		                                    	@if ($categoriaSeleccionada == 100)
		                                        	<a href="{{ route('landing.master-class.show', [$curso->slug, $curso->id]) }}">
		                                            	<img src="{{ asset('uploads/images/master-class/'.$curso->cover) }}" class="content-image">
		                                        	</a>
		                                        @elseif ($categoriaSeleccionada == 'tbooks')
		                                        	<a href="{{ route('landing.podcasts.show', [$curso->slug, $curso->id]) }}">
			                                            <img src="{{ asset('uploads/images/podcasts/'.$curso->cover) }}" class="content-image">
			                                        </a>
			                                    @else
			                                    	<a href="{{ route('landing.courses.show', [$curso->slug, $curso->id]) }}">
			                                            <img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" class="content-image">
			                                        </a>
			                                    @endif
		                                    @endif
		                                </div>
		                                <div class="uk-card-body card-body">
		                                	@if ($categoriaSeleccionada == 100)
		                                		<a href="{{ route('landing.master-class.show', [$curso->slug, $curso->id]) }}">
		                                	@elseif ($categoriaSeleccionada == 'tbooks')
		                                		<a href="{{ route('landing.podcasts.show', [$curso->slug, $curso->id]) }}">
		                                	@else
		                                    	<a href="{{ route('landing.courses.show', [$curso->slug, $curso->id]) }}">
		                                    @endif
		                                        <div>
		                                            <div class="course-title">{{ $curso->title }}</div>
		                                            @if ($categoriaSeleccionada != 100)
			                                            <div class="course-instructor">Por: {{ $curso->user->names.' '.$curso->user->last_names }}</div>
			                                            <div class="course-category"><strong>{{ $curso->category->title }}</strong></div>
			                                        @endif
		                                            <div class="course-subtitle">{{ ucfirst($curso->subtitle) }}</div>

		                                            <br>
		                                            @if ($categoriaSeleccionada == 100)
		                                            	<a class="show-more-link" href="{{ route('landing.master-class.show', [$curso->slug, $curso->id]) }}">Ver más</a>
		                                            @elseif ($categoriaSeleccionada == 'tbooks')
		                                            	<a class="show-more-link" href="{{ route('landing.podcasts.show', [$curso->slug, $curso->id]) }}">Ver más</a>
		                                            @else
		                                            	<a class="show-more-link" href="{{ route('landing.courses.show', [$curso->slug, $curso->id]) }}">Ver más</a>
		                                            @endif
		                                        </div>
		                                    </a>
		                                    @if ($categoriaSeleccionada != 100)
			                                    <div class="card-buttons">
			                                        @if (Auth::guest())
			                                            <a class="link-course" href="#modal-login" uk-toggle> <span class="btn-course2">Agregar al carrito</span></a>
			                                        @elseif (Auth::user()->role_id == 1)
			                                        	@if ($categoriaSeleccionada != 'tbooks')
			                                        		@if (!in_array($curso->id, $misCursos))
					                                            @if (!is_null(Auth::user()->membership_id))
					                                                @if (Auth::user()->membership_courses < 3)
					                                                    <a class="link-course" href="{{ route('students.courses.add', [$curso->id, 'membresia']) }}"> <span class="btn-course2">Agregar a Mis Cursos</span></a>
					                                                @else
					                                                    <a class="link-course" href="{{ route('landing.shopping-cart.store', [$curso->id, 'curso']) }}"> <span class="btn-course2">Agregar al Carrito</span></a>
					                                                @endif
					                                            @else
					                                                <a class="link-course" href="{{ route('landing.shopping-cart.store', [$curso->id, 'curso']) }}"> <span class="btn-course2">Agregar al Carrito</span></a>
					                                            @endif
					                                        @else
					                                        	<a class="link-course" href="{{ route('students.courses.resume', [$curso->slug, $curso->id]) }}"> <span class="btn-course3">Continuar T-Course</span></a>
					                                        @endif
				                                        @else
				                                        	@if (!in_array($curso->id, $misLibros))
				                                        		<a class="link-course" href="{{ route('landing.shopping-cart.store', [$curso->id, 'podcast']) }}"> <span class="btn-course2">Agregar al Carrito</span></a>
				                                        	@else
				                                        		<a class="link-course" href="{{ route('landing.shopping-cart.store', [$curso->id, 'podcast']) }}"> <span class="btn-course3">Continuar T-Book</span></a>
				                                        	@endif
				                                        @endif
			                                        @endif
			                                    </div>
			                                @endif
		                                </div>
		                                <div class="uk-text-center course-price">COP {{ number_format($curso->price, 0, ',', '.') }}</div>
		                            </div>
		                        </li>
		                    @endforeach
	                	</ul>

	                	<div class="uk-text-center" style="padding-top: 20px;">
	                		{{ $cursos->links() }}
	                	</div>
	                @else
	                	<div style="padding-top: 10px; font-size: 21px;">
	                		No existen cursos relacionados con esta categoría...
	                	</div>
	                @endif
    			</div>
    		</div>
    	</div>
    </div>
    

@endsection