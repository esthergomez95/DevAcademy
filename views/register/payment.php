<main class="payment">
    <div class="credit-card">
        <div class="credit-card__header">
            <div class="credit-card__logo">
                <i class="fab fa-cc-visa"></i> Visa
            </div>
            <div class="credit-card__chip">
                <svg width="40" height="30">
                    <rect x="0" y="0" width="40" height="30" rx="4" ry="4" fill="#D4AF37"></rect>
                </svg>
            </div>
        </div>

        <form method="POST" action="/confirmation" class="credit-card__form">
            <div class="credit-card__field">
                <label for="card_number">Número de Tarjeta</label>
                <input type="text" id="card_number" name="card_number" placeholder="8060 5040 2030 3020" maxlength="19" required>
            </div>

            <div class="credit-card__field">
                <label for="card_name">Nombre del Titular</label>
                <input type="text" id="card_name" name="card_name" placeholder="Borja Pérez Rueda" required>
            </div>

            <div class="credit-card__expiry-cvv">
                <div class="credit-card__field">
                    <label for="expiry_date">Fecha de Expiración</label>
                    <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/AA" maxlength="5" required>
                </div>

                <div class="credit-card__field">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="CVV" maxlength="3" required>
                </div>
            </div>

            <button type="submit" class="credit-card__submit">Pagar Ahora</button>
        </form>
    </div>
</main>
