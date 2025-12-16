<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Lista de noticias más recientes." />
    <title><?= esc($title) ?></title>
    
    <script src="<?= base_url('assets/js/color-modes.js')?>"></script>
    <link href="<?= base_url('assets/dist/css/bootstrap.min.css')?> " rel="stylesheet" />
    <link href="<?= base_url('assets/css/dashboard.css')?>" rel="stylesheet" />
    
    <style>
      .news-card-body {
        max-height: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
      }
    </style>
  </head>
  <body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="<?= base_url() ?>" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <span class="fs-4">Mi Sitio de Noticias</span>
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="<?= base_url() ?>" class="nav-link px-2 link-secondary">Inicio</a></li>
                    <li><a href="<?= base_url('about') ?>" class="nav-link px-2 link-dark">Acerca de</a></li>
                </ul>
                <div class="text-end">
                    <a href="<?= base_url('backend') ?>" class="btn btn-outline-primary me-2">Administración</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <main>
            <h1 class="pb-2 mb-4 border-bottom"><?= esc($title) ?></h1>

            <?php if ($news_list): ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    
                    <?php foreach ($news_list as $news_item): ?>
                        <div class="col">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <span class="badge bg-secondary mb-2"><?= esc($news_item['category'] ?? 'General') ?></span>
                                    <h5 class="card-title"><?= esc($news_item['title']) ?></h5>
                                    
                                    <p class="card-text news-card-body">
                                        <?= esc(substr($news_item['body'], 0, 150)) . '...' ?>
                                    </p>
                                    
                                    <a href="<?= base_url('news/'.$news_item['slug'])?>" class="btn btn-primary mt-2">
                                        Leer Noticia Completa
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                
                </div>

            <?php else: ?>

                <div class="alert alert-warning text-center">
                    <h2>No hay Noticias Publicadas</h2>
                    <p>Lo sentimos, no pudimos encontrar ninguna noticia en este momento.</p>
                </div>

            <?php endif ?>

        </main>
    </div>

    <script src="<?= base_url('assets/dist/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?= base_url('assets/js/color-modes.js')?>"></script>
  </body>
</html>