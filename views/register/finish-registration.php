<main class="plan">
    <p class="plan__description">Elige el plan de DevAcademy que más se ajuste a tus necesidades y comienza a aprender hoy mismo!</p>

    <form method="POST" action="#">
        <div class="toggle__container-wrapper">
            <div class="toggle__container">
                <input type="radio" id="gratis" name="plan" value="1" checked>
                <label for="gratis" class="toggle__label">Plan Gratuito</label>

                <input type="radio" id="premium" name="plan" value="2">
                <label for="premium" class="toggle__label">Plan Premium</label>
                <span class="toggle__slider"></span>
            </div>
        </div>

        <div class="plans__container">
            <div class="plan plan--free">
                <h3 class="plan__name">Plan Gratuito</h3>
                <ul class="plan__list">
                    <li class="plan__item">Acceso a cursos gratuitos</li>
                    <li class="plan__item">Calidad de video limitada (Definición Estándar)</li>
                    <li class="plan__item">Foros de soporte comunitario</li>
                    <li class="plan__item">Acceso a webinarios introductorios</li>
                </ul>
                <p class="plan__price">0€</p>
            </div>

            <div class="plan plan--premium" style="display: none;">
                <h3 class="plan__name">Plan Premium</h3>
                <ul class="plan__list">
                    <li class="plan__item">Acceso ilimitado a todos los cursos</li>
                    <li class="plan__item">Calidad de video en Alta Definición</li>
                    <li class="plan__item">Acceso a talleres exclusivos y conferencias avanzadas</li>
                    <li class="plan__item">Certificados de finalización</li>
                </ul>
                <p class="plan__price">25€</p>
            </div>
        </div>
        <a href="#" class="btn-confirm" onclick="handlePlanSelection(event)">Confirmar Plan</a>
    </form>
</main>
