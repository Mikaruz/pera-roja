<?php include("templates/header.php"); ?>
<h2 class="cart-title">Calculadora de calorías diarias</h2>
<div class="terminos-condiciones">
    <div class="container-calculadora">
        <div class="table-container">
            <table class="calories-table">
                <thead>
                    <tr>
                        <th scope="col">Plato</th>
                        <th scope="col">Calorias</th>
                        <th scope="col">Carbohidratos</th>
                        <th scope="col">Proteínas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <thead>
                    <tr>
                        <th>Total</th>
                        <th id="totalCalories">0</th>
                        <th id="totalCarbs">0</th>
                        <th id="totalProtein">0</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="input-container">
            <div>
                <input type="text" id="description" class="input-field" placeholder="Descripción">
            </div>
            <div>
                <input type="number" min="0" id="calories" class="input-field" placeholder="Calorias">
            </div>
            <div>
                <input type="number" min="0" id="carbs" class="input-field" placeholder="Carbohidratos">
            </div>
            <div>
                <input type="number" min="0" id="protein" class="input-field" placeholder="Proteinas">
            </div>
            <div>
                <button onclick="validateInputs()" class="submit-button">
                    <i></i>
                </button>
            </div>
        </div>
    </div>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/C0dO40m_HQw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/WnoCFnIiQHw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/main.js"></script>




<?php include("templates/footer.php"); ?>