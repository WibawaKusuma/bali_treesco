<style>
    .icon {
        width: 100px;
        height: 100px;
        background-color: #f0f0f0;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 50px;
    }

    .icon-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
        /* Jarak antara ikon dan teks */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        /* Pastikan seluruh card-body diisi penuh */
    }

    h5 {
        margin: 0;
        font-size: 16px;
        text-align: center;
        text-transform: capitalize;
    }
</style>
<div class="row" style="justify-content: center;">
    <div class="row" style="width: 80%;">
        <?php foreach ($module as $k) : ?>
            <?php if ($k->status == 1) { ?>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <a href="<?= base_url($k->url) ?>" class="d-flex align-items-center flex-column" title="<?= $k->name ?>">
                                <div class="icon-container">
                                    <i class="<?= $k->icon ?> icon"></i>
                                </div>
                                <h5 class="text-center text-dark"><?= $k->name ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        <?php endforeach; ?>
    </div>
</div>