<article>
    <h2><?= htmlspecialchars($this->version->name) ?></h2>
    <p><?= htmlspecialchars($this->version->description) ?></p>
    <?= number_format($this->version->price / 100, 2, ',', ' ') ?>
    <?= $this->version->price_currency ?>
</article>
