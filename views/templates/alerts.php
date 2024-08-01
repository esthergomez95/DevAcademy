<?php
if (!empty($alerts)) {
    foreach ($alerts as $key => $alert) {
        foreach ($alert as $message) {
            ?>
            <div class="alert alert--<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($message); ?></div>
            <?php
        }
    }
}
?>