<div class="container">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Carousel indicators -->
	<ol class="carousel-indicators">
	    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	    <li data-target="#myCarousel" data-slide-to="1"></li>
	    <li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>   
	<!-- Wrapper for carousel items -->
	<div class="carousel-inner">
	    <div class="item active">
	        <img src="{{ asset('store_img/carousel/p1.png') }}" alt="First Slide">
	    </div>
	    <div class="item">
	        <img src="{{ asset('store_img/carousel/p2.png') }}" alt="Second Slide">
	    </div>
	</div>
	<!-- Carousel controls -->
	<a class="carousel-control left" href="#myCarousel" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<a class="carousel-control right" href="#myCarousel" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	</a>
	</div>
</div>
