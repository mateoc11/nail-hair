@extends('layouts.app2')

@section('content')
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="unas1.jpg" class="d-block w-100 darken" alt="...">
          <div class="carousel-caption d-none d-md-block"">
            <h3>Ayudando a miles de trabajadores de la cosmetica</h3>
            <p>ya somos mas de 100 usuarios</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="unas23.jpg" class="d-block w-100 darken" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h3>Visitanos en nuestras redes sociales</h3>
            <p>Alli destacaremos anuncios especiales</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="pelo5.jpg" class="d-block w-100 darken" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h3>Gracias por visitarnos</h3>
            <p>Tomate tu tiempo y visita algunos de los anuncios que tenemos para ti</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
  </div><br>
  <livewire:search-posts/>
@endsection