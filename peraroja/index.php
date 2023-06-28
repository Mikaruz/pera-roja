<?php include("templates/header.php"); ?>
<div class="first-banner-container">
  <div class="first-banner">
    <div class="first-banner-text">
      <h3>Platos deliciosos,</h3>
      <h3>variados y nutritivos</h3>
      <p>Creamos tu plan ideal segun tus requerimientos físicos.</p>
      <button class="first-banner-button"><b>INICIA AHORA</b></button>
    </div>
  </div>
</div>

<div class="section-one">
  <h3>¿Por qué elegirnos?</h3>
  <div class="razones">
    <div class="razon">
      <img src="./images/icon-custom.webp" alt="custom" />
      <p>Tu comida esta diseñada según tus objetivos.</p>
    </div>
    <div class="razon">
      <img src="./images/icon-domicilio.webp" alt="domicilio" />
      <p>Puedes seguir el programa desde tu teléfono.</p>
    </div>
    <div class="razon">
      <img src="./images/icon-flexible.webp" alt="flexible" />
      <p>Entrega inmediata.</p>
    </div>
    <div class="razon">
      <img src="./images/icon-programa.webp" alt="programa" />
      <p>Sigue tu progreso fácilmente.</p>
    </div>
  </div>
</div>

<h3 class="section-three-two">Disfrute de nuestros platos</h3>
<div class="platos">
  <div class="plato">
    <a href="plato.php?id=30">
      <img src="./images/Pollo_Pesto.jpg" alt="pollopesto">
    </a>

    <p>Pollo al pesto</p>
  </div>
  <div class="plato">
    <a href="plato.php?id=29">
      <img src="./images/Trcuha_Habichuela.jpg" alt="truchapicante">
    </a>

    <p>Trucha picante</p>
  </div>
  <div class="plato">
    <a href="plato.php?id=31">
    <img src="./images/Fideos.jpg" alt="polloplancha">
    </a>
    
    <p>Bowl de pollo a la naranja</p>
  </div>
  <div class="plato">
    <a href="plato.php?id=33">
      <img src="./images/Pollo+carbonara_Corregido.png" alt="pollocarbon">
    </a>

    <p>Pollo carbonara</p>
  </div>
</div>


<h3 class="section-three-title">Descubre los beneficios</h3>
<div class="section-three">
  <div class="contenedor" id="servicio">
    <div class="contenedor-servicio">
      <img class="section-three-image" src="./images/aji-de-gallina.webp" alt="" />
      <div class="checklist-servicio">
        <div class="service">
          <img src="./images/icon-1.webp" alt="" />
          <p>Comida saludable al mejor precio.</p>
        </div>
        <div class="service">
          <img src="./images/icon-2.webp" alt="" />
          <p>Ahorra tiempo.</p>
        </div>
        <div class="service">
          <img src="./images/icon-3.webp" alt="" />
          <p>Recibe tus platos en la mejor presentación.</p>
        </div>
        <div class="service">
          <img src="./images/icon-4.webp" alt="" />
          <p>Especialistas las 24 horas.</p>
        </div>
      </div>
    </div>
  </div>
</div>


<h3 class="section-four-title">¡Únete a nosotros!</h3>
<div class="section-four">
  <div class="reseñas">
    <div class="reseña">
      <div class="valoración">
        <span class="estrella"></span>
        <span class="estrella"></span>
        <span class="estrella"></span>
        <span class="estrella"></span>
        <span class="estrella"></span>
      </div>
      <p class="comentario">Trabajo más de 12 horas al día y no tengo energía para cocinar. Manzana verde es mi mejor opción para comer bien y ahorrar tiempo.</p>
      <p class="usuario">- Jhonatan Abregu</p>
    </div>

    <div class="reseña">
      <div class="valoración">
        <span class="estrella"></span>
        <span class="estrella"></span>
        <span class="estrella"></span>
        <span class="estrella"></span>
        <span class="estrella"></span>
      </div>
      <p class="comentario">Me encanta la comida de este lugar, siempre está fresca y deliciosa. Además, la atención al cliente es excelente.</p>
      <p class="usuario">- Marcos Puma</p>
    </div>

    <div class="reseña">
      <div class="valoración">
        <span class="estrella"></span>
        <span class="estrella"></span>
        <span class="estrella"></span>
        <span class="estrella"></span>
        <span class="estrella"></span>
      </div>
      <p class="comentario">El servicio de entrega es muy rápido y la comida es de alta calidad. Definitivamente lo recomiendo.</p>
      <p class="usuario">- José Boado</p>
    </div>
  </div>

</div>

<h3 class="section-five-title">Zona cobertura</h3>
<div class="section-five">
  <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3899.6298267195657!2d-76.93779565393932!3d-12.205572038890107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2spe!4v1683669088037!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</div>

<?php include("templates/footer.php"); ?>